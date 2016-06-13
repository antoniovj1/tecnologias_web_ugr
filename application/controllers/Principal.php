<?php

/**
 * Created by PhpStorm.
 * User: antonio
 * Date: 20/05/16
 * Time: 2:18
 */
class Principal extends CI_Controller {

    /**
     * Contructor
     */
    public function __construct() {
        parent::__construct();
        $this->load->model('citas_model');
        $this->load->model('recursos_model');
        $this->load->helper('form');
    }

    /**
     * index()
     */
    public function index() {

        $data['recursos'] = $this->recursos_model->get_recursos();

        $this->load->view('templates/header');
        $this->load->view('principal_view', $data);
        $this->load->view('templates/footer');
    }

    /**
     * Pantalla de visualización
     */
    public function visualizacion() {
        $this->load->view('visualizacion_view');
    }

    /**
     * Obtener recursos o detalles de uno.
     * @param int $id_recurso
     */
    public function recurso($id_recurso = NULL) {

        $data['recurso'] = $this->recursos_model->get_recurso($id_recurso);

        if (empty($data['recurso'])) {
            show_404();
        }

        $data['nuevo'] = FALSE;

        $this->load->view('templates/header');
        $this->load->view('principal_detalles_recurso_view', $data);
        $this->load->view('templates/footer');
    }

    /**
     * Función para crear una nueva cita.
     * @param int $id_recurso
     */
    public function add_cita($id_recurso) {
        if (!$this->input->post('apuntarse')) {
            $this->load->view('templates/header');
            $this->load->view('principal_detalles_recurso_view');
            $this->load->view('templates/footer');
        } else {
            $nombre = $this->input->post('nombre');
            $apellidos = $this->input->post('apellidos');
            $dni = $this->input->post('dni');
            $correo = $this->input->post('email');
            $codigo = $nombre[0] . $apellidos[0] . $dni[0] . $dni[1] . $dni[2] . $dni[strlen($dni) - 2] . $dni[strlen($dni) - 1] . $id_recurso[strlen($id_recurso) - 1];

            $cita = array(
                'id_recurso' => $id_recurso,
                'codigo' => $codigo,
                'nombre' => $nombre,
                'apellidos' => $apellidos,
                'dni' => $dni,
                'correo' => $correo
            );

            $this->citas_model->add_cita($cita);

            $data['nuevo'] = TRUE;
            $data['codigo'] = $codigo;

            $this->load->view('templates/header');
            $this->load->view('principal_detalles_recurso_view', $data);
            $this->load->view('templates/footer');
        }
    }

    /**
     * Función para consultar el turno
     */
    public function consultar_cancelar_turno() {
        if (!$this->input->post('consultar') && !$this->input->post('cancelar')) {
            $data['posicion'] = NULL;
            $data['eliminado'] = FALSE;

            $this->load->view('templates/header');
            $this->load->view('principal_consultar_pos_view', $data);
            $this->load->view('templates/footer');
        } else {
            $codigo = $this->input->post('codigo');
            if ($this->input->post('consultar')) {
                // Redondeo para ir de 5 en 5
                $posicion = $this->redondear($this->citas_model->get_posicion($codigo));

                $data['posicion'] = $posicion;
                $data['eliminado'] = FALSE;

                $this->load->view('templates/header');
                $this->load->view('principal_consultar_pos_view', $data);
                $this->load->view('templates/footer');
            } else {
                $this->citas_model->cancelar($codigo);
                $data['eliminado'] = TRUE;
                $this->load->view('templates/header');
                $this->load->view('principal_consultar_pos_view', $data);
                $this->load->view('templates/footer');
            }
        }
    }

    public function validar_codigo() {
        $codigo = $this->input->post('codigo');
        $usos = $this->citas_model->codigo_usado($codigo);

        if ($usos == 0) {
            echo "false";
        } else {
            echo "true";
        }
    }

    public function validar_dni() {
        $dni = $this->input->post('dni');
        $id_recurso = $this->input->post('id_recurso');

       $usos = $this->citas_model->dni_usado($dni, $id_recurso);
       if ($usos == 0) {
            echo "true";
        } else {
            echo "false";
        } 
    }

    /**
     * Función para redondear un valor en valores de 5 en 5.
     * @param int $numero
     * @return int
     */
    public function redondear($numero) {
        if ($numero < 5) {
            return 5;
        } else {
            return (floor($numero / 5) * 5) + 5;
        }
    }

}
