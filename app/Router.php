<?php
declare(strict_types=1);

namespace App;

class Router
{
    protected array $routes = [];
    public function __construct() {}

    public function add(string $path, string $controller, string $method): void {
        // get {id} from path and replace it
        $path = preg_replace('/\{[a-z]+}/', '(\d+)', $path);
        $this->routes["#^" . $path . "$#"] = [$controller, $method];
    }

    public function parse(string $uri): void {
        // escape GET query string (?page=1)
        $uri = parse_url($uri, PHP_URL_PATH);

        foreach ($this->routes as $pattern => $handler) {
            if (preg_match($pattern, $uri, $matches)) {
                array_shift($matches); //

                [$controllerName, $method] = $handler;
                $controller = new $controllerName();

                // Call controller method with params
                call_user_func_array([$controller, $method], $matches);
                return;
            }
        }

        // no matches case
        http_response_code(404);
        echo "404 Not Found";
    }
}