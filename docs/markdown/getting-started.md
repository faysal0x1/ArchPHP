# Getting Started with ArchPHP

Welcome to ArchPHP, a lightweight and modern PHP framework designed for building robust web applications. This guide will help you get started with the framework.

## Quick Start

1. Clone the repository
2. Configure your web server to point to the `public` directory
3. Copy `config.example.php` to `config.php` and update the settings
4. Start building your application!

## Basic Example

Here's a simple example of how to create a route and controller:

```php
// routes.php
$router->get('/', 'HomeController@index');
$router->post('/users', 'UserController@store');

// HomeController.php
class HomeController {
    public function index() {
        return view('home');
    }
}
```

## Framework Features

- **MVC Architecture**: Clean separation of concerns
- **Simple Routing**: Easy-to-use routing system
- **Database Abstraction**: Powerful database layer
- **Template Engine**: Flexible view system
- **Security Features**: Built-in security measures
- **Easy API**: Developer-friendly interface

## Next Steps

- [Installation Guide](/installation)
- [Routing Documentation](/routing)
- [Controllers Guide](/controllers)
- [Views Documentation](/views) 