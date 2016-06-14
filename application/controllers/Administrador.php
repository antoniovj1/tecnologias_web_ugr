<?php

/**
 * Description of Administrador
 *
 * @author Antonio de la Vega
 * 21-may-2016
 * Administrador.php
 */
class Administrador extends CI_Controller {

    /**
     * Constructor
     */
    public function __construct() {
        parent::__construct();

        if ($this->session->userdata('loged') and ( $this->session->userdata('nombre_rol') == 'administrador')) {
            $this->load->model('recursos_model');
            $this->load->model('usuario_model');
            $this->load->helper('form');
        } else {
            redirect($_SERVER["HTTP_REFERER"]);
        }
    }

    /**
     * index()
     * Carga la página principal
     */
    public function index() {
        $data['usuarios'] = $this->usuario_model->get_usuarios($this->session->userdata('id_usuario'));

        $this->load->view('templates/header');
        $this->load->view('administrador_view', $data);
        $this->load->view('templates/footer');
    }

    /**
     * usuarios()
     * Carga la página de usuarios
     */
    public function usuarios() {
        $data['usuarios'] = $this->usuario_model->get_usuarios($this->session->userdata('id_usuario'));

        $this->load->view('templates/header');
        $this->load->view('administrador_usuarios_view', $data);
        $this->load->view('templates/footer');
    }

    /**
     * Función para editar o eliminar un usuario
     * @param int $id_usuario
     */
    function modificar_eliminar_usuario($id_usuario) {
        if (!$this->input->post('modificar') && !$this->input->post('eliminar')) {
            $data['usuario'] = $this->usuario_model->get_usuario($id_usuario);

            if ($data['usuario']['nombre_rol'] == 'profesor') {
                $data['departamento'] = $this->usuario_model->get_departamento($id_usuario);
            }

            $this->load->view('templates/header');
            $this->load->view('administrador_detalles_usuario_view', $data);
            $this->load->view('templates/footer');
        } else {
            if ($this->input->post('modificar')) {
                $nick = $this->input->post('nick');
                $nombre = $this->input->post('nombre');
                $apellidos = $this->input->post('apellidos');
                $email = $this->input->post('email');
                $departamento = $this->input->post('departamento');
                $passw = $this->input->post('passw');
                $rol = $this->input->post('rol');

                $info_user = array(
                    'id_usuario' => $id_usuario,
                    'nick' => $nick,
                    'nombre' => $nombre,
                    'apellidos' => $apellidos,
                    'email' => $email,
                );

                if ($passw != NULL) {
                    $passw = sha1($passw);
                    $info_user['passw'] = $passw;
                }

                if ($rol == 'profesor') {
                    $info_prof = array(
                        'id_profesor' => $id_usuario,
                        'departamento' => $departamento
                    );
                    $this->usuario_model->update_profesor($info_user, $info_prof);
                } else {
                    $this->usuario_model->update_usuario($info_user);
                }
            } else {
                $this->usuario_model->eliminar_usuario($id_usuario);
            }


            redirect(base_url() . 'index.php/administrador/usuarios');
        }
    }

    /**
     * Función para dar de alta a un usuario
     */
    function alta_usuario() {
        if (!$this->input->post('alta')) {
            $data['roles'] = $this->usuario_model->get_roles();
            $this->load->view('templates/header');
            $this->load->view('administrador_alta_usuario_view', $data);
            $this->load->view('templates/footer');
        } else {
            $nick = $this->input->post('nick');
            $nombre = $this->input->post('nombre');
            $apellidos = $this->input->post('apellidos');
            $email = $this->input->post('email');
            $departamento = $this->input->post('departamento');
            $passw = sha1($this->input->post('passw'));
            $rol = $this->input->post('rol');

            $info_user = array(
                'nick' => $nick,
                'nombre' => $nombre,
                'apellidos' => $apellidos,
                'email' => $email,
                'passw' => $passw
            );

            switch ($rol) {
                case '1':
                    $this->usuario_model->add_admin($info_user);
                    break;
                case '2':
                    $info_prof = array(
                        'departamento' => $departamento
                    );
                    $this->usuario_model->add_profesor($info_user, $info_prof);
                    break;
            }

            redirect(base_url() . 'index.php/administrador/usuarios');
        }
    }

