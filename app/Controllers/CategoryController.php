<?php

namespace App\Controllers;

use App\Models\Category;

class CategoryController extends Controller
{
    public function show(int $id): void
    {
        $category = new Category()->get($id);

        $filter = [];
        parse_str($_SERVER['QUERY_STRING'], $queryParams);
        $filter['sort'] = $queryParams['sort'] ?? '';
        $filter['page'] = $queryParams['page'] ?? 1;
        $filter['limit'] = $_ENV['POSTS_PAGE_LIMIT'] ?? 3;
        $postsCount = $category->getPostsCount($filter);

        $pagesCount = ceil($postsCount / $filter['limit']);
        $filter['page'] = min($filter['page'], $pagesCount);
        $this->pagination($pagesCount, $filter['page']);
        $posts = $category->getPosts($filter);

        $this->view->smarty->assign('category', $category);
        $this->view->smarty->assign('posts', $posts);
        $this->view->smarty->display('category.tpl');
    }

    /**
     * @param $postsCount
     * @param array $filter
     * @return void
     */
    protected function pagination($pagesCount, int $page): void
    {
        $visiblePages = 5;
        $page_from = max(1, $page - floor($visiblePages / 2));
        $page_to = min($page_from + $visiblePages, $pagesCount);
        $this->view->smarty->assign([
            'visible_pages' => $visiblePages,
            'page_offset' => floor($visiblePages / 2),
            'current_page' => $page,
            'range' => range($page_from, $page_to),
        ]);
        $this->view->smarty->assign('pages_count', $pagesCount);
    }
}