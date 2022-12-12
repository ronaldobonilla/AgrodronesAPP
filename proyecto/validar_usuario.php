<?php
header('Access-Control-Allow-Origin: *'); 
#include 'mysql\db_connection.php';
include '/storage/ssd1/260/19457260/public_html/mysql/db_connection.php';

$user = $_POST['user'];
$pass = $_POST['pass'];


$conn = OpenCon();

$query = " SELECT * FROM USERS WHERE USERNAME = '$user' and  PASSWORD = '$pass' " ;



$resource = $conn->query($query);
$total = $resource->num_rows;
$array=array();

if($total>0) {
    while($row = $resource->fetch_assoc()) {
        $array[] = $row['TYPE'];
    }
 } else {
     $array['fail']='Usuario o Contrasena Invalida';
 }
 echo json_encode($array);
 $conn->close();


?>