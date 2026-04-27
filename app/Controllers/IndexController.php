<?php

namespace App\Controllers;

class IndexController extends Controller
{
    public function __construct()
    {
        parent::__construct();

    }
    public function index()
    {
        $this->view->smarty->display('index.tpl');
    }
}