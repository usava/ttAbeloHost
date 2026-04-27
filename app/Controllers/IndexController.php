<?php

namespace App\Controllers;

use App\Models\Category;
use App\Models\Post;

class IndexController extends Controller
{
    public function index()
    {
        $post = new Post()->get(1);
        $categories = new Category()->getAll();

        $this->view->smarty->assign('categories', $categories);
        $this->view->smarty->assign('post', $post);
        $this->view->smarty->display('index.tpl');
    }
}