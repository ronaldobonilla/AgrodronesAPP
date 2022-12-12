<?php
header('Access-Control-Allow-Origin: *'); 
#include 'mysql\db_connection.php';
include '/storage/ssd1/260/19457260/public_html/mysql/db_connection.php';


$cult = $_POST['cult'];

$conn = OpenCon();
$sql = "DELETE  FROM CULTIVOS WHERE CULTIVO='$cult' ;";

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