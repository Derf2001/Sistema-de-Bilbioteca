<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Login;
use Exception;

class ControllerLogin extends Controller
{
    public function index(): string
    {
        return view('Login');
    }

    public function obtener_admin()
    {
        $name = $this->request->getVar('name');
        $pass = $this->request->getVar('pass');
        try {
            $login = new Login();
            $resultado = $login->obtenerAdminLogin($name, $pass);
            if ($resultado) {
                $session = \Config\Services::session();
                // Iniciar la sesión
                $session->start();

                // Guardar datos en la sesión
                $session->set('sesion', 'aceptada');

                echo json_encode($resultado);
            }else {
                echo json_encode($resultado);
            }
        } catch (Exception $e) {
            // Manejar la excepción (por ejemplo, loggearla, mostrar un mensaje de error, etc.)
            echo json_encode(['error' => $e->getMessage()]);
        }
    }
    public function cerrarSession()
    {
        $session = \Config\Services::session();
        // Iniciar la sesión
        $serrar = $this->request->getVar('cerrar');
        $session->start();
        $session->remove('sesion');
        $session->destroy();
        echo json_encode(['error' => $serrar]);
    }
}
