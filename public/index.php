<?php 

require_once __DIR__ . '/../includes/app.php';

use Controllers\ApiEventos;
use MVC\Router;
use Controllers\AuthController;
use Controllers\DashboardController;
use Controllers\EventosController;
use Controllers\ExpositoresController;
use Controllers\RegalosController;
use Controllers\RegistradosController;

$router = new Router();


// Login
$router->get('/login', [AuthController::class, 'login']);
$router->post('/login', [AuthController::class, 'login']);
$router->post('/logout', [AuthController::class, 'logout']);

// Crear Cuenta
$router->get('/registro', [AuthController::class, 'registro']);
$router->post('/registro', [AuthController::class, 'registro']);

// Formulario de olvide mi password
$router->get('/olvide', [AuthController::class, 'olvide']);
$router->post('/olvide', [AuthController::class, 'olvide']);

// Colocar el nuevo password
$router->get('/reestablecer', [AuthController::class, 'reestablecer']);
$router->post('/reestablecer', [AuthController::class, 'reestablecer']);

// Confirmación de Cuenta
$router->get('/mensaje', [AuthController::class, 'mensaje']);
$router->get('/confirmar-cuenta', [AuthController::class, 'confirmar']);

// Area de administracion
$router->get('/admin/dashboard', [DashboardController::class, 'index']);

$router->get('/admin/expositores', [ExpositoresController::class, 'index']);
$router->get('/admin/expositores/crear', [ExpositoresController::class, 'crear']);
$router->post('/admin/expositores/crear', [ExpositoresController::class, 'crear']);
$router->get('/admin/expositores/editar', [ExpositoresController::class, 'editar']);
$router->post('/admin/expositores/editar', [ExpositoresController::class, 'editar']);
$router->post('/admin/expositores/eliminar', [ExpositoresController::class, 'eliminar']);

$router->get('/admin/eventos', [EventosController::class, 'index']);
$router->get('/admin/eventos/crear', [EventosController::class, 'crear']);
$router->post('/admin/eventos/crear', [EventosController::class, 'crear']);

$router->get('/api/eventos-horarios', [ApiEventos::class, 'index']);

$router->get('/admin/registrados', [RegistradosController::class, 'index']);

$router->get('/admin/regalos', [RegalosController::class, 'index']);


$router->comprobarRutas();