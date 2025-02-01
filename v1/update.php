<?php 
 header("Access-control-Allow-Origin:*");
 header("Content-Type:application/json;UTF-8");
 header("Access-Control-Allow-methods:PUT,OPSTION");
 header("Access-Control-Allow-headers:Allow-Controi-Allow-Origin,Contact-Type,Allow-Control-Allow-Method");
 
 if($_SERVER['REQUEST_METHOD']==='OPSTION'){
    header("Access-control-Allow-Origin:*");
    header("Allow-Control-Allow-Method:PUT");
    header('http/1.1 200 ok');
 }
 include_once("../config/database.php");
 include_once("../classes/student.php");
 $db=new Database();
$connection=$db->getConnection();

// create student obj
 $student=new Student($connection);
if($_SERVER['REQUEST_METHOD']==='PUT'){

    //read post data
  $data=json_decode(file_get_contents("php://input"));
  if(!empty($data->name)&& !empty($data->email)&& !empty($data->age)&& isset(($_GET['id']))){
    //set data in student object
    $student->name=$data->name;
    $student->email=$data->email;
    $student->age=$data->age;
    $student->id=$_GET['id'];

    if($student->update_student()){
        http_response_code(201);
        echo json_encode(array
        ("satus"=>1,"message"=>"student created sucessfully"));
    }else{
        http_response_code(503);
        echo json_encode(array(
            "status"=>0,
            "massage"=>"failed to create student"
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