<?php

/*
 * @Author: Marcin Szostak
 * @Date: 08-13-2017
 * @Title: Code review
 * @Description: Simple API
 */

abstract class model
{
    protected $mysqli;
    protected $table = "exampleData";
    protected $columnHeaders = [
        '0' => 'albumId',
        '1' => 'id',
        '2' => 'title',
        '3' => 'url',
        '4' => 'thumbnailUrl',
    ];

    public function __construct()
    {
        try
        {
            $this->mysqli = new mysqli(MYSQLI_HOST, MYSQLI_USER, MYSQLI_PASSWORD, MYSQLI_DB, MYSQLI_PORT);
            
            if($this->mysqli->errno != 0)
            {
                throw new Exception('Unable to connect with Database!');
            }
        }
        catch (Exception $e) 
        {
            echo $e->getMessage();
        }
    }
    
    public function loadModel($name)
    {
        
    }
}
