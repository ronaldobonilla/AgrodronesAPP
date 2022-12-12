<?php
header('Access-Control-Allow-Origin: *'); 
#include 'mysql\db_connection.php';
include '/storage/ssd1/260/19457260/public_html/mysql/db_connection.php';

$cult = $_POST['cult'];


$conn = OpenCon();

$sql = "INSERT INTO CULTIVOS(CULTIVO,ESTADO) VALUES ('$cult','ACTIVO')";

$data = array();
if ($conn->query($sql) === TRUE) {
  
  $data['response'] = "Record inserted successfully" ;
  echo json_encode($data);

} else {

  $data['response'] = "Something bad happen" ;
  echo json_encode($data);
}

$conn->close();

?>