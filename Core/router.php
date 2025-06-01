<?php

namespace Core;

class Router
{

	protected $routes = [];
	protected $basePath;

	public function __construct($basePath = '')
	{
		$this->basePath = $basePath;
	}

	/**
	 * Register a route with the router.
	 *
	 * @param string          $uri        The URI for the route.
	 * @param string|callable $controller The controller to handle the route.
	 * @return void
	 */

	public function add($method, $uri, $controller)
	{
		if (!is_string($controller) && !is_callable($controller)) {
			throw new \InvalidArgumentException("Controller must be a string or callable.");
		}

		if (empty($uri)) {
			throw new \InvalidArgumentException('URI must be provided for routes.');
		}

		$this->routes[$uri] = [
			'uri' => $uri,
			'method' => strtoupper($method),
			'controller' => $controller
		];
	}


	public function get($uri, $controller)
	{
		$this->add('GET', $uri, $controller);
	}

	public function post($uri, $controller)
	{
		if (empty($uri) || empty($controller)) {
			throw new \InvalidArgumentException('URI and controller must be provided for POST routes.');
		}

		$this->add('POST', $uri, $controller);
	}

	public function put($uri, $controller)
	{
		if (!is_string($controller) && !is_callable($controller)) {
			throw new \InvalidArgumentException("Controller must be a string or callable.");
		}

		$this->add('PUT', $uri, $controller);
	}

	public function patch($uri, $controller)
	{
		if (!is_string($controller) && !is_callable($controller)) {
			throw new \InvalidArgumentException("Controller must be a string or callable.");
		}

		$this->add('PATCH', $uri, $controller);
	}

	public function delete($uri, $controller)
	{
		if (empty($uri) || empty($controller)) {
			throw new \InvalidArgumentException('URI and controller must be provided for DELETE routes.');
		}
		$this->add('DELETE', $uri, $controller);
	}

	public function route($uri, $method = 'GET')
	{
		// Handle method spoofing for DELETE, PUT, PATCH via _method field
		if ($method === 'POST' && isset($_POST['_method'])) {
			$method = strtoupper($_POST['_method']);
		}

		foreach ($this->routes as $route) {
			if ($route['uri'] === $uri && $route['method'] === strtoupper($method)) {
				return require base_path($route['controller']);
			}
		}

		// If no route found, return 404
		$this->abort(404);
	}

	protected function abort($code = 404)
	{
		http_response_code($code);
		return require base_path('views/' . $code . '.view.php');
	}
}
