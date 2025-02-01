<?php
if($_SERVER['REQUEST_METHOD']==='OPSTIONS'){
  header("Access-Control-Allow-Origin:*");
  header("Access-Control-Allow-Methods:DELETE");
  header('http/1.1 200 ok');
  die();
}
header("Access-Control-Allow-Origin:*");
header("Content-Type:application/json;charset=UTF-8");
header("Access-Control-Allow-Methods:DELETE");
header("Access-Control-Allow-Headers:Access-Control-Allow-Methods,Content-Type,Access-Control-Allow-Origin");


include_once("../config/database.php");
include_once("../classes/student.php");
$db=new Database();
$connection=$db->getConnection();

// create student obj-3
$student=new Student($connection);
if($_SERVER['REQUEST_METHOD']==='DELETE'){

   //read post data
 
 if( isset(($_GET['id']))){
   //set data in student object
   
   $student->id=$_GET['id'];

   if($student->delete_student()){
       http_response_code(201);
       echo json_encode(array
       ("satus"=>1,"message"=>"student delete sucessfully"));
   }else{
       http_response_code(503);
       echo json_encode(array(
           "status"=>0,
           "massage"=>"failed to delete student"
       ));
   }
 }else{
   http_response_code(400);
   echo json_encode(array(
       "status"=>0,
       "massage"=>"Invalid request" 
   ));
 }
}else{
   http_response_code(503);
   echo json_encode(array
   ("status"=>0,
   "meassge"=>"Access Denied"));
}




?>