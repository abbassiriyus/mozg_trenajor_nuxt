<?php 

namespace Wrql\App\controllers;

use Wrql\Core\Controller;
use Wrql\App\models\gameModel;

use Wrql\Helpers\Messages;

class gameController extends Controller
{

    public $data;

    public function index()
    {
    }

    public function getliked()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {

            $this->model = new gameModel();
            if(isset($_GET['token'])) {
                $this->data = $this->model->getliked($_GET['token']);
            }

            if(isset($this->data)) {
                echo json_encode($this->data);
            }else{
                echo json_encode([
                    "message" => "Данные успешно получены.",
                    "data" => null,
                    "code" => 200
                ]);
            }
            
        } else {
            Messages::code("Метод не разрешен.", 405, false);
        }
    }

    public function getall()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {

            $this->model = new gameModel();
            if(isset($_GET['token'])) {
                $this->data = $this->model->getall($_GET['token']);
            }else {
                $this->data = $this->model->getall(null);
            }

            echo json_encode($this->data);
            
        } else {
            Messages::code("Метод не разрешен.", 405, false);
        }
    }

    public function getone()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {

            if(isset($_GET['id'])) {
                $this->model = new gameModel();
                $this->data = $this->model->getone($_GET['id']);

                echo json_encode($this->data);
            } else {
                Messages::code("Данные не введены.", 400, false);
            }
            
        } else {
            Messages::code("Метод не разрешен.", 405, false);
        }
    }

    public function endgame()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            if(isset($_POST['data'])) {
                $this->model = new gameModel();
                $this->data = $this->model->endgame($_POST['data']);

                echo json_encode($this->data);
            } else {
                Messages::code("Данные не введены.", 400, false);
            }
            
        } else {
            Messages::code("Метод не разрешен.", 405, false);
        }
    }

    public function createsession()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            if(isset($_POST['token'])) {
                $this->model = new gameModel();
                $this->data = $this->model->createsession($_POST['token']);

                echo json_encode($this->data);
            } else {
                Messages::code("Данные не введены.", 400, false);
            }
            
        } else {
            Messages::code("Метод не разрешен.", 405, false);
        }
    }

    public function getstats() {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {

            if(isset($_GET['game_id'])) {
                $this->model = new gameModel();
                $this->data = $this->model->getstats($_GET['game_id']);

                echo json_encode($this->data);
            } else {
                Messages::code("Данные не введены.", 400, false);
            }
            
        } else {
            Messages::code("Метод не разрешен.", 405, false);
        }
    }

    public function getallstats() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            if(isset($_POST['token'])) {
                $this->model = new gameModel();
                $this->data = $this->model->getallstats($_POST['token']);

                echo json_encode($this->data);
            } else {
                Messages::code("Данные не введены.", 400, false);
            }
            
        } else {
            Messages::code("Метод не разрешен.", 405, false);
        }
    }

}