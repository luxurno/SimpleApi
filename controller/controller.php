<?php

/*
 * @Author: Marcin Szostak
 * @Date: 08-13-2017
 * @Title: Code review
 * @Description: Simple API
 */

abstract class controller
{
    // Redirect method
    public function redirect($url)
    {
        header('location: ', $url);
    }
    
    // Generete view
    public function getView($name, $path = 'view/')
    {
        $path = $path.$name."View.php";
        if(is_file($path))
        {
            require $path;
        }
        $name = $name."View";
            
        $newView = new $name;
    }
    
    // Generate model
    public function getModel($name, $path = 'model/')
    {
        
    }
}
