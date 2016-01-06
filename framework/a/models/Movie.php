<?php

/*
 * Proyecto progamado por xlFederalElk0lx.
 * Informes coil811122@icloud.com
 */

/**
 * Description of Movie
 *
 * @author xlfederalelk0lx
 */
class Movie extends TP_Model {

    public function __construct($base_url = null) {
        parent::__construct($base_url);
        if (sizeof($_POST) < 1) {
            header("Location: /");
        }
    }

    public function Videodelete() {
        $this->isLoginUser();
        $isVideos = $this->db->query("SELECT *  FROM `ms_videos` WHERE `v_id` = " . $_POST['v_id'] . " AND `p_id` = " . $_POST['p_id']);
        if ($isVideos->num_rows() > 0) {
            if ($this->db->query("DELETE FROM `ms_videos` WHERE `v_id` = " . $_POST['v_id'] . ";")) {
                $this->Alert("success", "reproductor eliminado correctamente", "check-circle");
                $this->JS("window.location.href='/Movies/Videos/" . $_POST['p_id'] . "';");
            } else {
                $this->Alert("danger", "Ocurrio un error: " . $this->db->error()['message'], "warning");
            }
        } else {
            $this->Alert("danger", "Ocurrio un error: " . $this->db->error()['message'], "warning");
        }
    }

    public function Videoedit() {
        $this->isLoginUser();
        $isVideos = $this->db->query("SELECT *  FROM `ms_videos` WHERE `v_id` = " . $_POST['v_id'] . " AND `p_id` = " . $_POST['p_id']);
        if ($isVideos->num_rows() > 0) {
            $id = $_POST['v_id'];
            unset($_POST['v_id']);
            unset($_POST['p_id']);
            $this->db->set($_POST);
            $this->db->where("v_id", $id);
            if ($this->db->update('ms_videos')) {
                $this->Alert("success", "datos actualizados correctamente", "check-circle");
                $this->JS("location.reload();");
            } else {
                $this->Alert("danger", "Ocurrio un error: " . $this->db->error()['message'], "warning");
            }
        } else {
            $this->Alert("danger", "Ocurrio un error: " . $this->db->error()['message'], "warning");
        }
    }

    public function Videoadd() {
        $this->isLoginUser();
        if ($this->db->insert("ms_videos", $_POST)) {
            $this->Alert("success", "video agregado correctamente", "check-circle");
            $this->JS("$('form')[0].reset(); $(\"input\")[0].focus();");
        } else {
            $this->Alert("danger", "Ocurrio un error: " . $this->db->error()['message'], "warning");
        }
    }

    public function Delete() {
        $this->isLoginUser();
        $isMovie = $this->db->query("SELECT *  FROM `ms_peliculas` WHERE `p_id` = " . $_POST['p_id']);
        if ($isMovie->num_rows() > 0) {
            $isVideos = $this->db->query("SELECT *  FROM `ms_videos` WHERE `p_id` = " . $_POST['p_id']);
            if ($isVideos->num_rows() > 0) {
                $this->Alert("danger", "no puedes eliminar esta pelicula tiene " . $isVideos->num_rows() . " reproductores asignados", "warning");
            } else {
                if ($this->db->query("DELETE FROM `ms_peliculas` WHERE `p_id` = " . $_POST['p_id'] . ";")) {
                    $this->Alert("success", "pelicula eliminada correctamente", "check-circle");
                    $this->JS("location.reload();");
                } else {
                    $this->Alert("danger", "Ocurrio un error: " . $this->db->error()['message'], "warning");
                }
            }
        } else {
            $this->Alert("danger", "pelicula no encontrada", "warning");
        }
    }

