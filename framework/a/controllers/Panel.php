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
                    if (@$page == 'Configuration') {
                        @$this->data['page'] = Modulo . "site/" . $page;
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
