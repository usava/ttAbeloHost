<?php

namespace App\Controllers;

use App\Models\Category;

class CategoryController extends Controller
{
    public function show(int $id)
    {
        $category = new Category()->get($id);

        $filter = [];
        parse_str($_SERVER['QUERY_STRING'], $queryParams);
        $filter['sort'] = $queryParams['sort'] ?? '';

        $posts = $category->getPosts($filter);

        $this->view->smarty->assign('category', $category);
        $this->view->smarty->assign('posts', $posts);
        $this->view->smarty->display('category.tpl');
    }
}