    public function Update() {
        $this->isLoginUser();
        if (@$_POST['p_id'] != '' && filter_var($_POST['p_id'], FILTER_VALIDATE_INT)) {
            $isMovie = $this->db->query("SELECT *  FROM `ms_peliculas` WHERE `p_id` = " . $_POST['p_id']);
            if ($isMovie->num_rows() > 0) {
                foreach ($_POST as $key => $value) {
                    $_POST[$key] = strtolower($value);
                }
                @$_POST['p_seo'] = $this->CleanSeo($_POST['p_titulo']);
                $id = $_POST['p_id'];
                unset($_POST['p_id']);
                if (is_uploaded_file(@$_FILES["caratula"]["tmp_name"]) || @$_FILES["caratula"]["tmp_name"] != '') {
                    $this->UploadImg($id, 264, 177);
                    $this->Alert("success", "caratula de pelicula cambiada correctamente", "check-circle");
                }
                $this->db->set($_POST);
                $this->db->where("p_id", $isMovie->row()->p_id);
                if ($this->db->update('ms_peliculas')) {
                    $this->Alert("success", "pelicula actualizada correctamente", "check-circle");
                    $this->JS("location.reload();");
                } else {
                    $this->Alert("danger", "ocurrion un error al actualizar la pelicula", "warning");
                }
            } else {
                $this->Alert("danger", "id de pelicula no encontrado", "warning");
            }
        }
    }

    public function Add() {
        $this->isLoginUser();
        foreach ($_POST as $key => $value) {
            $_POST[$key] = strtolower($value);
        }
        @$_POST['p_seo'] = $this->CleanSeo($_POST['p_titulo']);
        @$_POST['p_date'] = time();
        $AUTO_INCREMENT = @$this->db->query("select AUTO_INCREMENT from information_schema.TABLES where TABLE_SCHEMA='cambio_database' and TABLE_NAME='ms_peliculas'")->row()->AUTO_INCREMENT;
        if ($AUTO_INCREMENT < 1) {
            $this->Alert("danger", 'lo sentimos ocurrio un error al obtener un id', "warning");
        } else {
            if (!is_uploaded_file(@$_FILES["caratula"]["tmp_name"]) || @$_FILES["caratula"]["tmp_name"] == '') {
                $this->Alert("danger", "Falta elegir la imagen a subir", "warning");
            } else {
                if ($this->UploadImg($AUTO_INCREMENT, 264, 177)) {
                    $sql = $this->db->insert_string('ms_peliculas', $_POST);
                    if ($this->db->simple_query($sql)) {
                        $this->JS('$("fieldset").html(\'<img src="/files/uploads/' . $AUTO_INCREMENT . '.jpg" height="235" width="192" />\');');
                        $this->Alert("success", "Imagen subida y pelicula agregada correctamente", "check-circle");
                        $this->JS("$('form')[0].reset(); $(\"input\")[0].focus();");
                    } else {
                        $this->Alert("danger", "no logro insertar los datos de la web" . $this->db->error()['message'], "warning");
                    }
                }
            }
        }
    }

    public function Like() {
        if (!$_COOKIE['movie_like_' . $_POST['id']]) {
            $votos = $this->db->query("select p_votos from ms_peliculas where p_id like " . $_POST['id'])->row();
            setcookie('movie_like_' . $_POST['id'], TRUE, time() + 7776000, '/');
            $this->db->set(array("p_votos" => ($votos->p_votos + 1)));
            $this->db->where("p_id", $_POST['id']);
            if ($this->db->update('ms_peliculas')) {
                $this->Alert("success", "tu voto se ha contado", "check-circle");
                $this->JS('$(".p_votos").html("' . ($votos->p_votos + 1) . '");');
            }
        } else {
            $this->Alert("danger", "ya has votado", "check-circle");
        }
    }

    public function Report() {
        if (!$_COOKIE['movie_report_' . $_POST['id']]) {
            setcookie('movie_report_' . $_POST['id'], TRUE, time() + 7776000, '/');
            $this->db->set(array("p_reports" => 1));
            $this->db->where("p_id", $_POST['id']);
            if ($this->db->update('ms_peliculas')) {
                $this->Alert("success", "tu reporte se ha registrado", "check-circle");
            }
        } else {
            $this->Alert("danger", "ya la has reportado", "check-circle");
        }
    }

    public function Remote() {
        $_POST['datos'] = json_decode(base64_decode($_POST['datos']));
        print_r(@$_POST['datos']);
    }

}
