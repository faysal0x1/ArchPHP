<?php


$config = require 'config.php';

$db = new Database($config['database'], $config['database']['username'], $config['database']['password']);


$heading = 'Posts Page';

$posts = $db->query('SELECT * FROM posts')->fetchAll();

include 'views/posts.view.php';