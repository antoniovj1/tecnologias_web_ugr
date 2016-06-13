<?php

/**
 * Description of Citas_model
 *
 * @author Antonio de la Vega
 * 24-may-2016
 * Citas_model.php
 */
class Citas_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    /**
     * Inserta una cita
     * @param array $cita
     */
    public function add_cita($cita) {
        $this->db->insert('citas', $cita);
    }

    /**
     * Devuelve la posición en la cola
     * @param string $codigo
     * @return  int
     */
    public function get_posicion($codigo) {

        $this->db->select('created_at,id_recurso')
                ->from('citas')
                ->where('citas.codigo', $codigo);

        $cita_row= $this->db->get()->row_array();

        $this->db->select('id_cita')
                ->from('citas')
                ->where('id_recurso', $cita_row['id_recurso'])
                ->where('created_at <', $cita_row['created_at']);

        return $this->db->count_all_results();
    }

    /**
     * Elimina una cita
     * @param int $id_cita
     */
    public function eliminar($id_cita) {
        $this->db->where('id_cita', $id_cita);
        $this->db->delete('citas');
    }

    /**
     * Elimina una cita
     * @param string $codigo
     */
    public function cancelar($codigo) {
        $this->db->where('codigo', $codigo);
        $this->db->delete('citas');
    }

    /**
     * Sube la prioridad de una cita
     * @param int $id_cita
     */
    public function cambiar_prioridad($id_cita) {
        $this->db->set('prioridad', '2');
        $this->db->where('id_cita', $id_cita);
        $this->db->update('citas');
    }

    /**
     * Devuelve la siguiente cita a una dada.
     * @param int $id_recurso
     * @param int $id_cita_anterior
     * @return array cita
     */
    public function get_siguiente($id_recurso, $id_cita_anterior) {
        if ($id_cita_anterior == NULL) {
            $this->db->limit(1);
            $this->db->select('*')
                    ->from('citas')
                    ->order_by('id_cita', "asc")
                    ->where('id_recurso', $id_recurso)
                    ->where('prioridad', '2');
            $query = $this->db->get();
            if ($query->num_rows() != 0) {
                return $query->row_array();
            } else {
                $this->db->limit(1);
                $this->db->select('*')
                        ->from('citas')
                        ->order_by('id_cita', "asc")
                        ->where('id_recurso', $id_recurso)
                        ->where('prioridad', '1');

                $query = $this->db->get();
                return $query->row_array();
            }
        } else {
            $this->db->limit(1);
            $this->db->select('*')
                    ->from('citas')
                    ->order_by('id_cita', "asc")
                    ->where('id_recurso', $id_recurso)
                    ->where('prioridad', '2')
                    ->where('id_cita >', $id_cita_anterior);
            $query = $this->db->get();
            if ($query->num_rows() != 0) {
                return $query->row_array();
            } else {
                $this->db->limit(1);
                $this->db->select('*')
                        ->from('citas')
                        ->order_by('id_cita', "asc")
                        ->where('id_recurso', $id_recurso)
                        ->where('prioridad', '1')
                        ->where('id_cita >', $id_cita_anterior);
                $query = $this->db->get();
                return $query->row_array();
            }
        }
    }

    /**
     * Consultar el número de citas en una cola.
     * @param int $id_recurso
     * @return int
     */
    public function get_num_citas($id_recurso) {
        $this->db->select('id_cita')
                ->from('citas')
                ->where('id_recurso', $id_recurso);

        return $this->db->count_all_results();
    }

    /**
     * Devuelve el número de citas con prioridad en un recurso
     * @param int $id_recurso
     * @return int
     */
    public function numero_citas_prioridad($id_recurso){
                $this->db->select('id_cita')
                ->from('citas')
                ->where('id_recurso', $id_recurso)
                ->where('prioridad',2);

        return $this->db->count_all_results();
    }
    
    /**
     * Número de usos de un código
     * @param string $codigo
     * @return int
     */
    public function codigo_usado($codigo) {
        $this->db->select('id_cita')
                ->from('citas')
                ->where('codigo', $codigo);

        return $this->db->count_all_results();
    }

    /**
     * Comprueba si un DNI ya está en una cola
     * @param int $dni
     * @param int $id_recurso
     * @return int
     */
    public function dni_usado($dni, $id_recurso) {
        $this->db->select('*')
                ->from('citas')
                ->where('dni', $dni)
                ->where('id_recurso', $id_recurso);

        return $this->db->count_all_results();
    }

}
