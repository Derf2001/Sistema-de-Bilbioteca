<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

 //Index page
$routes->get('/', 'Home::index');


//Alumnos CRUD
$routes->get('Alumnos', 'ControllerAlumno::index');
$routes->post('add', 'ControllerAlumno::add');
$routes->get('ObtenerAlumno/(:any)', 'ControllerAlumno::obtener_alumno/$1');
$routes->get('DeleteAlumno/(:any)', 'ControllerAlumno::eliminar_alumno/$1');
$routes->post('ActualizarAlumno', 'ControllerAlumno::actualizar_alumno');
$routes->post('busquedaSuper', 'ControllerAlumno::busquedaSuper');
$routes->post('validarUsuario', 'ControllerAlumno::validarUsuario');
 
//Bloqueos CRUD
$routes->get('Bloqueos', 'ControllerBloqueos::index');
$routes->post('Bloquear', 'ControllerBloqueos::Bloquear');
$routes->get('Desbloquear/(:num)', 'ControllerBloqueos::desbloquear/$1');
$routes->post('ObtenerUser', 'ControllerBloqueos::buscarRegistros');
$routes->post('VerificarBloqueo', 'ControllerBloqueos::VerificarBloqueo');
$routes->post('busquedaSuperBlo', 'ControllerBloqueos::busquedaSuperBlo');
$routes->post('desbloquearxDia', 'ControllerBloqueos::desbloquearxDia');

//Profesores CRUD
$routes->get('Profesores', 'ControladorProfesor::index');
$routes->post('AgregarProfesor', 'ControladorProfesor::addProfesor');
$routes->get('ObtenerProfesor/(:num)', 'ControladorProfesor::obtener_Profesor/$1');
$routes->post('ActualizarProfesor', 'ControladorProfesor::actualizar');
$routes->get('DeleteProfesor/(:num)', 'ControladorProfesor::eliminar_profesor/$1');
$routes->post('BuscarProfesorNombre', 'ControladorProfesor::BuscarProfesorNombres');

//Administrativos CRUD
$routes->get('Administrativos', 'ControllerAdministrativo::index');
$routes->post('AgregarAdministrativo', 'ControllerAdministrativo::add');
$routes->get('ObtenerAdministrativo/(:num)', 'ControllerAdministrativo::obtener_administrativo/$1');
$routes->post('ActualizarAdministrativo', 'ControllerAdministrativo::actualizar_administrativo');
$routes->get('DeleteAdministrativo/(:num)', 'ControllerAdministrativo::eliminar_administrativo/$1');
$routes->post('busquedaSuperAd', 'ControllerAdministrativo::busquedaSuperAd');
$routes->post('VerificarAdministrativo', 'ControllerAdministrativo::VerificarAdministrativo');

//Administardores CRUD 
$routes->get('Administradores', 'ControllerAdmin::index');
$routes->post('add2', 'ControllerAdmin::add');
$routes->get('ObtenerAdmin/(:num)', 'ControllerAdmin::obtener_admin/$1');
$routes->get('DeleteAdmin/(:num)', 'ControllerAdmin::eliminar_admin/$1');
$routes->post('ActualizarAdmin', 'ControllerAdmin::actualizar_admin');
$routes->post('SearchAdmin','ControllerAdmin::search_all');

//Invitados CRUD 
$routes->get('Invitados', 'ControllerInvitados::index');
$routes->post('add3', 'ControllerInvitados::add');
$routes->get('ObtenerInvitado/(:any)', 'ControllerInvitados::obtener_invitado/$1');
//$routes->get('DeleteInvitado/(:any)', 'ControllerInvitados::eliminar_invitado/$1');
$routes->post('ActualizarInvitado', 'ControllerInvitados::actualizar_invitado');
$routes->post('Search','ControllerInvitados::search_all');
$routes->post('DeleteInvitado', 'ControllerInvitados::eliminar_invitado');

//Monitoreo 
$routes->get('Monitoreo', 'ControllerMonitoreo::index');
$routes->post('Busqueda', 'Busquedas::buscarRegistros');
$routes->post('BusquedaRGA2Campos', 'Busquedas::RGA2Fechas');
$routes->post('BusquedaRGA', 'Busquedas::RGAFecha');
$routes->post('Borrar2Campos', 'Busquedas::Borrar2Fechas');
$routes->post('Borrar1Campo', 'Busquedas::Borrar1Fecha');
$routes->post('dropSala', 'ControllerMonitoreo::dropSala');
$routes->post('MostrarMonitoreo', 'Busquedas::MostrarTodos');
$routes->post('busquedaSuper_record', 'ControllerMonitoreo::busquedaSuper_record');
$routes->post('ObtenerAsientos_hilo', 'ControllerMonitoreo::ObtenerAsientos_hilo');

