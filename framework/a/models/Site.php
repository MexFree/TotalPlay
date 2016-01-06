<?php

/*
 * Proyecto progamado por xlFederalElk0lx.
 * Informes coil811122@icloud.com
 */

/**
 *
 * @author xlfederalelk0lx
 */
class Site extends TP_Model {

    public function __construct() {
        parent::__construct();
    }

    public function Search() {
        if (@$_POST['q'] != '') {
            $this->JS("window.location.href='/buscar/" . urlencode($_POST['q']) . "';");
        }
    }

    public function Webdelete() {
        $this->isLoginUser();
        if ($this->db->query("SELECT *  FROM `ms_links` WHERE `l_id` LIKE '" . @$_POST['l_id'] . "'")->num_rows() > 0) {
            $this->db->query("DELETE FROM `ms_links` WHERE `l_id` = " . @$_POST['l_id'] . ";");
            $this->Alert("success", "web amiga eliminada correctamente", "check-circle");
            $this->JS("location.reload();");
        } else {
            $this->Alert("danger", "web amiga no existe", "warning");
        }
    }

    public function Webedit() {
        $this->isLoginUser();
        $id = $_POST['l_id'];
        if ($this->db->query("SELECT *  FROM `ms_links` WHERE `l_id` LIKE '" . $id . "'")->num_rows() > 0) {
            $this->db->set($_POST);
            $this->db->where("l_id", $id);
            $this->db->update('ms_links');
            $this->Alert("success", "datos actualizados", "check-circle");
            $this->JS("location.reload();");
        } else {
            $this->Alert("danger", "web amiga no existe", "warning");
        }
    }

    public function Webadd() {
        $this->isLoginUser();
        if (filter_var(@$_POST['l_url'], FILTER_VALIDATE_URL)) {
            if ($this->db->query("SELECT *  FROM `ms_links` WHERE `l_url` LIKE '" . @$_POST['l_url'] . "'")->num_rows() > 0) {
                $this->Alert("danger", "ya existe una web amiga registrada con esta url", "warning");
            } else {
                $this->db->insert("ms_links", $_POST);
                $this->Alert("success", "web amiga agregada", "check-circle");
                $this->JS("location.reload();");
            }
        } else {
            $this->Alert("danger", "url invalida", "warning");
        }
    }

    public function Advertising() {
        $this->isLoginUser();
        foreach ($_POST as $key => $value) {
            $isPubli = $this->db->query("SELECT *  FROM `ms_publicidad` WHERE `ad_key` LIKE '" . $key . "'");
            if ($isPubli->num_rows() > 0) {
                $this->db->update('ms_publicidad', array("ad_code" => $value), array("ad_key" => $key));
            } else {
                $this->db->insert('ms_publicidad', array("ad_key" => $key, "ad_code" => $value));
            }
        }
        $this->Alert("success", "datos actualizados", "check-circle");
        $this->JS("location.reload();");
    }

    public function Update() {
        $this->isLoginUser();
        $id = $_POST['w_id'];
        unset($_POST['w_id']);
        $this->db->set($_POST);
        $this->db->where("w_id", $id);
        if ($this->db->update('ms_config')) {
            $this->Alert("success", "datos actualizados", "check-circle");
            $this->JS("location.reload();");
        } else {
            $this->Alert("danger", "ocurrion un error al actualizar algun dato", "warning");
        }
    }

    public function Install() {
        if (filter_var(@$_POST['direccion'], FILTER_VALIDATE_URL)) {
            if (filter_var(@$_POST['email'], FILTER_VALIDATE_EMAIL) && filter_var(@$_POST['email_user'], FILTER_VALIDATE_EMAIL)) {
                if (@$_POST['password'] == @$_POST['re_password']) {
                    if ($this->TestConnect()) {
                        if ($this->CreateDatabaseFile()) {
                            if ($this->AddAutoloadDB()) {
                                if ($this->InsertConfiguration()) {
                                    $this->Alert("success", "instalacion completa", "check-circle");
                                    $this->JS("location.reload();");
                                }
                            }
                        }
                    }
                } else {
                    $this->Alert("danger", "los contraseñas para el area de administracion no coinciden", "warning");
                }
            } else {
                $this->Alert("danger", "alguno de los correos es incorrecto", "warning");
            }
        } else {
            $this->Alert("danger", "direccion de tu sitio invalida", "warning");
        }
    }

