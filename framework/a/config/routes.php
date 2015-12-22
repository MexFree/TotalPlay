<?php

defined('BASEPATH') OR exit('No direct script access allowed');
$route['default_controller'] = 'panel/view';
$route['api/(.*)'] = 'panel/api/$1';
$route['(.*)'] = 'panel/view/$1';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
