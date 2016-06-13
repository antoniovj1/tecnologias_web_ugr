<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/

// PROFESOR
$route['profesor/modificar_eliminar_alerta/(:num)'] = 'profesor/modificar_eliminar_alerta/$1';
$route['profesor/crear_alerta'] = 'profesor/crear_alerta';
$route['profesor/alertas'] = 'profesor/alertas';
$route['profesor/administrar/(:num)'] = 'profesor/administrar/$1';
$route['profesor/modificar_eliminar/(:num)'] = 'profesor/modificar_eliminar/$1';
$route['profesor/crear'] = 'profesor/crear';
$route['profesor/recursos'] = 'profesor/recursos';
$route['profesor/perfil'] = 'profesor/perfil';
$route['profesor'] = 'profesor';

// ADMINISTRADOR
$route['administrador/perfil'] = 'administrador/perfil';
$route['administrador/modificar_eliminar_recurso/(:num)'] = 'administrador/modificar_eliminar_recurso/$1';
$route['administrador/crear_recurso'] = 'administrador/crear_recurso';
$route['administrador/recursos'] = 'administrador/recursos';
$route['administrador/modificar_eliminar_usuario/(:num)'] = 'administrador/modificar_eliminar_usuario/$1';
$route['administrador/alta_usuario'] = 'administrador/alta_usuario';
$route['administrador/usuarios'] = 'administrador/usuarios';
$route['administrador'] = 'administrador';

//VALIDACIONES
$route['profesor/validar_nick'] = 'profesor/validar_nick';
$route['profesor/validar_email'] = 'profesor/validar_email';
$route['administrador/validar_nick_recurso'] = 'administrador/validar_nick_recurso';
$route['administrador/validar_nick'] = 'administrador/validar_nick';
$route['administrador/validar_email'] = 'administrador/validar_email';
$route['validar_login'] = 'login/validar_login';
$route['validar_codigo'] = 'principal/validar_codigo/';
$route['validar_dni'] = 'principal/validar_dni/';


//LOGIN
$route['logout'] = 'login/logout';
$route['login'] = 'login';

//VISUALIZACIÓN
$route['visualizacion/alertas_json'] = 'visualizacion/alertas_json';
$route['visualizacion/entradas_json'] = 'visualizacion/entradas_json';
$route['visualizacion'] = 'principal/visualizacion';


//PRINCIPAL
$route['consultar_turno'] = 'principal/consultar_cancelar_turno/';
$route['add_cita/(:num)'] = 'principal/add_cita/$1';
$route['recurso/(:num)'] = 'principal/recurso/$1';
$route['default_controller'] = 'principal';

//OTROS
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