    /**
     * Función que muestra los recursos
     */
    public function recursos() {
        $data['recursos'] = $this->recursos_model->get_recursos();

        $this->load->view('templates/header');
        $this->load->view('administrador_recursos_view', $data);
        $this->load->view('templates/footer');
    }

    /**
     * Función para crear un recurso
     */
    function crear_recurso() {
        if (!$this->input->post('add')) {
            $this->load->view('templates/header');
            $this->load->view('administrador_crear_recurso_view');
            $this->load->view('templates/footer');
        } else {
            $nick = $this->input->post('nick');
            $lugar = $this->input->post('lugar');
            $asignatura = $this->input->post('asignatura');
            $descripcion = $this->input->post('descripcion');
            $fecha_ini = $this->input->post('fecha_ini');
            $fecha_fin = $this->input->post('fecha_fin');
            $id_profesor = $this->usuario_model->get_id_nick($nick);
            $codigo = $lugar[0] . $lugar[1] . $asignatura[0] . $asignatura[1] . $fecha_fin[[strlen($fecha_fin) - 1]] . $id_profesor[0];

            $recurso = array(
                'id_profesor' => $id_profesor,
                'codigo' => $codigo,
                'lugar' => $lugar,
                'asignatura' => $asignatura,
                'descripcion' => $descripcion,
                'fecha_ini' => $fecha_ini,
                'fecha_fin' => $fecha_fin
            );

            $this->recursos_model->add_recurso($recurso);

            redirect(base_url() . 'index.php/administrador/recursos');
        }
    }

    /**
     * Función para eliminar o modificar un recurso
     * @param int $id_recurso
     */
    public function modificar_eliminar_recurso($id_recurso) {
        if (!$this->input->post('modificar') && !$this->input->post('eliminar')) {
            $data['recurso'] = $this->recursos_model->get_recurso($id_recurso);
            $data['nick'] = $this->usuario_model->get_nick_profesor_recurso($id_recurso);

            $this->load->view('templates/header');
            $this->load->view('administrador_detalles_recurso_view', $data);
            $this->load->view('templates/footer');
        } else {
            if ($this->input->post('modificar')) {
                $nick = $this->input->post('nick');
                $lugar = $this->input->post('lugar');
                $asignatura = $this->input->post('asignatura');
                $descripcion = $this->input->post('descripcion');
                $fecha_ini = $this->input->post('fecha_ini');
                $fecha_fin = $this->input->post('fecha_fin');
                $id_profesor = $this->usuario_model->get_id_nick($nick);

                $codigo = $lugar[0] . $lugar[1] . $asignatura[0] . $asignatura[1] . $fecha_fin[[strlen($fecha_fin) - 1]] . $id_profesor[0];


                $recurso = array(
                    'id_recurso' => $id_recurso,
                    'id_profesor' => $id_profesor,
                    'codigo' => $codigo,
                    'lugar' => $lugar,
                    'asignatura' => $asignatura,
                    'descripcion' => $descripcion,
                    'fecha_ini' => $fecha_ini,
                    'fecha_fin' => $fecha_fin
                );

                $this->recursos_model->update_recurso($recurso);
            } else {
                $this->recursos_model->eliminar_recurso($id_recurso);
            }

            redirect(base_url() . 'index.php/administrador/recursos');
        }
    }

    /**
     * Función que muestra el perfil
     */
    public function perfil() {
        $id = $this->session->userdata('id_usuario');
        $data['usuario'] = $this->usuario_model->get_usuario($id);

        $this->load->view('templates/header');
        $this->load->view('administrador_perfil_view', $data);
        $this->load->view('templates/footer');
    }

    public function validar_email() {
        $email = $this->input->post('email');
        $id = $this->input->post('id');

        $usos = $this->usuario_model->email_usado($email, $id);

        if ($usos == 0) {
            echo "true";
        } else {
            echo "false";
        }
    }

    public function validar_nick() {
        $nick = $this->input->post('nick');
        $id = $this->input->post('id');

        $usos = $this->usuario_model->nick_usado($nick, $id);

        if ($usos == 0) {
            echo "true";
        } else {
            echo "false";
        }
    }

    public function validar_nick_recurso() {
        $nick = $this->input->post('nick');

        $usos = $this->usuario_model->existe_nick_profesor($nick);

        if ($usos == 1) {
            echo "true";
        } else {
            echo "false";
        }
    }

}
