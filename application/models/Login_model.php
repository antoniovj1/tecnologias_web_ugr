<?php

/**
 * Description of Login_model
 *
 * @author Antonio de la Vega
 * 21-may-2016
 * Login_model.php
 */
class Login_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    /**
     * Devuelve el usuario
     * @param string $nick
     * @param string $password
     * @return array
     */
    public function get_user($nick, $password) {

        $this->db->select('usuarios.nombre,usuarios.id_usuario, roles.nombre_rol')
                ->from('usuarios')
                ->join('rol_usuario', 'usuarios.id_usuario = rol_usuario.id_usuario', 'inner')
                ->join('roles', 'rol_usuario.id_rol = roles.id_rol')
                ->where('usuarios.nick', $nick)
                ->where('usuarios.passw',$password);

        return $this->db->get()->row_array();
    }

}
