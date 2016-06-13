<?php

/**
 * Description of Visalizacion
 *
 * @author Antonio de la Vega
 * 06-jun-2016
 * Visalizacion.php
 */
class Visualizacion extends CI_Controller {

    /**
     * Constructor
     */
    public function __construct() {
        parent::__construct();

        $this->load->model('visualizacion_model');
    }

    /**
     * Funcón que imprime un archivo json con las entradas a mostrar
     */
    public function entradas_json() {
        $entradasJson['success'] = TRUE;
        $entradasJson['message'] = '';
        $entradasJson['data']['entradas'] = $this->visualizacion_model->get_entradas();

        echo json_encode($entradasJson);
    }

    /**
     * Funcón que imprime un archivo json con las alertas a mostrar
     */
    public function alertas_json() {
        $alertasJson['success'] = TRUE;
        $alertasJson['message'] = '';
        $alertasJson['data']['alertas'] = $this->visualizacion_model->get_alertas();

        echo json_encode($alertasJson);
    }

}
