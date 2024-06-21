<?php 

namespace Wrql\App\controllers;

use Wrql\Core\Controller;
use Wrql\App\models\mainModel;

class mainController extends Controller
{

    public $data;

    public function index()
    {
        $this->model = new mainModel();
        $this->data = $this->model->getData();
        $this->view->render('main.php', $this->data);
    }

}