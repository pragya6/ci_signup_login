<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        echo "Session: " . $_SESSION["username"];
        return view('templates/navbar') . view('formfile/form') . view('templates/footer');
    }
}
