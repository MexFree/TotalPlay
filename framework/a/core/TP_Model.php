<?php

/*
 * Proyecto progamado por xlFederalElk0lx.
 * Informes coil811122@icloud.com
 */

/**
 * Description of TP_M
 *
 * @author xlfederalelk0lx
 */
class TP_Model extends CI_Model {

    public function __construct($base_url = null) {
        parent::__construct($base_url);
    }

    public function escape($cadena_entrada) {
        $cadena_salida = "";
        $longitud = strlen($cadena_entrada);
        for ($cuenta = 0; $cuenta < $longitud; $cuenta++) {
            $cadena_salida.="%" . dechex(ord(substr($cadena_entrada, $cuenta, 1)));
        }
        return $cadena_salida;
    }

    public function Jsonencode($str) {
        return str_replace(array('"', "\\\'"), array("'", "\\'"), json_encode($str));
    }

    public function character_limiter($str, $limit = 76, $end = '...') {
        if ($limit > strlen($str)) {
            return ucfirst($str);
        } else {
            $str = str_split($str);
            $cadena = '';
            for ($i = 0; $i < $limit; $i++) {
                $cadena.=$str[$i];
            }
            return ucfirst($cadena . $end);
        }
    }

    public function Paginacion($uri = 2, $search = array(), $limit = 30) {
        $this->load->library('pagination');
        $config['uri_segment'] = $uri;
        if (sizeof($search) > 0) {
            $config['base_url'] = "http://" . $_SERVER['HTTP_HOST'] . "/" . $this->uri->segment(1) . "/" . $this->uri->segment(2) . '/';
            foreach ($search as $key => $value) {
                $config['total_rows'] = $this->db->query("select * from ms_peliculas where " . $key . " like '%" . $value . "%'")->num_rows();
            }
        } else {
            $config['base_url'] = '/page/';
            $config['total_rows'] = $this->db->query("select * from ms_peliculas")->num_rows();
        }
        $config['per_page'] = $limit;
        $config['use_page_numbers'] = TRUE;
        $config['num_links'] = 3;
        $config['next_link'] = false;
        $config['prev_link'] = false;
        $this->pagination->initialize($config);
        echo $this->pagination->create_links();
    }

    public function unescape($cadena_entrada) {
        $cadena_salida = "";
        $longitud = strlen($cadena_entrada);
        if (($longitud % 3) == 0) {
            for ($cuenta = 0; $cuenta < $longitud; $cuenta+=3) {
                $cadena_salida.=chr(hexdec(substr($cadena_entrada, $cuenta + 1, 2)));
            }

            return $cadena_salida;
        } else {
            return "Cadena no valida";
        }
    }

    public function JS($codigo) {
        echo "<script>" . $codigo . "</script>";
    }

    public function Alert($tipo, $mensaje, $fa_icon) {
        echo '<div class="alert alert-' . $tipo . '" role=alert> <strong><span class="fa fa-' . $fa_icon . '"></span></strong>' . $mensaje . '.</div>';
    }

    public function CleanSeo($url) {
        $find = array('á', 'é', 'í', 'ó', 'ú', 'ñ', 'Á', 'É', 'Í', 'Ó', 'Ú', 'Ñ');
        $repl = array('a', 'e', 'i', 'o', 'u', 'n', 'a', 'e', 'i', 'o', 'u', 'n');
        $url = strtolower($url);
        $url = str_replace($find, $repl, $url);
        $find = array(' ', '&', '\r\n', '\n', '+');
        $url = str_replace($find, '-', $url);
        $find = array('/[^a-z0-9\-<>]/', '/[\-]+/', '/<[^>]*>/');
        $repl = array('', '-', '');
        $url = preg_replace($find, $repl, $url);
        return $url;
    }

    public function cut_str($str, $left, $right) {
        $str = substr(stristr($str, $left), strlen($left));
        $leftLen = strlen(stristr($str, $right));
        $leftLen = $leftLen ? -($leftLen) : strlen($str);
        $str = substr($str, 0, $leftLen);
        return $str;
    }

    public function UploadImg($base_name, $new_height = 0, $new_width = 0, $path = './files/uploads/') {
        $config['upload_path'] = $path;
        $config['allowed_types'] = 'jpg';
        $config['max_width'] = 1024;
        $config['max_height'] = 768;
        $config['overwrite'] = TRUE;
        $config['file_name'] = $base_name . ".jpg";
        $this->upload->initialize($config);
        if (!$this->upload->do_upload('caratula')) {
            $this->Alert("danger", "ocurrio un error al subir la imagen.", "warning");
            exti();
        } else {
            if ($new_height > 0 && $new_width > 0) {
                $config['image_library'] = 'gd2';
                $config['source_image'] = $path . $base_name . ".jpg";
                $config['create_thumb'] = FALSE;
                $config['width'] = $new_width;
                $config['height'] = $new_height;
                $this->image_lib->initialize($config);
                if (!$this->image_lib->resize()) {
                    $this->Alert("danger", "error al redimenzionar la imagen", "warning");
                    exit();
                } else {
                    return true;
                }
            }
            return true;
        }
    }

}
