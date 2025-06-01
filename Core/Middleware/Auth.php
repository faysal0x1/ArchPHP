<?php

namespace Core\Middleware;

use Core\Middleware;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class Auth extends Middleware
{
    public function handle(Request $request, callable $next): Response
    {
        if (!isset($_SESSION['user'])) {
            return $this->redirect('/login');
        }

        return $next($request);
    }
}
