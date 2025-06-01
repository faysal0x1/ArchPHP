<?php

namespace Core;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Matcher\UrlMatcher;

class Router
{
	private RouteCollection $routes;
	private RequestContext $context;
	private array $middlewares = [];

	public function __construct()
	{
		$this->routes = new RouteCollection();
		$this->context = new RequestContext();
	}

	public function get(string $path, $handler, array $middlewares = []): void
	{
		$this->addRoute('GET', $path, $handler, $middlewares);
	}

	public function post(string $path, $handler, array $middlewares = []): void
	{
		$this->addRoute('POST', $path, $handler, $middlewares);
	}

	public function put(string $path, $handler, array $middlewares = []): void
	{
		$this->addRoute('PUT', $path, $handler, $middlewares);
	}

	public function patch(string $path, $handler, array $middlewares = []): void
	{
		$this->addRoute('PATCH', $path, $handler, $middlewares);
	}

	public function delete(string $path, $handler, array $middlewares = []): void
	{
		$this->addRoute('DELETE', $path, $handler, $middlewares);
	}

	private function addRoute(string $method, string $path, $handler, array $middlewares): void
	{
		$route = new Route($path, ['_controller' => $handler]);
		$route->setMethods($method);
		$route->setOption('middlewares', $middlewares);

		$this->routes->add($method . $path, $route);
	}

	public function dispatch(Request $request): Response
	{
		// Debug information
		error_log('Original request method: ' . $request->getMethod());
		error_log('Request path: ' . $request->getPathInfo());
		error_log('Request body: ' . print_r($request->request->all(), true));
		error_log('Request headers: ' . print_r($request->headers->all(), true));
		error_log('Available routes: ' . print_r($this->routes->all(), true));

		// Handle method override for PATCH and DELETE
		if ($request->isMethod('POST')) {
			$method = $request->request->get('_method');
			error_log('Method override: ' . $method);
			if ($method === 'PATCH' || $method === 'DELETE') {
				$request->setMethod($method);
				error_log('New request method: ' . $request->getMethod());
			}
		}

		$this->context->fromRequest($request);
		$matcher = new UrlMatcher($this->routes, $this->context);

		try {
			$parameters = $matcher->match($request->getPathInfo());
			error_log('Matched route parameters: ' . print_r($parameters, true));
			$handler = $parameters['_controller'];
			unset($parameters['_controller']);

			$content = null;
			if (is_array($handler)) {
				[$controller, $method] = $handler;
				error_log('Controller: ' . $controller . ', Method: ' . $method);
				$controller = new $controller();
				$content = $controller->$method();
			} elseif (is_string($handler)) {
				$content = require $handler;
			} else {
				$content = $handler();
			}

			// If content is already a Response object, return it
			if ($content instanceof Response) {
				return $content;
			}

			// Otherwise, wrap the content in a Response object
			return new Response($content);
		} catch (\Exception $e) {
			// Add debug information
			error_log('Route not found: ' . $request->getMethod() . ' ' . $request->getPathInfo());
			error_log('Available routes: ' . print_r($this->routes->all(), true));
			error_log('Exception: ' . $e->getMessage());
			throw new \Exception('Route not found', 404);
		}
	}
}
