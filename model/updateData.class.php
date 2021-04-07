<?php

/*
 * @Author: Marcin Szostak
 * @Date: 08-13-2017
 * @Title: Code review
 * @Description: Simple API
 */

class updateData extends model
{
    private $exampleApi = "https://jsonplaceholder.typicode.com/photos";
    private $rowsCount = 500;
    
    public function __construct()
    {
        parent::__construct();
        
        $this->checkData();
    }
    
    // This method checks data in DB
    private function checkData()
    {
        $this->checkTable();
    }
    
    // This method checks rows count in table
    private function checkTable()
    {
        $query = "SELECT count(*) as `number` FROM `".$this->table."`";
        
        $res = $this->mysqli->query($query);
        $number = $res->fetch_assoc();
        
        if((int)$number['number'] < $this->rowsCount)
        {
            $this->getRecords();
        }
    }
    
    // This method download data up to "$this->rowsCount"
    public function getRecords()
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->exampleApi);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER , true);        // Declare ReturnTransfer
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);        // Set off SSL
        curl_setopt($ch, CURLOPT_TIMEOUT, 3);
        
        $response = curl_exec($ch);
        curl_close($ch);
        
        $data = json_decode($response, true);
        
        $this->mysqli->autocommit(FALSE);
        
        // Get rows up to "$this->rowsCount"
        for($i=0 ; $i < $this->rowsCount ; $i++)
        {
            $query = "INSERT INTO `".$this->table."` SET ";
            foreach($this->columnHeaders as $column)
            {
                $query .= "`".$column."`= '".$data[$i][$column]."', ";
            }
            $query = substr($query,0,-2);
            
            $this->mysqli->query($query);
            echo $query.";<br/>";
            
        }
        $this->mysqli->commit();
        $this->mysqli->autocommit(TRUE);
    }
}
