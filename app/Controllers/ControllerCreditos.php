<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Login;
use Exception;

class ControllerCreditos extends Controller
{
    public function index(): string
    {
        return view('Creditos');
    } 

}
