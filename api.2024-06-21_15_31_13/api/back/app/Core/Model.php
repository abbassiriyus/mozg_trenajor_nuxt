<?php 

namespace Wrql\Core;

use PDO;
use PDOException;

class Model
{
    private $db_host = 'localhost';
    private $db_name = 'u2545578_lksaru';
    private $db_username = 'u2545578_lksaru';
    private $port = "3306";
    private $db_password = 'jA0tE0eV2wfO3aS7';

    public $db;

    public function __construct() {

        $this->dbConnect();
        
    }

    public function dbConnect()
    {
        try{
            $this->db = new PDO('mysql:host='.$this->db_host.'; port='.$this->port.'; dbname='.$this->db_name.'; charset=utf8',$this->db_username,$this->db_password);
        }catch(PDOException $e){
            echo "Connection error ".$e->getMessage(); 
            exit;
        }
    }
}
