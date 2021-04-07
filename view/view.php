<?php

/*
 * @Author: Marcin Szostak
 * @Date: 08-13-2017
 * @Title: Code review
 * @Description: Simple API
 */

abstract class view
{
    
    // This method renders views
    public function render($url, $path = 'templates/')
    {
        if(is_dir($path.$url))
            require $path.$url.'/index.php';
    }
    
    
}
