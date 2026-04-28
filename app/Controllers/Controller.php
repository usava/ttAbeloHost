<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Models\Category;
use Smarty\Smarty;

class Controller
{
    protected Smarty $smarty;

    public function __construct()
    {
        $this->initSmarty();
        $this->initFunctions();
    }

    protected function initSmarty(): void
    {
        $this->smarty = new Smarty();
        $this->smarty->setTemplateDir('../tpl/');
        $this->smarty->setCompileDir('../tpl/compiled/');
        $this->smarty->setConfigDir('../tpl/config/');
        $this->smarty->setCacheDir('../tpl/cache/');
        $this->smarty->setEscapeHtml(true);
    }

    public function initFunctions(): void
    {
        $this->smarty->registerPlugin('function', 'get_category_posts', [$this, 'getCategoryPosts']);
    }

    public function getCategoryPosts($params, $smarty): void
    {
        if(empty($params['category_id']) || empty($params['var'])) {
            return;
        }

        $categoryId = (int)$params['category_id'];
        $categoryModel = new Category();
        $category = $categoryModel->get($categoryId);
        $posts = $category ? $category->getPosts($params) : [];

        $smarty->assign($params['var'], $posts);
    }
}