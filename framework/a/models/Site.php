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
                return $this->CreateTablesDB();
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
