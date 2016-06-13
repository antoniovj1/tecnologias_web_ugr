<?php

/**
 * Description of Profesor
 *
 * @author Antonio de la Vega
 * 21-may-2016
 * Profesor.php
 */
class Profesor extends CI_Controller {

    /**
     * Constructor
     */
    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('loged') and ( $this->session->userdata('nombre_rol') == 'profesor')) {
            $this->load->model('usuario_model');
            $this->load->model('recursos_model');
            $this->load->model('citas_model');
            $this->load->model('visualizacion_model');
            $this->load->helper('form');
        } else {
            redirect(base_url() . 'index.php');
        }
    }

    /**
     * index()
     */
    public function index() {
        $data['recursos'] = $this->recursos_model->get_recursos_ordenados($this->session->userdata('id_usuario'));

        $this->load->view('templates/header');
        $this->load->view('profesor_view', $data);
        $this->load->view('templates/footer');
    }

    /**
     * perfil()
     */
    public function perfil() {
        $id_usuario = $this->session->userdata('id_usuario');

        if (!$this->input->post('modificar')) {
            $data['usuario'] = $this->usuario_model->get_profesor($id_usuario);

            $this->load->view('templates/header');
            $this->load->view('profesor_perfil_view', $data);
            $this->load->view('templates/footer');
        } else {
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

            $info_prof = array(
                'id_profesor' => $id_usuario,
                'departamento' => $departamento
            );

            $this->usuario_model->update_profesor($info_user, $info_prof);

            redirect(base_url() . 'index.php/profesor/');
        }
    }

    /**
     * Función para mostrar los recursos de un profesor
     */
    public function recursos() {
        $data['recursos'] = $this->recursos_model->get_recursos_profesor($this->session->userdata('id_usuario'));

        $this->load->view('templates/header');
        $this->load->view('profesor_recursos_view', $data);
        $this->load->view('templates/footer');
    }

    /**
     * Función para administrar un recurso.
     * @param int $id_recurso
     */
    public function administrar($id_recurso) {
        $data['recurso'] = $id_recurso;
        $data['fin'] = FALSE;

        $flag_prioridad = FALSE;

        $id_cita_anterior = $this->input->post('id_anterior');

        if ($this->input->post('terminado')) {
            $this->citas_model->eliminar($id_cita_anterior);
        } elseif ($this->input->post('sin_terminar')) {
            $this->citas_model->cambiar_prioridad($id_cita_anterior);
            $flag_prioridad = TRUE;
        }

        // if($flag_prioridad && $this->citas_model->numero_citas_prioridad($id_recurso) == 1){
        // Si acabo de cambiar la prioridad y es el único con prioridad, no paso al principio
        // Por ello salto me salto el siguinte if
        // }
        //Si la prioridad es 1, volvemos al principio para coger una de más prioridad
        //else
        if ($this->input->post('prioridad') == 1 && !($flag_prioridad && $this->citas_model->numero_citas_prioridad($id_recurso) == 1)) {
            $id_cita_anterior = 0;
        }

        $restantes = $this->citas_model->get_num_citas($id_recurso);
        $siguiente = $this->citas_model->get_siguiente($id_recurso, $id_cita_anterior);


        if ($restantes == 0) {
            $data['fin'] = TRUE;
        } elseif ($siguiente['id_cita'] == NULL) { //Si quedan pero la consulta esta vacia.
            $siguiente = $this->citas_model->get_siguiente($id_recurso, 0);
        }

        if ($siguiente['id_cita'] != NULL) {
            $data['cita'] = $siguiente;
            $this->visualizacion_model->add_cita($siguiente);
        }

        $this->load->view('templates/header');
        $this->load->view('profesor_administrar_recurso_view', $data);
        $this->load->view('templates/footer');
    }

    /**
     * Función para eliminar/modificar un recurso
     * @param int $id_recurso
     */
    public function modificar_eliminar($id_recurso) {
        if (!$this->input->post('modificar') && !$this->input->post('eliminar')) {
            $data['recurso'] = $this->recursos_model->get_recurso($id_recurso);
            $this->load->view('templates/header');
            $this->load->view('profesor_detalles_recurso_view', $data);
            $this->load->view('templates/footer');
        } else {
            if ($this->input->post('modificar')) {

                $lugar = $this->input->post('lugar');
                $asignatura = $this->input->post('asignatura');
                $descripcion = $this->input->post('descripcion');
                $fecha_ini = $this->input->post('fecha_ini');
                $fecha_fin = $this->input->post('fecha_fin');
                $id_profesor = $this->session->userdata('id_usuario');
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
            redirect(base_url() . 'index.php/profesor/recursos');
        }
    }

    /**
     * Función para crear un recurso
     */
    public function crear() {
        if (!$this->input->post('add')) {
            $this->load->view('templates/header');
            $this->load->view('profesor_crear_recurso_view');
            $this->load->view('templates/footer');
        } else {
            $lugar = $this->input->post('lugar');
            $asignatura = $this->input->post('asignatura');
            $descripcion = $this->input->post('descripcion');
            $fecha_ini = $this->input->post('fecha_ini');
            $fecha_fin = $this->input->post('fecha_fin');
            $id_profesor = $this->session->userdata('id_usuario');
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

            redirect(base_url() . 'index.php/profesor/recursos');
        }
    }

    /**
     * Función para mostrar las alertas de un profesor
     */
    public function alertas() {
        $data['alertas'] = $this->visualizacion_model->get_alertas_profesor($this->session->userdata('id_usuario'));

        $this->load->view('templates/header');
        $this->load->view('profesor_alertas_view', $data);
        $this->load->view('templates/footer');
    }

    /**
     * Fucnión para crear una alerta.
     */
    public function crear_alerta() {
        if (!$this->input->post('add')) {
            $this->load->view('templates/header');
            $this->load->view('profesor_crear_alerta_view');
            $this->load->view('templates/footer');
        } else {
            $mensaje = $this->input->post('mensaje');

            $alerta = array(
                'id_profesor' => $this->session->userdata('id_usuario'),
                'mensaje' => $mensaje
            );

            $this->visualizacion_model->add_alerta($alerta);

            redirect(base_url() . 'index.php/profesor/alertas');
        }
    }

    /**
     * Función para modificar/eliminar una alerta
     * @param int $id_alerta
     */
    public function modificar_eliminar_alerta($id_alerta) {
        if (!$this->input->post('modificar') && !$this->input->post('eliminar')) {
            $data['alerta'] = $this->visualizacion_model->get_alerta($id_alerta);
            $this->load->view('templates/header');
            $this->load->view('profesor_detalles_alerta_view', $data);
            $this->load->view('templates/footer');
        } else {
            if ($this->input->post('modificar')) {

                $mensaje = $this->input->post('mensaje');

                $alerta = array(
                    'id_alerta' => $id_alerta,
                    'id_profesor' => $this->session->userdata('id_usuario'),
                    'mensaje' => $mensaje
                );

                $this->visualizacion_model->update_alerta($alerta);
            } else {
                $this->visualizacion_model->eliminar_alerta($id_alerta);
            }
            redirect(base_url() . 'index.php/profesor/alertas');
        }
    }

    public function validar_email() {
        $email = $this->input->post('email');
        $id = $this->session->userdata('id_usuario');

        $usos = $this->usuario_model->email_usado($email, $id);

        if ($usos == 0) {
            echo "true";
        } else {
            echo "false";
        }
    }

    public function validar_nick() {
        $nick = $this->input->post('nick');
        $id = $this->session->userdata('id_usuario');

        $usos = $this->usuario_model->nick_usado($nick, $id);

        if ($usos == 0) {
            echo "true";
        } else {
            echo "false";
        }
    }

}
