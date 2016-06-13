<?php

/**
 * Created by PhpStorm.
 * User: antonio
 * Date: 20/05/16
 * Time: 2:55
 */
class Recursos_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    /**
     * Devuelve todos los recursos
     * @return array
     */
    public function get_recursos() {
        $this->db->select('usuarios.nombre,usuarios.apellidos,usuarios.id_usuario,recursos.*')
                ->from('recursos')
                ->join('usuarios', 'recursos.id_profesor = usuarios.id_usuario');
        
        return $this->db->get()->result_array();
    }

    /**
     * Obtiene la información de un recurso
     * @param int $id
     * @return array
     */
    public function get_recurso($id) {
        $this->db->select('usuarios.nombre,usuarios.apellidos,usuarios.id_usuario,recursos.*')
                ->from('recursos')
                ->join('usuarios', 'recursos.id_profesor = usuarios.id_usuario')
                ->where('recursos.id_recurso', $id);

        return $this->db->get()->row_array();
    }

    /**
     * Obtiene los recursos de un profesor
     * @param int $id_profesor
     * @return array
     */
    public function get_recursos_profesor($id_profesor) {
        $this->db->select('id_recurso,lugar,fecha_ini,fecha_fin,descripcion,asignatura')
                ->from('recursos')
                ->where('id_profesor', $id_profesor);

        return $this->db->get()->result_array();
    }

    /**
     * Crea un nuevo recurso
     * @param array $recurso
     */
    public function add_recurso($recurso) {
        $this->db->insert('recursos', $recurso);
    }

    /**
     * Actualiza la información de un recurso
     * @param array $recurso
     */
    public function update_recurso($recurso) {
        $this->db->replace('recursos', $recurso);
    }

    /**
     * Elimina un recurso
     * @param int $id_recurso
     */
    public function eliminar_recurso($id_recurso) {
        $this->db->where('id_recurso', $id_recurso);
        $this->db->delete('recursos');
    }

    /**
     * Obtiene los recursos de un profesor ordenados por fecha (asc)
     * @param int $id_profesor
     * @return array
     */
    public function get_recursos_ordenados($id_profesor) {
        $this->db->select('*')
                ->from('recursos')
                ->order_by('fecha_ini', "asc")
                ->where('id_profesor', $id_profesor);

        return $this->db->get()->result_array();
    }

}
