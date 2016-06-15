<?php

/**
 * Description of Profesor_model
 *
 * @author Antonio de la Vega
 * 21-may-2016
 * Profesor_model.php
 */
class Usuario_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    /**
     * Devuelve un usuario junto a los datos de profesor
     * @param int $id
     * @return array
     */
    public function get_profesor($id) {
        $this->db->select('*')
                ->from('usuarios')
                ->join('profesores', 'profesores.id_profesor = usuarios.id_usuario')
                ->where('profesores.id_profesor', $id);

        return $this->db->get()->row_array();
    }

    /**
     * Obtiene el departamento de un profesor
     * @param int $id
     * @return array
     */
    public function get_departamento($id) {
        $this->db->select('departamento')
                ->from('profesores')
                ->where('profesores.id_profesor', $id);

        return $this->db->get()->row_array();
    }

    /**
     * Devuelve los roles disponibles
     * @return array
     */
    public function get_roles() {
        $this->db->select('*')
                ->from('roles');

        return $this->db->get()->result_array();
    }

    /**
     * Devuelve un usuario con información del rol
     * @param int $id
     * @return array
     */
    public function get_usuario($id) {
        /*
         * select a.*, c.*
         * from usuarios a
         *      inner join rol_usuario b
         *          on a.id = b.id_usuario
         *      inner join roles c
         *          on b.id_rol = c.id
         * where a.id = $id
         */
        $this->db->select('usuarios.*, roles.*')
                ->from('usuarios')
                ->join('rol_usuario', 'usuarios.id_usuario = rol_usuario.id_usuario', 'inner')
                ->join('roles', 'rol_usuario.id_rol = roles.id_rol')
                ->where('usuarios.id_usuario', $id);

        return $this->db->get()->row_array();
    }

    /**
     * Devuelve todos los usuarios junto a la información de rol si
     * $id_usuario es distinto de null, en caso contrario obtiene uno en concreto
     * @param int $id_usuario
     * @return array
     */
    public function get_usuarios($id_usuario) {
        /*
         * select a.*, c.*
         * from usuarios a
         *      inner join rol_usuario b
         *          on a.id = b.id_usuario
         *      inner join roles c
         *          on b.id_rol = c.id
         */
        if ($id_usuario == NULL) {
            $this->db->select('usuarios.id_usuario,usuarios.nombre,usuarios.apellidos,usuarios.email,usuarios.nick, roles.*')
                    ->from('usuarios')
                    ->join('rol_usuario', 'usuarios.id_usuario = rol_usuario.id_usuario', 'inner')
                    ->join('roles', 'rol_usuario.id_rol = roles.id_rol')
                    ->order_by('usuarios.nombre', 'ASC');
        } else {
            $this->db->select('usuarios.id_usuario,usuarios.nombre,usuarios.apellidos,usuarios.email,usuarios.nick, roles.*')
                    ->from('usuarios')
                    ->join('rol_usuario', 'usuarios.id_usuario = rol_usuario.id_usuario', 'inner')
                    ->join('roles', 'rol_usuario.id_rol = roles.id_rol')
                    ->where('usuarios.id_usuario !=',$id_usuario)
                    ->order_by('usuarios.nombre', 'ASC');
        }
        return $this->db->get()->result_array();
    }

    /**
     * Devuelve todos los usuarios con información de profesor
     * @return array
     */
    public function get_profesores() {
        $this->db->select('usuarios.id_usuario,usuarios.nombre,usuarios.apellidos,usuarios.email,usuarios.nick,profesores.*')
                ->from('usuarios')
                ->join('profesores', 'profesores.id_profesor = usuarios.id_usuario');

        return $this->db->get()->result_array();
    }

    /**
     * Crea un nuevo profesor
     * @param array $info_user
     * @param array $info_prof
     */
    public function add_profesor($info_user, $info_prof) {
        $this->db->insert('usuarios', $info_user);
        $insert_id = $this->db->insert_id();

        $info_prof['id_profesor'] = $insert_id;

        $this->db->insert('profesores', $info_prof);

        $rol = array('id_rol' => '2', 'id_usuario' => $insert_id);
        $this->db->insert('rol_usuario', $rol);
    }

    /**
     * Crea un nuevo administrador
     * @param array $info_user
     */
    public function add_admin($info_user) {
        $this->db->insert('usuarios', $info_user);
        $insert_id = $this->db->insert_id();

        $rol = array('id_rol' => '1', 'id_usuario' => $insert_id);
        $this->db->insert('rol_usuario', $rol);
    }

    /**
     * Actualiza la info de un profesor
     * @param array $info_user
     * @param array $info_prof
     */
    public function update_profesor($info_user, $info_prof) {
        $this->db->where('id_usuario', $info_user['id_usuario']);
        $this->db->update('usuarios', $info_user);

        $this->db->where('id_profesor', $info_prof['id_profesor']);
        $this->db->update('profesores', $info_prof);
    }

    /**
     * Actualiza la info de un usuario
     * @param array $info_user
     */
    public function update_usuario($info_user) {
        $this->db->where('id_usuario', $info_user['id_usuario']);
        $this->db->update('usuarios', $info_user);
    }

    /**
     * Elimina un usuario
     * @param int $id_usuario
     */
    public function eliminar_usuario($id_usuario) {
        $this->db->where('id_usuario', $id_usuario);
        $this->db->delete('usuarios');
    }

    /**
     * Devuelve la id asociada a un nick
     * @param string $nick
     * @return int
     */
    public function get_id_nick($nick) {
        $this->db->select('id_usuario')
                ->from('usuarios')
                ->where('nick', $nick);

        $id = $this->db->get()->row_array();

        return $id['id_usuario'];
    }

    /**
     * Obtiene el nick del profesor que creó un recurso
     * @param int $id_recurso
     * @return string
     */
    public function get_nick_profesor_recurso($id_recurso) {
        $this->db->select('nick')
                ->from('usuarios')
                ->join('recursos', 'recursos.id_profesor = usuarios.id_usuario')
                ->where('recursos.id_recurso', $id_recurso);

        $query = $this->db->get()->row_array();
        return $query['nick'];
    }

    /**
     * Comprueba si un email está en uso
     * @param array $email
     * @param int $id
     * @return int
     */
    public function email_usado($email, $id) {
        if ($id == NULL) {
            $this->db->select('id_usuario')
                    ->from('usuarios')
                    ->where('email', $email);

            return $this->db->count_all_results();
        } else {
            $this->db->select('email')
                    ->from('usuarios')
                    ->where('id_usuario', $id);

            $query = $this->db->get();
            $query = $query->row_array();
            $email_antiguo = $query['email'];

            if (strtolower($email) == strtolower($email_antiguo)) {
                return 0;
            } else {
                $this->db->select('id_usuario')
                        ->from('usuarios')
                        ->where('email', $email);

                return $this->db->count_all_results();
            }
        }
    }

    /**
     * Comprueba si un nick esta en uso por otro usuario
     * @param string $nick
     * @param int $id
     * @return int
     */
    public function nick_usado($nick, $id) {
        if ($id == NULL) {
            $this->db->select('id_usuario')
                    ->from('usuarios')
                    ->where('nick', $nick);

            return $this->db->count_all_results();
        } else {
            $this->db->select('nick')
                    ->from('usuarios')
                    ->where('id_usuario', $id);

            $query = $this->db->get();
            $query = $query->row_array();
            $nick_antiguo = $query['nick'];

            if (strtolower($nick) == strtolower($nick_antiguo)) {
                return 0;
            } else {
                $this->db->select('id_usuario')
                        ->from('usuarios')
                        ->where('nick', $nick);

                return $this->db->count_all_results();
            }
        }
    }

    /**
     * Comprueba se el nick pertenece a un profesor
     * @param string $nick
     * @return int
     */
    public function existe_nick_profesor($nick) {
        $this->db->select('usuarios.id_usuario')
                ->from('usuarios')
                ->join('rol_usuario', 'usuarios.id_usuario = rol_usuario.id_usuario', 'inner')
                ->join('roles', 'rol_usuario.id_rol = roles.id_rol')
                ->where('usuarios.nick', $nick)
                ->where('roles.nombre_rol', 'profesor');

        return $this->db->count_all_results();
    }

}
