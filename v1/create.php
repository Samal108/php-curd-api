<?php
header("Access-control-Allow-Origin:*");
header("Content-Type:application/json;UTF-8");
header("Access-Control-Allow-methods:POST");
header("Access-Control-Allow-headers:Allow-Controi-Allow-Origin,Contact-Type,Allow-Control-Allow-Method");

//includ file
include_once("../config/database.php");
include_once("../classes/student.php");

//db connection
$db=new Database();
$connection=$db->getConnection();
$student=new student($connection);
if($_SERVER['REQUEST_METHOD'] === 'POST'){
  $data = json_decode(file_get_contents("php://input"));
  if(!empty($data->name)&& !empty($data->email)&& !empty($data->age)){
    $student->name=$data->name;
    $student->email=$data->email;
    $student->age=$data->age;

if($student->create_student()){
        http_response_code(201);
        echo "student create sucessfuly";
      }else{
      echo "faild to craete student";
      }
}else{
   echo "Invalid Request";
  
  }

 }else{
   echo "Acess Denied";
   
}



?>