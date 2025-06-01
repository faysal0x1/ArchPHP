<?php

namespace App\Controllers;

use Core\Controller;
use App\Models\User;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function showLogin(): Response
    {
        return $this->view('auth/login');
    }

    public function login(Request $request): Response
    {
        $email = $request->request->get('email');
        $password = $request->request->get('password');

        $user = User::authenticate($email, $password);

        if ($user) {
            $this->session->set('user', $user);
            return $this->redirect('/dashboard');
        }

        return $this->view('auth/login', [
            'error' => 'Invalid credentials'
        ]);
    }

    public function showRegister(): Response
    {
        return $this->view('auth/register');
    }

    public function register(Request $request): Response
    {
        $user = new User();
        $user->name = $request->request->get('name');
        $user->email = $request->request->get('email');
        $user->password = $request->request->get('password');

        if ($user->save()) {
            $this->session->set('user', $user);
            return $this->redirect('/dashboard');
        }

        return $this->view('auth/register', [
            'error' => 'Registration failed'
        ]);
    }

    public function logout(): Response
    {
        $this->session->remove('user');
        return $this->redirect('/login');
    }
}
