<?php
header('Access-Control-Allow-Origin: *'); 
#include 'mysql\db_connection.php';
include '/storage/ssd1/260/19457260/public_html/mysql/db_connection.php';

$user = $_POST['user'];
$pass = $_POST['pass'];
$name = $_POST['name'];
$type = $_POST['type'];

$conn = OpenCon();

$sql = "INSERT INTO USERS(USERNAME,PASSWORD,NAME,TYPE,ESTADO,CREATED_AT)
VALUES ('$user', '$pass', '$name','$type','ACTIVO',Now())";

$sql2 = "INSERT INTO ";

$data = array();
if ($conn->query($sql) === TRUE) {

  
  $data['response1'] = "Record modified successfully" ;
  echo json_encode($data);
 
  
  
    
  
  }

  

else {

  $data['response1'] = "Something bad happen" ;
  echo json_encode($data);
}
$conn->close();

?>