    private function InsertConfiguration() {
        $w = array(
            'w_titulo' => @$_POST['nombre'],
            'w_slogan' => @$_POST['lema'],
            'w_url' => @$_POST['direccion'],
            'w_tema' => "default",
            'w_mail' => @$_POST['email']
        );
        $u = array(
            'u_name' => @$_POST['usuario'],
            'u_password' => md5(@$_POST['password']),
            'u_email' => @$_POST['email_user'],
            'u_rango' => 1
        );

        if (!$this->db->insert("ms_config", $w)) {
            $this->Alert("danger", "no logro insertar los datos de la web" . $this->db->error()['message'], "warning");
            return FALSE;
        } else {
            if (!$this->db->insert("ms_users", $u)) {
                $this->Alert("danger", "no se logro crear tu cuenta de administrador", "warning");
                return FALSE;
            } else {
                $this->Alert("success", "datos insertados correctamente", "check-circle");
                return TRUE;
            }
        }
    }

    private function CreateTablesDB() {
        $txt = read_file("./install/sql.sql");
        if ($txt) {
            $txt = explode("--------------------------------------------------------", $txt);
            for ($i = 0; $i < sizeof($txt); $i++) {
                if (!$this->db->simple_query(trim($txt[$i]))) {
                    $this->Alert("danger", "ocurrion un error al crear las tablas, verifica que estas utilizando una base de datos limpia: " . $this->db->error()['message'], "warning");
                    return FALSE;
                }
            }
            $this->Alert("success", "tablas creadas correctamente en la base de datos", "check-circle");
            return TRUE;
        } else {
            $this->Alert("danger", "verifica que el archivo <strong>/install/sql.sql</strong> tenga permisos: 666, o que exista", "warning");
        }
        return FALSE;
    }

    private function AddAutoloadDB() {
        $txt = str_replace(array('"database"', "libraries'] = array("), array('', "libraries'] = array('database',"), read_file("./framework/a/config/autoload.php"));
        if (write_file("./framework/a/config/autoload.php", $txt)) {
            $this->Alert("success", "archivo de configuracion modificado", "check-circle");
            return TRUE;
        } else {
            $this->Alert("danger", "verifica que el archivo <strong>/framework/a/config/autoload.php</strong> tenga permisos: 666, o que exista", "warning");
        }
    }

    private function CreateDatabaseFile() {
        $txt = read_file("./framework/a/config/database.php");
        if ($txt) {
            $a = array('localhost', "'username' => ''", "'password' => ''", "'database' => ''");
            $b = array(@$_POST['servidor'], "'username' => '" . @$_POST['db_user'] . "'",
                "'password' => '" . @$_POST['db_password'] . "'", "'database' => '" . @$_POST['db_name'] . "'");
            $txt = str_replace($a, $b, $txt);
            if (write_file("./framework/a/config/database.php", $txt)) {
                $this->Alert("success", "archivo de configuracion de la base de datos modificado", "check-circle");
                $txt = str_replace("cambio_database", @$_POST['db_name'], read_file("./framework/a/models/Movie.php"));
                if (write_file("./framework/a/models/Movie.php", $txt)) {
                    return $this->CreateTablesDB();
                } else {
                    $this->Alert("danger", "error al escribir en contraldor de acciones de peliculas", "warning");
                }
            } else {
                $this->Alert("danger", "verifica que el archivo <strong>/framework/a/config/database.php</strong> tenga permisos: 666, o que exista", "warning");
            }
        } else {
            $this->Alert("danger", "verifica que el archivo <strong>/framework/a/config/database.php</strong> tenga permisos: 666, o que exista", "warning");
        }
    }

    private function TestConnect() {
        $config['hostname'] = @$_POST['servidor'];
        $config['username'] = @$_POST['db_user'];
        $config['password'] = @$_POST['db_password'];
        $config['database'] = @$_POST['db_name'];
        $config['dbdriver'] = 'mysqli';
        $config['dbprefix'] = '';
        $config['pconnect'] = FALSE;
        $config['db_debug'] = TRUE;
        $config['cache_on'] = FALSE;
        $config['cachedir'] = '';
        $config['char_set'] = 'utf8';
        $config['dbcollat'] = 'utf8_general_ci';
        $this->load->database($config);
        return TRUE;
    }

}
