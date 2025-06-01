<?php

namespace App\Controllers;

class ContactController
{
    public function index()
    {
        return view('contact.view.php', [
            'heading' => 'Contact Us'
        ]);
    }
}
