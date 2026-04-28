<?php
declare(strict_types=1);

namespace App;

use App\Controllers\CategoryController;
use App\Controllers\IndexController;
use App\Controllers\PostController;

class App
{
    protected static $app;
    protected Router $router;
    public function __construct()
    {
        $this->router = new Router();
        $this->initRoutes();
    }

    public function route(): void
    {
        $this->router->parse($_SERVER['REQUEST_URI']);
    }


    private function initRoutes(): void
    {
        $this->router->add('/', IndexController::class, 'index');
        $this->router->add('/post/{id}', PostController::class, 'show');
        $this->router->add('/category/{id}', CategoryController::class, 'show');
    }
}