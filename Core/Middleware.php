<?php

namespace Core;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

abstract class Middleware
{
    abstract public function handle(Request $request, callable $next): Response;

    protected function redirect(string $url): Response
    {
        return new Response('', 302, ['Location' => $url]);
    }
}
