<?php 

namespace Wrql\App\controllers;

use Wrql\Core\Controller;
use Wrql\App\models\userModel;

use Wrql\Helpers\Messages;

class userController extends Controller
{

    public $data;

    public function index()
    {
    }

    public function registration()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            if(isset($_POST['username']) && isset($_POST['password']) && isset($_POST['email'])) {

                $this->model = new userModel();
                $this->data = $this->model->registration($_POST['email'], $_POST['username'], $_POST['password']);

                echo json_encode($this->data);

            } else {
                Messages::code("Данные не введены.", 400, false);
            }
            
        } else {
            Messages::code("Метод не разрешен.", 405, false);
        }
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            if(isset($_POST['username']) && isset($_POST['password'])) {

                $this->model = new userModel();
                $this->data = $this->model->login($_POST['username'], $_POST['password']);

                echo json_encode($this->data);

            } else {
                Messages::code("Данные не введены.", 400, false);
            }
            
        } else {
            Messages::code("Метод не разрешен.", 405, false);
        }
    }

    public function getuserinfo()
    { 
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            if(isset($_POST['token'])) {

                $this->model = new userModel();
                $this->data = $this->model->getuserinfo($_POST['token']);

                echo json_encode($this->data);

            } else {
                Messages::code("Данные не введены.", 400, false);
            }
            
        } else {
            Messages::code("Метод не разрешен.", 405, false);
        }
    }

    public function checkauth()
    { 
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            if(isset($_POST['token'])) {

                $this->model = new userModel();
                $this->data = $this->model->checkAuth($_POST['token']);

                echo json_encode($this->data);

            } else {
                Messages::code("Данные не введены.", 400, false);
            }
            
        } else {
            Messages::code("Метод не разрешен.", 405, false);
        }
    }

}