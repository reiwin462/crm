<?php
defined('BASEPATH') OR exit('No direct script access allowed');


$route['default_controller'] = 'crm_controller';
$route['404_override'] = 'errorControl';
$route['translate_uri_dashes'] = FALSE;



$route['crm/(:any)'] = "crm_controller/crmcontrol/$1";


