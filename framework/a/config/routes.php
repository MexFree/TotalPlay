<?php

defined('BASEPATH') OR exit('No direct script access allowed');
$route['default_controller'] = 'panel/view';
$route['page(.*)'] = 'panel/view/home';
$route['genero(.*)'] = 'panel/view/search';
$route['year(.*)'] = 'panel/view/search';
$route['buscar(.*)'] = 'panel/view/search';
$route['api/(.*)'] = 'panel/api/$1';
$route['(.*)'] = 'panel/view/$1';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
