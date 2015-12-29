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
