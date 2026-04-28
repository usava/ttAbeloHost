<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Models\Category;
use Smarty\Exception;

class IndexController extends Controller
{
    /**
     * @throws \Exception
     */
    public function index(): void
    {
        $categories = new Category()->getAll();
        $this->smarty->assign('categories', $categories);

        try {
            $this->smarty->display('main.tpl');
        } catch (Exception $e) {
            echo "Error displaying template: " . $e->getMessage();
        }
    }
}