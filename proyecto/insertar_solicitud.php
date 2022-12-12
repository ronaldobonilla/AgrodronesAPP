<?php
header('Access-Control-Allow-Origin: *'); 
#include 'mysql\db_connection.php';
include '/storage/ssd1/260/19457260/public_html/mysql/db_connection.php';

$user = $_POST['user'];
$fecha = $_POST['fecha'];
$hora = $_POST['hora'];
$cultivo = $_POST['cult'];
$producto = $_POST['prod'];
$type_area = $_POST['type'];
$area = (float)$_POST['area'];
$volumen = (float)$_POST['vol'];
$latitud = (float)$_POST['lat'];
$longitud = (float)$_POST['lon'];
$observaciones = $_POST['obs'];
$est = $_POST['estado'];


$conn = OpenCon();

$sql = "INSERT INTO SOLICITUD_SERVICIO(USERNAME,FECHA,HORA,CULTIVO,PRODUCTO,TYPE_AREA,AREA,VOLUMEN,LATITUD,LONGITUD,OBSERVACIONES,CREATED_AT,ESTADO) 
VALUES ('$user','$fecha','$hora','$cultivo','$producto','$type_area','$area','$volumen','$latitud','$longitud','$observaciones',NOW(),'$est')";

if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

?>