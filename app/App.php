<?php
declare(strict_types=1);

namespace App;

use App\Controllers\IndexController;
use App\Controllers\PostController;

class App
{
    protected static $app;
    protected Router $router;
    public function __construct()
    {
        if(!is_null(self::$app)) {
            return self::$app;
        }

        $this->router = new Router();
        $this->initRoutes();

        return $this;
    }

    public function route()
    {
        $this->router->parse($_SERVER['REQUEST_URI']);
    }


    private function initRoutes(): void
    {
        $this->router->add('/', IndexController::class, 'index');
        $this->router->add('/post/{id}', PostController::class, 'show');
    }
}