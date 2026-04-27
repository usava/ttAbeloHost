<?php

namespace App\Controllers;

use App\Models\Post;

class PostController extends Controller
{
    public function show(int $id)
    {
        $post = new Post()->get($id);
        $category = $post->getCategory();

        $this->view->smarty->assign('post', $post);
        $this->view->smarty->assign('category', $category);
        $this->view->smarty->display('post.tpl');
    }
}