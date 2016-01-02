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
                    } elseif ($page == 'home') {
                        $this->data['peliculas' . date("Y")] = $this->db->query("SELECT * FROM `ms_peliculas` WHERE  `p_ano` =" . date("Y") . " ORDER BY `p_date` DESC LIMIT 0 , 30");
                        $this->data['peliculas'] = $this->db->query("SELECT * FROM `ms_peliculas` ORDER BY RAND() LIMIT 30");
                        $limit = ($this->uri->segment(2) == '') ? 0 : ($this->uri->segment(2) - 1) * 30;
                        $this->data['recientes'] = $this->db->query("SELECT * FROM  `ms_peliculas` ORDER BY `p_date` DESC LIMIT " . $limit . " , 30");
                        $this->data['top20'] = $this->db->query("SELECT * FROM  `ms_peliculas` ORDER BY `p_hits` DESC LIMIT 0 , 20");
                    } elseif ($page == 'search') {
                        $item = $this->uri->segment(1);
                        $limit = ($this->uri->segment(3) == '') ? 0 : ($this->uri->segment(3) - 1) * 30;
                        if ($item == 'genero') {
                            $this->data['search'] = $this->db->query("SELECT *  FROM `ms_generos` WHERE `g_seo` LIKE '" . $this->uri->segment(2) . "'")->row();
                            if (@$this->data['search']->g_id != '') {
                                @$this->data['search']->titulo = 'Peliculas de ' . @$this->data['search']->g_nombre;
                                $this->data['recientes'] = $this->db->query("SELECT * FROM  `ms_peliculas` WHERE  `p_genero` =" . @$this->data['search']->g_id . " ORDER BY `p_date` DESC LIMIT " . $limit . " , 30");
                            }
                        } else if ($item == 'year') {
                            @$this->data['search']->p_ano = $this->uri->segment(2);
                            @$this->data['search']->titulo = 'Peliculas del Año ' . $this->uri->segment(2);
                            $this->data['recientes'] = $this->db->query("SELECT * FROM  `ms_peliculas` WHERE  `p_ano` =" . $this->uri->segment(2) . " ORDER BY `p_date` DESC LIMIT " . $limit . " , 30");
                        } else if ($item == 'buscar') {
                            @$this->data['search']->p_titulo = urldecode($this->uri->segment(2));
                            @$this->data['search']->titulo = 'Peliculas con ' . urldecode($this->uri->segment(2));
                            $this->data['recientes'] = $this->db->query("SELECT *  FROM `ms_peliculas` WHERE `p_titulo` LIKE '%" . urldecode($this->uri->segment(2)) . "%' ORDER BY `p_date` DESC LIMIT " . $limit . " , 30");
                        }
                    } elseif ($page == 'ver') {
                        $seo = explode("-", str_replace("-online.html", "", $this->uri->segment(2)));
                        $year = $seo[sizeof($seo) - 1];
                        unset($seo[sizeof($seo) - 1]);
                        $seo = implode("-", $seo);
                        $this->data['movie'] = $this->db->query("SELECT *  FROM  `ms_generos`,`ms_peliculas` WHERE `ms_generos`.`g_id` LIKE `ms_peliculas`.`p_genero` AND `ms_peliculas`.`p_seo` LIKE '" . $seo . "' AND `ms_peliculas`.`p_ano` = " . $year)->row();
                        if (@$this->data['movie']->p_id != '') {
                            @$this->data['movie']->p_hits = @$this->data['movie']->p_hits + 1;
                            $this->db->query("UPDATE `ms_peliculas` SET  `p_hits` =  '" . @$this->data['movie']->p_hits . "' WHERE `p_id` =" . @$this->data['movie']->p_id . ";");
                            @$this->data['videos'] = $this->db->query("SELECT *  FROM `ms_videos` WHERE `p_id` = " . $this->data['movie']->p_id . " ORDER BY `v_titulo` ASC ");
                            @$this->data['config']->w_imagen = @$this->data['config']->w_url . "/files/uploads/" . $this->data['movie']->p_id . ".jpg";
                            @$this->data['config']->w_titulo = ucwords(@$this->data['movie']->p_titulo) . " - " . @$this->data['config']->w_site_name;
                            @$this->data['config']->w_descripcion = @$this->data['movie']->p_sinopsis;
                            @$this->data['config']->w_url.="/ver/" . $this->data['movie']->p_seo . "-" . $this->data['movie']->p_ano . "-online.html";
                        }
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
