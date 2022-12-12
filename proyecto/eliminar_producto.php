<?php
header('Access-Control-Allow-Origin: *'); 
#include 'mysql\db_connection.php';
include '/storage/ssd1/260/19457260/public_html/mysql/db_connection.php';

#$json = file_get_contents('php://input');
#$data = json_decode($json);

#$prod = $data->prod;
$prod = $_POST['prod'];

$conn = OpenCon();

$sql = "DELETE  FROM PRODUCTOS WHERE PRODUCTO='$prod' ;";
$data = array();
if ($conn->query($sql) === TRUE) {
  
  $data['response'] = "Record deleted successfully" ;
  echo json_encode($data);

} else {

  $data['response'] = "Something bad happen" ;
  echo json_encode($data);
}

$conn->close();

?>