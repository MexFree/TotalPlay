<?php

/*
 * Proyecto progamado por xlFederalElk0lx.
 * Informes coil811122@icloud.com
 */

/**
 *
 * @author xlfederalelk0lx
 */
class User extends TP_Model {

    public function __construct($base_url = null) {
        parent::__construct($base_url);
        if (sizeof($_POST) < 1) {
            header("Location: /");
        }
    }

    public function Login() {
        if (gettype($this->isLoginUser()) == 'object') {
            header("Location: /");
        }
        if (@$_POST['u_password'] != '' && @$_POST['u_name'] != '') {
            @$_POST['u_password'] = md5(@$_POST['u_password']);
            $query = $this->GetInfoUser($_POST);
            if (@$query->num_rows() > 0) {
                $query = $query->row();
                if (@$query->u_hash == '') {
                    $this->UpdateInfoUser(array('u_password' => @$query->u_password), array("u_hash" => md5(uniqid(rand(), true))));
                    $query = $this->GetInfoUser($_POST)->row();
                }
                $this->session->set_userdata("tp_user", $query);
                $this->Alert('success', "bienvenido " . $query->u_name, '');
                $this->JS('window.location.href="/";');
            } else {
                $this->Alert("danger", "el nombre de usuario o contraseña son incorrectos", 'warning');
            }
        }
    }

    public function UpdateInfoUser($where, $data) {
        $this->db->update('ms_users', $data, $where);
    }

    public function GetInfoUser($array) {
        if (sizeof($array) > 0) {
            return $this->db->get_where('ms_users', $array);
        }
    }

}
