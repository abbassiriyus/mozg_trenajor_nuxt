<?php 

namespace Wrql\Router;

use Wrql\Helpers\Messages;

/**
 * Router
 */
class Router
{    
    /**
     * Маршруты, вида: путь -> контроллер -> метод
     *
     * @var array
     */
    private $routes = [];
    
    /**
     * __construct
     *
     * @return void
     */
    public function __construct() 
    {
        $routes = require_once 'routes.php';
        foreach ($routes as $route) {
            $this->add($route['path'], $route['controller'], $route['action']);
        }
    }
    
    /**
     * add
     *
     * @param  mixed $path
     * @param  mixed $controller
     * @param  mixed $action
     * @return void
     */
    private function add($path, $controller, $action = null)
    {
        $route = '/^\/' . preg_replace_callback('/:[a-zA-Z0-9_-]+/', function ($matches) {
            return '(?P<' . substr($matches[0], 1) . '>[a-zA-Z0-9_-]+)';
        }, preg_replace('/\//', '\\/', $path)) . '$/';
        
        array_push($this->routes, ['path' => $route, 'controller' => $controller, 'action' => $action]);
    }
        
    /**
     * init
     *
     * @return void
     */
    public function init()
    {
        $path = parse_url($_SERVER['REQUEST_URI']);

        foreach ($this->routes as $route) {
            if (preg_match($route['path'], $path['path'], $matches)) {
                $path = __DIR__.'/../App/controllers/'.$route['controller'].'Controller.php';

                if(file_exists($path)) {
                    $a = $route['controller'].'Controller';
                    $controller = 'Wrql\\App\\controllers\\' . $a;

                    if($route['action'])
                        $action = $route['action'];
                    else
                        $action = 'index';

                    return (new $controller($route['controller']))->$action();
                }else {
                    Messages::code("Файл не найден.", 404);
                    return;
                }
            }
        }
        Messages::code("Путь не найден.", 404);
    }
}
