<?php
header('Access-Control-Allow-Origin: *'); 

#include 'mysql\db_connection.php';
include '/storage/ssd1/260/19457260/public_html/mysql/db_connection.php';
#http://agrodronesdelcampo.000webhostapp.com/img_decode.php?img=x
$Base64Img = $_POST['img'];
$name = $_POST['name'];
$user = $_POST['user'];
                
//Decodificamos $Base64Img codificada en base64.
$Base64Img = base64_decode($Base64Img);
//escribimos la información obtenida en un archivo llamado 
//unodepiera.png para que se cree la imagen correctamente
$file = fopen( '/storage/ssd1/260/19457260/public_html/prueba.jpg', "wb");

fwrite($file, $Base64Img);

fclose($file);

$data = array();
$data['response1'] = $Base64Img ;
echo json_encode($data);


?>