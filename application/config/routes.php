<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'admin/index';
$route['register'] = 'authorize/register';
$route['profile'] = 'admin/profile';
$route['logout'] = 'authorize/logout';
$route['callback'] = 'authorize/callback';
$route['login'] = 'authorize/login';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
