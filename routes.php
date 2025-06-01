<?php


$router->get('/', 'controllers/index.php');
$router->get('/about', 'controllers/about.php');
$router->get('/contact', 'controllers/contact.php');

$router->get('/posts', 'controllers/posts/index.php');

$router->get('/post/create', 'controllers/posts/create.php');
$router->post('/post/store', 'controllers/posts/store.php');

$router->get('/post/edit', 'controllers/posts/edit.php');

$router->patch('/post/update', 'controllers/posts/update.php');


$router->get('/post', 'controllers/posts/show.php');
$router->delete('/post/delete', 'controllers/posts/destroy.php');
