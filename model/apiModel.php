<?php

/*
 * @Author: Marcin Szostak
 * @Date: 08-13-2017
 * @Title: Code review
 * @Description: Simple API
 */

class apiModel extends model
{
    private $id;
    private $data = array();
    private $response = array();
    
    public function __construct($id)
    {
        parent::__construct();
        
        $this->id = $this->mysqli->real_escape_string($id);
        
        $this->getVariables();
    }
    
    // This method grabs data from $_GET variable
    public function getVariables()
    {
        foreach($this->columnHeaders as $column)
        {
            if(isset($_GET[$column]))
                $this->data[$column] = $this->mysqli->real_escape_string(strtolower(urldecode($_GET[$column])));
        }
    }
    
    // This method checks row exist
    private function checkId()
    {
        $query = "SELECT * FROM `".$this->table."` WHERE `id` LIKE '".$this->id."'";
        $res = $this->mysqli->query($query);
        
        if($res->num_rows > 0)
            return true;
        else
            return false;
    }
    
    // This method create row
    public function create()
    {
        if(!$this->checkId())
        {
            $query = "INSERT INTO `".$this->table."` SET ";
            foreach($this->data as $column => $value)
            {
                $query .= "`".$column."`='".$value."', ";
            }
            $query = substr($query,0,-2);
            $this->mysqli->query($query);
            
            $this->response['status'] = "Ok";
            $this->response['note'] = "Your primary is: ".$this->mysqli->insert_id;
        }
        else
        {
            $this->response['status'] = "Error";
            $this->response['note'] = "This id exist in table already!";
        }
    }
    
    // This method read all rows
    public function readAll()
    {
        $query = "SELECT * FROM `".$this->table."`";
        $res = $this->mysqli->query($query);
        if($res->num_rows > 0)
        {
            while($row = $res->fetch_assoc())
            {
                $this->response['status'] = "Ok";
                $this->response[$row['primary']] = $row;
            }
        }
        else
        {
            $this->response['status'] = "Error";
            $this->response['note'] = "No rows returned";
        }
    }
    
    // This method read one row
    public function read()
    {
        $query = "SELECT * FROM ".$this->table." WHERE `id` LIKE '".$this->id."'";
        $res = $this->mysqli->query($query);
        if($res->num_rows > 0)
        {
            while($row = $res->fetch_assoc())
            {
                $this->response['status'] = "Ok";
                $this->response[$row['primary']] = $row;
            }
        }
        else
        {
            $this->response['status'] = "Error";
            $this->response['note'] = "No row returned";
        }
    }
    
    // This method update one row
    public function update()
    {
        $query = "UPDATE `".$this->table."` SET ";
        
        foreach($this->data as $column => $value)
        {
            if($column !== 'id')
                $query .= "`".$column."`='".$value."', ";
        }
        $query = substr($query,0,-2)." WHERE `id` ='".$this->data['id']."'";
        $res = $this->mysqli->query($query);
    }
    
    // This method delete one row
    public function delete()
    {
        $query = "DELETE FROM `".$this->table."` WHERE `id`='".$this->id."'";
        $res = $this->mysqli->query($query);
        if(!$this->checkId())
        {
            $this->response['status'] = "Ok";
            $this->response['note'] = "Row removed";
        }
        else
        {
            $this->response['status'] = "Error";
            $this->response['note'] = "No row removed";
        }
    }
    
}
