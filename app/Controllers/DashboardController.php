<?php

namespace App\Controllers;

use Core\Controller;
use Symfony\Component\HttpFoundation\Response;

class DashboardController extends Controller
{
    public function index(): Response
    {
        return $this->view('dashboard/index', [
            'user' => $this->session->get('user')
        ]);
    }
}
