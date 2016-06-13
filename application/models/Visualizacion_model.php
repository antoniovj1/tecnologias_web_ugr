<?php

/**
 * Description of visualizacion_model
 *
 * @author Antonio de la Vega
 * 06-jun-2016
 * visualizacion_model.php
 */
class visualizacion_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    /**
     * Devuelve el número total de entradas
     * @return int
     */
    public function get_num_entradas() {
        $this->db->select('*')
                ->from('visualizacion');

        return $this->db->count_all_results();
    }

    /**
     * True si el código no existe, false en caso contrario
     * @param string $codigo
     * @return boolean
     */
    public function no_existe($codigo) {
        $this->db->select('*')
                ->from('visualizacion')
                ->where('codigo', $codigo);

        return $this->db->count_all_results() == 0;
    }

    /**
     * Añade una cita a la tabla de visualización
     * @param array $cita
     */
    public function add_cita($cita) {
        $this->db->select('lugar')
                ->from('recursos')
                ->where('id_recurso', $cita['id_recurso']);


        $query = $this->db->get()->row_array();

        $entrada = array('codigo' => $cita['codigo'],
            'lugar' => $query['lugar'],
        );

        //No permite más de 6 alertas
        if ($this->get_num_entradas() >= 6) {
            $this->db->limit(1);
            $this->db->select('codigo')
                    ->from('visualizacion')
                    ->order_by('created_at', "asc");
            $query = $this->db->get();
            $codigo = $query->row_array();

            $this->db->where('codigo', $codigo['codigo']);
            $this->db->delete('visualizacion');
        }

        $this->db->insert('visualizacion', $entrada);
    }

    /**
     * Devuelve todas las entradas de la tabla
     * @return array
     */
    public function get_entradas() {
        $this->db->select('codigo,lugar,(DATE_FORMAT(created_at, "%T")) as hora')
                ->from('visualizacion')
                ->order_by('created_at', "desc");

        return $this->db->get()->result_array();
    }

    /**
     * Añade una alaerta
     * @param array $alerta
     */
    public function add_alerta($alerta) {
        $this->db->insert('alertas', $alerta);
    }

    /**
     * Elimina una alerta
     * @param int $id_alerta
     */
    public function eliminar_alerta($id_alerta) {
        $this->db->where('id_alerta', $id_alerta);
        $this->db->delete('alertas');
    }

    /**
     * Actualiza una alerta
     * @param array $alerta
     */
    public function update_alerta($alerta) {
        $this->db->replace('alertas', $alerta);
    }

    /**
     * Devuelve las alertas
     * @return array
     */
    public function get_alertas() {

        $this->db->select('alertas.mensaje,(DATE_FORMAT(alertas.created_at, "%d %b %T")) as fecha,nombre,apellidos')
                ->from('usuarios')
                ->order_by('alertas.created_at', "desc")
                ->join('alertas', 'alertas.id_profesor = usuarios.id_usuario');

        return $this->db->get()->result_array();
    }

    /**
     * Obtiene las alertas de un profesor
     * @param int $id_profesor
     * @return array
     */
    public function get_alertas_profesor($id_profesor) {
        $this->db->select('*')
                ->from('alertas')
                ->order_by('created_at', "desc")
                ->where('id_profesor', $id_profesor);

        return $this->db->get()->result_array();
    }

    /**
     * Devuelve una alerta
     * @param int $id_alerta
     * @return array
     */
    public function get_alerta($id_alerta) {
        $this->db->select('*')
                ->from('alertas')
                ->where('id_alerta', $id_alerta);

        return $this->db->get()->row_array();
    }

}
