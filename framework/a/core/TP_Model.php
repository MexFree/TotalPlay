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

    public function __construct() {
        parent::__construct();
    }

    public function JS($codigo) {
        echo "<script>" . $codigo . "</script>";
    }

    public function Alert($tipo, $mensaje, $fa_icon) {
        echo '<div class="alert alert-' . $tipo . '" role=alert> <strong><span class="fa fa-' . $fa_icon . '"></span></strong>' . $mensaje . '.</div>';
    }

}
