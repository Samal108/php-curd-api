<?php 
 class Database{
     private $hostname;
     private $dbname;
     private $username;
     private $password;
     private $conn;

     public function getConnection(){
        $this->hostname="localhost";
        $this->dbname="student_db";
        $this->username="root";
        $this->password="";
        $this-> conn=new mysqli($this->hostname,$this->username,$this->password,$this->dbname);

        if($this->conn->connect_error){
            print_r($this->conn->connect_error);
            exit;
        }else{
            return $this->conn;
        }

     }
     
 }


?>