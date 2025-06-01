<?php

namespace Core;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;

abstract class Controller
{
    protected $session;
    protected $request;
    protected $response;

    public function __construct()
    {
        $this->session = new Session();
        $this->response = new Response();
    }

    protected function view(string $view, array $data = []): Response
    {
        $content = $this->renderView($view, $data);
        return $this->response->setContent($content);
    }

    protected function json(array $data, int $status = 200): Response
    {
        $response = new Response();
        return $response
            ->setContent(json_encode($data))
            ->setStatusCode($status)
            ->headers->set('Content-Type', 'application/json');
    }

    protected function redirect(string $url): Response
    {
        $response = new Response();
        return $response->setStatusCode(302)->headers->set('Location', $url);
    }

    private function renderView(string $view, array $data): string
    {
        extract($data);
        ob_start();
        include dirname(__DIR__) . "/views/{$view}.php";
        return ob_get_clean();
    }
}
