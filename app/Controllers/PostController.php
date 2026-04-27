<?php

namespace App\Controllers;

use App\Models\Post;

class PostController extends Controller
{
    public function show(int $id)
    {
        $post = new Post()->getPost($id);

        $this->view->smarty->assign('post', $post);
        $this->view->smarty->display('post.tpl');
    }
}