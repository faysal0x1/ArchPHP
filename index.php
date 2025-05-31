<?php
require 'Response.php';
require 'functions.php';
require 'Database.php';
require 'router.php';
$config = require 'config.php';


$db = new Database($config['database'], $config['database']['username'], $config['database']['password']);




