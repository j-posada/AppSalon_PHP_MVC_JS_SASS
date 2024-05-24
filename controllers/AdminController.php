<?php

namespace Controllers;

use MVC\Router;

class AdminController
{
    public static function index(Router $router)
    {
        session_start();
        isAuth();
        $alertas = [];
        $router->render('admin/index', [
            'nombre' => $_SESSION['nombre'],
            'id' => $_SESSION['id'],
            'alertas' => $alertas,
        ]);
    }
}
