<?php

namespace App\Controllers;

class IndexController
{
    public function index()
    {
        $heading = 'My Home Page';

        return view('index.view.php', [
            'heading' => $heading,
        ]);
    }
}
