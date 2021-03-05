<?php

namespace Databases;

use PDO;
use PDOException;

class Connection{
    //static variables
    protected  $host='127.0.0.1',$db='my_db', $port='3306';
    private  $db_username='micp', $db_password='12345';
    public $conn;
    //create connection
    public function __construct(){
       
        try{
            $this->conn = new PDO("mysql:host=".$this->host.";port=".$this->port.";dbname=".$this->db.";",
                $this->db_username,$this->db_password); 
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  
        }
        catch(PDOException $e){
            echo $e->getMessage();
        }
    }
    //close connection
    public function close(){
        $this->conn = NULL;
    }
    
}