<?php
header('Access-Control-Allow-Origin: *'); 
#include 'mysql\db_connection.php';
include '/storage/ssd1/260/19457260/public_html/mysql/db_connection.php';

$id = (int)$_POST['id'];
$inicio = $_POST['inicio'];
$final = $_POST['fin'];


$conn = OpenCon();

if(strlen($inicio) > 0){

  $sql = "UPDATE CITAS
  SET FECHA_INICIO = '$inicio'
  WHERE ID = '$id' ; ";

  if ($conn->query($sql) === TRUE) {
    echo "Fecha inicio inserted successfully";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
  
  

}else if (strlen($final) > 0){
  
  $sql = "UPDATE CITAS
  SET FECHA_FIN = '$final'
  WHERE ID = '$id' ; ";

  if ($conn->query($sql) === TRUE) {
    echo "Fecha final inserted successfully";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }

  
}

$conn->close();

?>