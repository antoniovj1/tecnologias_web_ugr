<?php

/**
 * Description of Login
 *
 * @author Antonio de la Vega
 * 21-may-2016
 * Login.php
 */
class Login extends CI_Controller {

    /**
     * Constructor
     */
    public function __construct() {
        parent::__construct();
        $this->load->model('login_model');
    }

    /**
     * index()
     */
    public function index() {

        $nick = $this->input->post('nick');
        $password = sha1($this->input->post('passw'));

        $user = $this->login_model->get_user($nick, $password);

        if ($user['id_usuario'] != NULL) {
            $sessiondata = array(
                'username' => $user['nombre'],
                'nombre_rol' => $user['nombre_rol'],
                'id_usuario' => $user['id_usuario'],
                'loged' => TRUE
            );

            $this->session->set_userdata($sessiondata);
            $this->redirigir($user);
        } else {
            $this->redirigir(NULL);
        }
    }

    /**
     * Validación login
     */
    public function validar_login() {
        $nick = $this->input->post('nick');
        $password = sha1($this->input->post('passw'));

        $user = $this->login_model->get_user($nick, $password);

        if ($user['id_usuario'] != NULL) {
            echo "true";
        } else {
            echo "false";
        }
    }

    /**
     * Funcón para cerrar sesión
     */
    function logout() {
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('nombre_rol');
        $this->session->unset_userdata('id_usuario');
        $this->session->unset_userdata('loged');
        $this->session->sess_destroy();
        redirect(base_url() . 'index.php');
    }

    /**
     * Función para redirigir a un usuario según su rol
     * @param array $user
     */
    private function redirigir($user) {
        switch ($user['nombre_rol']) {
            case 'administrador':
                redirect(base_url() . 'index.php/administrador');
                break;
            case 'profesor':
                redirect(base_url() . 'index.php/profesor');

            default:
                redirect(base_url());
                break;
        }
    }

}
