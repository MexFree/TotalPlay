<?php

/*
 * Proyecto progamado por xlFederalElk0lx.
 * Informes coil811122@icloud.com
 */

/**
 * Description of TP_C
 *
 * @author xlfederalelk0lx
 */
class TP_Controller extends CI_Controller {

    public $data = array();

    public function __construct() {
        parent::__construct();
        //$this->isInstall();
    }

    private function isLoginUser() {
        @$this->data['tp_user'] = @$this->session->userdata('tp_user');
    }

    private function LoadConfigSite() {
        $query = $this->db->query("SELECT *  FROM `ms_config` WHERE `w_id` = 1");
        if ($query->num_rows() > 0) {
            $query = $query->row();
            @$query->w_site_name = $query->w_titulo;
            @$query->w_titulo.=" - " . $query->w_slogan;
            @$query->w_url = str_replace("ms.", "www.", @$query->w_url);
            @$query->w_imagen = @$query->w_url . "/favicon.png";
            @$this->data['config'] = $query;
            @$this->data['generos'] = $this->db->query("SELECT * FROM `ms_generos` ORDER BY `ms_generos`.`g_nombre` ASC");
            define("Theme", "../../../theme/" . @$query->w_tema . "/");
            define("Modulo", "../../../theme/" . @$query->w_tema . "/modulos/");
            define("Pages", "../../../theme/" . @$query->w_tema . "/pages/");
        } else {
            $this->load->view(pages . "error_404");
        }
    }

    public function isInstall() {
        if (@$this->db->database == '') {
            if (!defined("Pages")) {
                define("Pages", "../../../theme/default/pages/");
            }
            @$this->data['config']->w_titulo = "Instalador by xlFederalElk0lx";
            @$this->data['config']->w_url = "http://" . $_SERVER['SERVER_NAME'];
            $map = directory_map('./files/', 1);
            if (gettype($map) == 'array') {
                if (!file_exists("./files/avatar")) {
                    mkdir("./files/avatar", 0777);
                    $this->LoadConfig();
                }
                if (!file_exists("./files/uploads")) {
                    mkdir("./files/uploads", 0777);
                    $this->LoadConfig();
                }
                if (sizeof($map) == 2) {
                    @$this->data['permisos']->files = (substr(sprintf('%o', fileperms('./files/')), -3)) == '777' ? true : false;
                    @$this->data['permisos']->avatar = (substr(sprintf('%o', fileperms('./files/avatar')), -3)) == '777' ? true : false;
                    @$this->data['permisos']->uploads = (substr(sprintf('%o', fileperms('./files/uploads')), -3)) == '777' ? true : false;
                    $this->load->view("../../../install/index", $this->data);
                }
            } else if (gettype($map) == 'boolean') {
                if (!file_exists("./files")) {
                    mkdir("./files", 0777);
                    $this->LoadConfig();
                }
                if (!file_exists("./files/avatar")) {
                    mkdir("./files/avatar", 0777);
                    $this->LoadConfig();
                }
                if (!file_exists("./files/uploads")) {
                    mkdir("./files/uploads", 0777);
                    $this->LoadConfig();
                }
            }
            return FALSE;
        } else {
            $this->LoadConfigSite();
            $this->isLoginUser();
        }
        return TRUE;
    }

}
