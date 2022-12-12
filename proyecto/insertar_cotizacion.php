<?php
header('Access-Control-Allow-Origin: *'); 
#include 'mysql\db_connection.php';
include '/storage/ssd1/260/19457260/public_html/mysql/db_connection.php';

$user = $_POST['user'];
$hora = $_POST['hora'];
$type_area = $_POST['type'];
$area = (float)$_POST['area'];
$volumen = (float)$_POST['vol'];
$latitud = (float)$_POST['lat'];
$longitud = (float)$_POST['lon'];
$precio = (float)$_POST['precio'];


$conn = OpenCon();

$sql = "INSERT INTO COTIZACIONES(USERNAME,FECHA,TYPE_AREA,AREA,VOLUMEN,LATITUD,LONGITUD,PRECIO) 
VALUES ('$user',NOW(),'$type_area','$area','$volumen','$latitud','$longitud','$precio')";

if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

?>