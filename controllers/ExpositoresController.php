<?php

namespace Controllers;

use Classes\Paginacion;
use Model\Expositor;
use MVC\Router;
use Intervention\Image\ImageManagerStatic as Image;

class ExpositoresController {
    public static function index(Router $router) {
        $pagina_actual = $_GET['page'];
        $pagina_actual = filter_var($pagina_actual, FILTER_VALIDATE_INT);
        if(!$pagina_actual || $pagina_actual < 1) {
            header('Location: /admin/expositores?page=1');
        }

        $registros_por_pagina = 2;
        $total = Expositor::total();
        $paginacion = new Paginacion($pagina_actual, $registros_por_pagina, $total);

        if($paginacion->total_paginas() < $pagina_actual) {
            header('Location: /admin/expositores?page=1');
        }

        $expositores = Expositor::paginar($registros_por_pagina, $paginacion->offset());

        if(!is_admin()) {
            header('Location: /login');
        }
   
        $router->render('admin/expositores/index', [
            'titulo' => 'Expositores / Conferencistas',
            'expositores' => $expositores,
            'paginacion' => $paginacion->paginacion()
        ]);
    }


    public static function crear(Router $router) {

        if(!is_admin()) {
            header('Location: /login');
        }
        $alertas = [];
        $expositor = new Expositor;

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            if(!is_admin()) {
                header('Location: /login');
            }
            // Leer Imagen
            if(!empty($_FILES['imagen']['tmp_name'])) {
                $carpeta_imagenes = '../public/img/speakers';

                // Crear la carpeta si no existe
                if(!is_dir($carpeta_imagenes)) {
                    mkdir($carpeta_imagenes, 0777, true);
                }

                $imagen_png = Image::make($_FILES['imagen']['tmp_name'])->fit(800,800)->encode('png', 80);
                $imagen_webp = Image::make($_FILES['imagen']['tmp_name'])->fit(800,800)->encode('webp', 80);

                $nombre_imagen = md5(uniqid(rand(), true));
                $_POST['imagen'] = $nombre_imagen;
            }


            $_POST['redes'] = json_encode($_POST['redes'], JSON_UNESCAPED_SLASHES);
            $expositor->sincronizar($_POST);

            //Validar
            $alertas = $expositor->validar();

            // Guardar el registro
            if(empty($alertas)) {
                // Guardar la imagenes
                $imagen_png->save($carpeta_imagenes . '/' . $nombre_imagen . ".png");
                $imagen_webp->save($carpeta_imagenes . '/' . $nombre_imagen . ".webp");

                // Guardar en la base de datos
                $resultado = $expositor->guardar();

                if($resultado) {
                    header('Location: /admin/expositores');
                }
            }
        }

        $router->render('admin/expositores/crear', [
            'titulo' => 'Registrar Expositor',
            'alertas' => $alertas,
            'expositor' => $expositor,
            'redes' => json_decode($expositor->redes)
        ]);
    }


    public static function editar(Router $router) {

            if(!is_admin()) {
                header('Location: /login');
            }
        $alertas = [];
      // Validar id
        $id = $_GET['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);

        if(!$id) {
            header('Location: /admin/expositores');
        }

        // Obtener expositor a editar
        $expositor = Expositor::find($id);

        if(!$expositor) {
            header('Location: /admin/expositores');
        }

        $expositor->imagen_actual = $expositor->imagen;

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            if(!is_admin()) {
                header('Location: /login');
            }
              // Leer Imagen
            if(!empty($_FILES['imagen']['tmp_name'])) {
                $carpeta_imagenes = '../public/img/speakers';

                // Crear la carpeta si no existe
                if(!is_dir($carpeta_imagenes)) {
                    mkdir($carpeta_imagenes, 0777, true);
                }

                $imagen_png = Image::make($_FILES['imagen']['tmp_name'])->fit(800,800)->encode('png', 80);
                $imagen_webp = Image::make($_FILES['imagen']['tmp_name'])->fit(800,800)->encode('webp', 80);

                $nombre_imagen = md5(uniqid(rand(), true));
                $_POST['imagen'] = $nombre_imagen;
            } else {
                $_POST['imagen'] = $expositor->imagen_actual;
            }
            $_POST['redes'] = json_encode($_POST['redes'], JSON_UNESCAPED_SLASHES);
            $expositor->sincronizar($_POST);

            $alertas = $expositor->validar();

            if(empty($alertas)) {
                if(isset($nombre_imagen)) {
                    $imagen_png->save($carpeta_imagenes . '/' . $nombre_imagen . ".png");
                    $imagen_webp->save($carpeta_imagenes . '/' . $nombre_imagen . ".webp");
                }
                $resultado = $expositor->guardar();
                if($resultado) {
                    header('Location: /admin/expositores');
                }
            }
        }
        

        $router->render('admin/expositores/editar', [
            'titulo' => 'Actualizar Expositor',
            'alertas' => $alertas,
            'expositor' => $expositor,
            'redes' => json_decode($expositor->redes)
        ]);
    }

    public static function eliminar() {
         if($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            if(!is_admin()) {
                header('Location: /login');
            }

            $id = $_POST['id'];
            $expositor = Expositor::find($id);
            if(isset($expositor)) {
                header('Location: /admin/expositores');
            }
            $resultado = $expositor->eliminar();

            if($resultado) {
                header('Location: /admin/expositores');
            }
         }
    }
}