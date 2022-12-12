<?php
header('Access-Control-Allow-Origin: *'); 
#include 'mysql\db_connection.php';
include '/storage/ssd1/260/19457260/public_html/mysql/db_connection.php';

$id = (int)$_POST['id'];
$res = $_POST['res'];


$conn = OpenCon();



$sql = "UPDATE IMAGES
SET RESULT = '$res'
WHERE ID = '$id' ; ";

if ($conn->query($sql) === TRUE) {
  echo "Result inserted succesfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}
  
  



$conn->close();

?>