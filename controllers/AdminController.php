<?php

namespace Controllers;

use Model\AdminCita;
use MVC\Router;

class AdminController
{
    public static function index(Router $router)
    {
        session_start();
        $fecha = $_GET['fecha'] ?? date('Y-m-d');

        $fechacheck = explode('-', $fecha);
        if (!checkdate($fechacheck[1], $fechacheck[2], $fechacheck[0])) {
			header('Location: /error');
		}


        // Consultar la base de datos
        $consulta = "SELECT citas.id, citas.hora, CONCAT( usuarios.nombre, ' ', usuarios.apellido) as cliente, ";
        $consulta .= " usuarios.email, usuarios.telefono, servicios.nombre as servicio, servicios.precio  ";
        $consulta .= " FROM citas  ";
        $consulta .= " LEFT OUTER JOIN usuarios ";
        $consulta .= " ON citas.usuarioId=usuarios.id  ";
        $consulta .= " LEFT OUTER JOIN citasServicios ";
        $consulta .= " ON citasServicios.citaId=citas.id ";
        $consulta .= " LEFT OUTER JOIN servicios ";
        $consulta .= " ON servicios.id=citasServicios.servicioId ";
        $consulta .= " WHERE fecha =  '" . $fecha ."'" ;
        $consulta .= " ORDER BY citas.hora ";

        $citas = AdminCita::SQL($consulta);

        isAuth();
        $alertas = [];
        $router->render('admin/index', [
            'nombre' => $_SESSION['nombre'],
            'id' => $_SESSION['id'],
            'citas' => $citas,
            'alertas' => $alertas,
            'fecha' => $fecha,
        ]);
    }
}
