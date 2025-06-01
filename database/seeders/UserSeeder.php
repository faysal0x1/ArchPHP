<?php

use App\Models\User;

$user = new User();
$user->name = 'Admin User';
$user->email = 'admin@example.com';
$user->password = 'password123';
$user->save();
