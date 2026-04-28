<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Models\Category;
use Smarty\Exception;

class CategoryController extends Controller
{
    /**
     * @throws \Exception
     */
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
        $filter['page'] = $this->pagination($pagesCount, $filter['page']);
        $posts = $category->getPosts($filter);

        $this->smarty->assign('category', $category);
        $this->smarty->assign('posts', $posts);
        try {
            $this->smarty->display('category.tpl');
        } catch (Exception $e) {
            echo "Error displaying template: " . $e->getMessage();
        }
    }

    /**
     * @param $pagesCount
     * @param int $page
     * @return int
     */
    protected function pagination($pagesCount, int $page): int
    {
        $visiblePages = 5;
        $page_from = max(1, $page - floor($visiblePages / 2));
        $page_to = min($page_from + $visiblePages, $pagesCount);
        $this->smarty->assign([
            'visible_pages' => $visiblePages,
            'page_offset' => floor($visiblePages / 2),
            'current_page' => $page,
            'range' => range($page_from, $page_to),
        ]);
        $this->smarty->assign('pages_count', $pagesCount);
        return min($page, $pagesCount);
    }
}