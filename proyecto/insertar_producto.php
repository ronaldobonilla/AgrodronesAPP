<?php
header('Access-Control-Allow-Origin: *'); 
#include 'mysql\db_connection.php';
include '/storage/ssd1/260/19457260/public_html/mysql/db_connection.php';

$prod = $_POST['prod'];


$conn = OpenCon();

$sql = "INSERT INTO PRODUCTOS(PRODUCTO,ESTADO) VALUES ('$prod','ACTIVO'); ";

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