//Monitoreo Computo
$routes->get('MonitoreoComputo', 'ControllerMonitoreo_Computo::index');
$routes->post('BusquedaComputo', 'ControllerMonitoreo_Computo::buscarRegistrosComputo');
$routes->post('BusquedaRGA2CamposComputo', 'ControllerMonitoreo_Computo::RGA2FechasComputo');
$routes->post('BusquedaRGAComputo', 'ControllerMonitoreo_Computo::RGAFechaComputo');
$routes->post('Borrar2CamposComputo', 'ControllerMonitoreo_Computo::Borrar2FechasComputo');
$routes->post('Borrar1CampoComputo', 'ControllerMonitoreo_Computo::Borrar1FechaComputo');
$routes->post('dropSalaComputo', 'ControllerMonitoreo_Computo::dropSala');
$routes->post('MostrarMonitoreoComputo', 'ControllerMonitoreo_Computo::MostrarTodosComputo');
$routes->post('busquedaSuper_recordComputo', 'ControllerMonitoreo_Computo::busquedaSuper_recordComputo');
$routes->post('ObtenerAsientos_hilo2', 'ControllerMonitoreo_Computo::ObtenerAsientos_hilo2');
$routes->get('VelidarAll_Computo/(:any)/(:any)','ControllerPrincipalComputo::VelidarAll_Computos/$1/$2');
$routes->get('Validar2_computo/(:any)/(:any)','ControllerPrincipalComputo::Validar2_Computo/$1/$2');





//PDFs
$routes->post('PDF', 'PdfController::index');
$routes->get('ConsultaAdministrador', 'ControllerAdministrativo::Consulta');

//Login
$routes->get('Login', 'ControllerLogin::index');
$routes->post('ObtenerAdminLogin', 'ControllerLogin::obtener_admin');
$routes->post('CerrarSession', 'ControllerLogin::cerrarSession');

//Creditos
$routes->get('Creditos', 'ControllerCreditos::index');

//Computo
$routes->get('PrincipalComputo','ControllerPrincipalComputo::index');
$routes->post('AgregarAsiento2', 'ControllerPrincipalComputo::add');
$routes->get('ObtenerAsientos2', 'ControllerPrincipalComputo::listar_asientos');
$routes->post('BorrarRegistro2', 'ControllerPrincipalComputo::elimregistro');
$routes->post('AgregarRecord2', 'ControllerPrincipalComputo::add2');
$routes->post('ActualizarRecord2', 'ControllerPrincipalComputo::actualizar_record');
$routes->get('ObtenerAsiento2/(:any)', 'ControllerPrincipalComputo::obtener_asiento/$1');
$routes->get('ObtenerUsers2/(:any)', 'ControllerPrincipalComputo::obtener_users/$1');
$routes->get('VerificarAsiento2/(:any)', 'ControllerPrincipalComputo::verificar_asiento/$1');

$routes->get('ObtenerAsiento2/(:any)/(:any)', 'ControllerPrincipalComputo::obtener_asiento/$1/$2');


//Email
$routes->get('Email', 'ControllerEmail::index');

//Principal
$routes->get('Principal', 'ControllerPrincipal::index');
$routes->post('AgregarAsiento', 'ControllerPrincipal::add');
$routes->get('ObtenerAsientos', 'ControllerPrincipal::listar_asientos');
$routes->post('BorrarRegistro', 'ControllerPrincipal::elimregistro');
$routes->post('AgregarRecord', 'ControllerPrincipal::add2');
$routes->post('ActualizarRecord', 'ControllerPrincipal::actualizar_record');
$routes->get('ObtenerAsiento/(:any)', 'ControllerPrincipal::obtener_asiento/$1');
$routes->get('ObtenerUsers/(:any)', 'ControllerPrincipal::obtener_users/$1');
$routes->get('VerificarAsiento/(:any)', 'ControllerPrincipal::verificar_asiento/$1');
$routes->post('BloquearPrincipal','ControllerPrincipal::bloquearPrincipal');
$routes->get('VelidarAll/(:any)/(:any)','ControllerPrincipal::ValidarAll/$1/$2');
$routes->get('Validar2/(:any)/(:any)','ControllerPrincipal::Validar2/$1/$2');
$routes->get('ObtenerAsiento/(:any)/(:any)', 'ControllerPrincipal::obtener_asiento/$1/$2');


 