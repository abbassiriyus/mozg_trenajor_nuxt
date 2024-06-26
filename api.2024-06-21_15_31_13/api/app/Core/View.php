<?php 

namespace Wrql\Core;

class View
{	
	public function render($template, $data = [])
	{

		if(is_array($data)) {
			extract($data);
		}
		
        $path = __DIR__.'/../App/views/'.$template;

        if(file_exists($path)) {
            require_once $path;
        }else {
            echo "404 - file not found";
        }
	}
}
