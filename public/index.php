<?php 

require_once __DIR__ . '/../includes/app.php';

use Controllers\ApiEventos;
use Controllers\APIExpositores;
use Controllers\APIRegalos;
use MVC\Router;
use Controllers\AuthController;
use Controllers\DashboardController;
use Controllers\EventosController;
use Controllers\ExpositoresController;
use Controllers\PaginasController;
use Controllers\RegalosController;
use Controllers\RegistradosController;
use Controllers\RegistroController;

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
$router->get('/admin/dashboard', [DashboardController::class, 'index']); //Protegida
$router->get('/admin/expositores', [ExpositoresController::class, 'index']); // Protegida
$router->get('/admin/expositores/crear', [ExpositoresController::class, 'crear']); // Protegida
$router->post('/admin/expositores/crear', [ExpositoresController::class, 'crear']); // Protegida
$router->get('/admin/expositores/editar', [ExpositoresController::class, 'editar']); // Protegida
$router->post('/admin/expositores/editar', [ExpositoresController::class, 'editar']); // Protegida
$router->post('/admin/expositores/eliminar', [ExpositoresController::class, 'eliminar']); // Protegida
$router->get('/admin/eventos', [EventosController::class, 'index']); // Protegida
$router->get('/admin/eventos/crear', [EventosController::class, 'crear']); // Protegida
$router->post('/admin/eventos/crear', [EventosController::class, 'crear']); // Protegida
$router->get('/admin/eventos/editar', [EventosController::class, 'editar']); // Protegida
$router->post('/admin/eventos/editar', [EventosController::class, 'editar']);// Protegida
$router->post('/admin/eventos/eliminar', [EventosController::class, 'eliminar']);// Protegida
$router->get('/api/eventos-horarios', [APIEventos::class, 'index']); // Protegida
$router->get('/api/expositores', [APIExpositores::class, 'index']); // Protegida
$router->get('/api/expositor', [APIExpositores::class, 'expositor']); // Protegida
$router->get('/api/regalos', [APIRegalos::class, 'index']); // Protegida
$router->get('/admin/registrados', [RegistradosController::class, 'index']); // Protegida
$router->get('/admin/regalos', [RegalosController::class, 'index']); // Protegida


// Registro de usuarios
$router->get('/finalizar-registro', [RegistroController::class, 'crear']);
$router->post('/finalizar-registro/gratis', [RegistroController::class, 'gratis']);
$router->post('/finalizar-registro/pagar', [RegistroController::class, 'pagar']);
$router->get('/finalizar-registro/conferencias', [RegistroController::class, 'conferencias']);
$router->post('/finalizar-registro/conferencias', [RegistroController::class, 'conferencias']);

// Boleto virtual
$router->get('/boleto', [RegistroController::class, 'boleto']);


// Area publica
$router->get('/', [PaginasController::class, 'index']);
$router->get('/devwebcamp', [PaginasController::class, 'evento']);
$router->get('/paquetes', [PaginasController::class, 'paquetes']);
$router->get('/workshops-conferencias', [PaginasController::class, 'conferencias']);
$router->get('/404', [PaginasController::class, 'error']);

$router->comprobarRutas();