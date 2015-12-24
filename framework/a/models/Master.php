<?php

/*
 * Proyecto progamado por xlFederalElk0lx.
 * Informes coil811122@icloud.com
 */

/**
 * Description of Master
 *
 * @author xlfederalelk0lx
 */
class Master extends TP_Model {

    public function __construct() {
        parent::__construct();
    }

    public function Jsonencode($str) {
        return str_replace(array('"', "\\\'"), array("'", "\\'"), json_encode($str));
    }

}
