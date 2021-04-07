<?php

/*
 * @Author: Marcin Szostak
 * @Date: 08-13-2017
 * @Title: Code review
 * @Description: Simple API
 */


class mainController extends controller
{
    public function __construct()
    {
        // If path is not set, we will checks data in table first
        if(!isset($_GET['path']))
        {
            $data = new updateData();
        }
        else
        {
            $path = strtolower($_GET['path']);
            $path = rtrim($path,'/');
            $path = explode('/',$path);
            
            $file = 'controller/'.$path[0].'Controller.php';
            
            // Checking if controller exist
            if(is_file($file))
            {
                $className = $path[0].'Controller';
                $id = (int)$path[2];
                $controller = new $className($path[1], $id);
            }
            else
            {
                $this->getView('error');
            }
            
        }
    }
    
}
