<?php
header('Access-Control-Allow-Origin: *'); 
#include 'mysql\db_connection.php';
include '/storage/ssd1/260/19457260/public_html/mysql/db_connection.php';

$Base64Img = $_POST['img'];
$name = $_POST['name'];
$user = $_POST['user'];
                

$conn = OpenCon();

$sql = "INSERT INTO IMAGES(USERNAME,NAME_IMG,BASE_64,RESULT,CREATED_AT)
VALUES ('$user', '$name', '$Base64Img',NULL,Now())";

if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

?>