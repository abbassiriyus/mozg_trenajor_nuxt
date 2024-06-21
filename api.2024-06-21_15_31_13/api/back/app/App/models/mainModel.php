<?php 

namespace Wrql\App\models;

use Wrql\Core\Model;

class mainModel extends Model
{
    public function getData()
    {
        return [
			"name" => "Alex",
			"age" => 22
		];
    }
}
