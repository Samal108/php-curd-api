<?php 
header("Access-Control-Allow-Origin:*");
header("Content-Type:application/json;UTF-8");
header("Access-Control-Allow-Methods:GET");
header("Access-Control-Allow-Headers:Access-Control-Allow-Origin,Content-Type,Access-Control-Allow-Methods");

include_once("../config/database.php");
include_once("../classes/student.php");
$db=new Database();
$connection=$db->getConnection();

$student=new student($connection);
if($_SERVER['REQUEST_METHOD']==='GET'){
    
        $data=$student->retrive_all_student();

        if(!empty($data)){
           http_response_code(200);
           echo json_encode(array("status"=>1, "massage"=>"Data retrive sucessfully","resData"=>$data));
        }else{
           http_response_code(200);
           echo json_encode(["status"=>0,"message"=>"No data found","resData"=>$data]);
        }

}else{
    http_response_code(503);
        echo json_encode(array("status"=>0,"meassage"=>"accsess denied"));
}



?>
