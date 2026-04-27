<?php

namespace App\Controllers;

use App\Models\Post;

class IndexController extends Controller
{
    public function index()
    {
        $post = new Post()->getPost(1);

        $this->view->smarty->assign('post', $post);
        $this->view->smarty->display('index.tpl');
    }
}