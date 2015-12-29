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

    /* public function Movieadd($json, $cover) {
      $videos = $json->videos;
      unset($json->videos);
      foreach ($json as $key => $value) {
      $json->$key = trim($value);
      }
      @$json->p_date = time();
      $isMovie = $this->db->query("SELECT *  FROM `ms_peliculas` WHERE `p_seo` LIKE '" . @$json->p_seo . "'");
      if ($isMovie->num_rows() > 0) {

      } else {
      $AUTO_INCREMENT = @$this->db->query("select AUTO_INCREMENT from information_schema.TABLES where TABLE_SCHEMA='totalpla_moviescript' and TABLE_NAME='ms_peliculas'")->row()->AUTO_INCREMENT;
      write_file("./files/uploads/" . $AUTO_INCREMENT . ".jpg", file_get_contents($cover));
      $config['image_library'] = 'gd2';
      $config['source_image'] = "./files/uploads/" . $AUTO_INCREMENT . ".jpg";
      $config['create_thumb'] = FALSE;
      $config['width'] = 177;
      $config['height'] = 264;
      $config['quality'] = '100%';
      $this->image_lib->initialize($config);
      $this->image_lib->resize();
      foreach ($videos as $key => $value) {
      for ($i = 0; $i < sizeof($value); $i++) {
      $_POST['p_id'] = $AUTO_INCREMENT;
      $_POST['v_titulo'] = $key;
      $_POST['v_online'] = 1;
      $_POST['v_source'] = '<iframe src="' . $value[$i] . '" scrolling="no" frameborder="0" width="700" height="430" allowfullscreen="true" webkitallowfullscreen="true" mozallowfullscreen="true"></iframe>';
      $this->db->insert("ms_videos", $_POST);
      }
      }
      $this->db->insert("ms_peliculas", $json);
      }
      } */
}
