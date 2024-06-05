<?php

namespace Controllers;

use Model\Servicio;
use MVC\Router;

class ServicioController
{
    public static function index(Router $router)
    {
        session_start();
        isAdmin();
        $alertas = [];
        $servicios = Servicio::all();

        $router->render('servicios/index', [
            'nombre' => $_SESSION['nombre'],
            'id' => $_SESSION['id'],
            'alertas' => $alertas,
            'servicios' => $servicios,
        ]);
    }

    public static function crear(Router $router)
    {
        session_start();
        isAdmin();
        $alertas = [];
        $servicio = new Servicio;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $servicio->sincronizar($_POST);
            $alertas = $servicio->validar();
            if (empty($alertas)) {
                $servicio->guardar();
                header('Location: /servicios');
            }

        }
        $router->render('servicios/crear', [
            'nombre' => $_SESSION['nombre'],
            'id' => $_SESSION['id'],
            'alertas' => $alertas,
            'servicio' => $servicio,
        ]);
    }

    public static function actualizar(Router $router)
    {
        session_start();
        isAdmin();
        $alertas = [];
        // Proteger el valor get
        $id = is_numeric($_GET['id']);
        if (!$id) {
            return;
        }

        $servicio = Servicio::find($_GET['id']);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $servicio->sincronizar($_POST);
            $servicio->guardar();
            header('Location: /servicios');

        }

        $router->render('servicios/actualizar', [
            'nombre' => $_SESSION['nombre'],
            'id' => $_SESSION['id'],
            'alertas' => $alertas,
            'servicio' => $servicio,
        ]);
    }
    public static function eliminar(Router $router)
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        }
    }
}
