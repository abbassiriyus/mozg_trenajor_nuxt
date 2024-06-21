<?php 

namespace Wrql\Core;

use Wrql\Core\View;

/**
 * Controller
 */
class Controller
{    
    /**
     * route
     *
     * @var mixed
     */
    protected $route;    
    /**
     * view
     *
     * @var mixed
     */
    protected $view;    
    /**
     * model
     *
     * @var mixed
     */
    protected $model;
    
    /**
     * __construct
     *
     * @param  mixed $route
     * @return void
     */
    public function __construct($route) {
        $this->route = $route;
        $this->view = new View();
    }
}
