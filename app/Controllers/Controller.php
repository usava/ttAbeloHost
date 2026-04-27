<?php

namespace App\Controllers;

use App\View;

class Controller
{
    protected View $view;

    public function __construct()
    {
        $this->view = View::getInstance();
    }

}