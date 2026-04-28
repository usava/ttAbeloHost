<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Models\Post;
use Smarty\Exception;

class PostController extends Controller
{
    /**
     * @throws \Exception
     */
    public function show(int $id): void
    {
        $post = new Post()->get($id);
        $category = $post->getCategory();

        $this->smarty->assign('post', $post);
        $this->smarty->assign('category', $category);
        try {
            $this->smarty->display('post.tpl');
        } catch (Exception $e) {
            echo "Error displaying template: " . $e->getMessage();
        }
    }
}