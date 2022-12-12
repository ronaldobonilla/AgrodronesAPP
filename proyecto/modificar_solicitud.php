<?php
header('Access-Control-Allow-Origin: *'); 
#include 'mysql\db_connection.php';
include '/storage/ssd1/260/19457260/public_html/mysql/db_connection.php';

$id = (int)$_POST['id'];
$usuario = $_POST['user'];
$est = $_POST['estado'];
$piloto = $_POST['piloto'];
$dron = $_POST['dron'];


$conn = OpenCon();

if($est==='A'){

  $sql = "UPDATE SOLICITUD_SERVICIO
  SET ESTADO = '$est'
  WHERE ID = '$id' ; ";

  $sql2 = "INSERT INTO CITAS(USERNAME,SOLI_ID,PILOTO,DRON,FECHA_INICIO,FECHA_FIN,CREATED_AT) 
          VALUES('$usuario','$id','$piloto','$dron',NULL,NULL,NOW()); ";

  $data = array();
  if ($conn->query($sql) === TRUE) {
    
    $data['response1'] = "Record modified successfully" ;
    if ($conn->query($sql2) === TRUE) {
    
      $data['response2'] = "Record cita inserted successfully" ;
      
  
    } else {
  
      $data['response2'] = "Something bad happen" ;
      
    }
  
    
    echo json_encode($data);
  } else {

    $data['response1'] = "Something bad happen" ;
    echo json_encode($data);
    
  }
  
  

}else{

  $sql = "UPDATE SOLICITUD_SERVICIO
  SET ESTADO = '$est'
  WHERE ID = '$id' ; ";

  $data = array();
  if ($conn->query($sql) === TRUE) {
    
    $data['response'] = "Record modified successfully" ;
    echo json_encode($data);

  } else {

    $data['response'] = "Something bad happen" ;
    echo json_encode($data);
  }

}

$conn->close();

?>