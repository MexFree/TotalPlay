<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Panel extends TP_Controller {

    public function view($page = 'home') {
        if ($this->isInstall()) {
            if ($page == 'Logout') {
                $this->session->sess_destroy();
                header("Location: /");
            } else {
                @$this->data['page'] = Pages . $page;
                if (@$this->data['config']->w_offline > 0) {
                    @$this->data['page'] = Pages . '404';
                } else {
                    if (@$page == 'Configuration' || @$page == 'Advertising' || @$page == 'Webs') {
                        @$this->data['page'] = Modulo . "site/" . $page;
                    } elseif ($page == 'Movies') {
                        $page = ($this->uri->segment(2) == '') ? "movies" : $this->uri->segment(2);
                        $this->data['movies'] = $this->db->query("SELECT * FROM  `ms_peliculas` ORDER BY `p_titulo` ASC");
                        if ($page == 'Videos') {
                            if ($this->uri->segment(3) != '') {
                                $this->data['movie'] = $this->db->query("SELECT *  FROM `ms_peliculas` WHERE `p_id` = " . $this->uri->segment(3))->row();
                                $this->data['videos'] = $this->db->query("SELECT *  FROM `ms_videos` WHERE `p_id` = " . $this->uri->segment(3));
                                if (@$this->data['movie']->p_id == '') {
                                    header("Location: /Movies");
                                }
                            } else {
                                header("Location: /Movies");
                            }
                        }
                        @$this->data['page'] = Modulo . "movie/" . $page;
                    }
                }
                @$this->data['page'] = strtolower(@$this->data['page']);
                $this->NewTitle($page);
                $this->load->view(Theme . "index", $this->data);
            }
        }
    }

    public function api($model) {
        $model = explode("_", $model);
        if (@$model[0] != '' && @$model[1] != '') {
            $this->load->model(ucfirst(trim(@$model[0])), 'Totalplay');
            @$model[1] = ucfirst(trim(@$model[1]));
            $this->Totalplay->$model[1]();
        } else {
            echo "error en la peticion";
        }
    }

}
