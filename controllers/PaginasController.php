<?php

namespace Controllers;

use Model\Evento;
use MVC\Router;
use Model\Categoria;
use Model\Dia;
use Model\Hora;
use Model\Expositor;

class PaginasController {

    public static function index(Router $router) {

        $eventos = Evento::ordenar('hora_id', 'ASC');

        $eventos_formateados = [];
        foreach($eventos as $evento) {
            $evento->categoria = Categoria::find($evento->categoria_id);
            $evento->dia = Dia::find($evento->dia_id);
            $evento->hora = Hora::find($evento->hora_id);
            $evento->expositor = Expositor::find($evento->expositor_id);

            if($evento->dia_id === '1' && $evento->categoria_id === '1') {
                $eventos_formateados['conferencias_j'][] = $evento;
            }

            if($evento->dia_id === '2' && $evento->categoria_id === '1') {
                $eventos_formateados['conferencias_v'][] = $evento;
            }


            if($evento->dia_id === '1' && $evento->categoria_id === '2') {
                $eventos_formateados['workshops_j'][] = $evento;
            }

            if($evento->dia_id === '2' && $evento->categoria_id === '2') {
                $eventos_formateados['workshops_v'][] = $evento;
            }
        }

        // Obtener el total de cada bloque
        $expositores_total = Expositor::total();
        $conferencias_total = Evento::total('categoria_id', 1);
        $workshops_total = Evento::total('categoria_id', 2);

        // Obtener todos los expositores
        $expositores = Expositor::all();

        $router->render('paginas/index', [
            'titulo' => 'Inicio',
            'eventos' => $eventos_formateados,
            'expositores_total' => $expositores_total,
            'conferencias_total' => $conferencias_total,
            'workshops_total' => $workshops_total,
            'expositores' => $expositores
        ]);
    }

    public static function evento(Router $router) {

        $router->render('paginas/devwebcamp', [
            'titulo' => 'Sobre TechVerse'
        ]);
    }


    public static function paquetes(Router $router) {
        $router->render('paginas/paquetes', [
            'titulo' => 'Paquetes TechVerse'
        ]);
    }


    public static function conferencias(Router $router) {

        $eventos = Evento::ordenar('hora_id', 'ASC');

        $eventos_formateados = [];
        foreach($eventos as $evento) {
            $evento->categoria = Categoria::find($evento->categoria_id);
            $evento->dia = Dia::find($evento->dia_id);
            $evento->hora = Hora::find($evento->hora_id);
            $evento->expositor = Expositor::find($evento->expositor_id);

            if($evento->dia_id === '1' && $evento->categoria_id === '1') {
                $eventos_formateados['conferencias_j'][] = $evento;
            }

            if($evento->dia_id === '2' && $evento->categoria_id === '1') {
                $eventos_formateados['conferencias_v'][] = $evento;
            }


            if($evento->dia_id === '1' && $evento->categoria_id === '2') {
                $eventos_formateados['workshops_j'][] = $evento;
            }

            if($evento->dia_id === '2' && $evento->categoria_id === '2') {
                $eventos_formateados['workshops_v'][] = $evento;
            }
        }


        $router->render('paginas/conferencias', [
            'titulo' => 'Conferencias & Workshops',
            'eventos' => $eventos_formateados
        ]);
    }

    public static function error(Router $router) {

            $router->render('paginas/error', [
            'titulo' => 'Página no encontrada'
        ]);

    }

}