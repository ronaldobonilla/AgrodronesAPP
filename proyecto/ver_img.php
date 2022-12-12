<?php
header('Access-Control-Allow-Origin: *'); 
#include 'mysql\db_connection.php';
include '/storage/ssd1/260/19457260/public_html/mysql/db_connection.php';

$user = $_POST['user'];

$conn = OpenCon();

if($user == 'all'){

    $query = "SELECT *
            FROM IMAGES ; ";
    $resource = $conn->query($query);
    $total = $resource->num_rows;
    $array=array();

    if($total>0) {
        while($row = $resource->fetch_assoc()) {
            $array[] = $row;
        }
    } else {
        $array['fail']='No se encontraron filas';
    }

    echo json_encode($array);


}else{

    $query = " SELECT *
                FROM IMAGES WHERE USERNAME='$user' ";
    $resource = $conn->query($query);
    $total = $resource->num_rows;
    $array=array();

    if($total>0) {
        while($row = $resource->fetch_assoc()) {
            $array[] = $row;
        }
    } else {
        $array['fail']='No se encontraron filas';
    }

    echo json_encode($array);

}

$conn->close();

?>