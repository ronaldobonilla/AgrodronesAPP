<?php
header('Access-Control-Allow-Origin: *'); 
#include 'mysql\db_connection.php';
include '/storage/ssd1/260/19457260/public_html/mysql/db_connection.php';

$alias = $_POST['alias'];
$model = $_POST['model'];


$conn = OpenCon();

$sql = "INSERT INTO DRONES(ALIAS,MODELO,ESTADO) VALUES ('$alias','$model','ACTIVO')";

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