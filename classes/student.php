<?php 
class Student{
    public $id;
    public $name;
    public $email;
    public $age;
    public $conn;


    public  function __construct($db) {
        $this->conn= $db;
    }
    //create
    public function create_student(){
        $stmt=$this->conn->prepare("INSERT INTO STUDENT(name,email,age) values(?,?,?)");
        $stmt->bind_param("ssi",$this->name,$this->email,$this->age);
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }
     //retrive
    public function retrive_all_student(){
          $data=[];
          $stmt=$this->conn->prepare("SELECT id,name,email,age FROM  STUDENT");
          $stmt->execute();
          $result=$stmt->get_result();
       if($result->num_rows > 0){
        while($row=$result->fetch_assoc()){
            $data[]=$row;
        }

       }  
       return $data;
    } 
    //update 
    public  function update_student(){
            $stmt=$this->conn->prepare("UPDATE STUDENT set name=?,email=?,age=? where id=?");
            $stmt->bind_param("ssii" ,$this->name,$this->email,$this->age,$this->id);
            if($stmt->execute()){
                return true;
            }else{
                return false;
            }
    } 
    //delete
    public function delete_student(){
        $stmt=$this->conn->prepare("DELETE FROM STUDENT WHERE id=?");
        $stmt->bind_param('i',$this->id);
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }
}

?>
