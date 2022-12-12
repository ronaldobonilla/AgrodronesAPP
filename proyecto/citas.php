<?php
header('Access-Control-Allow-Origin: *'); 
#include 'mysql\db_connection.php';
include '/storage/ssd1/260/19457260/public_html/mysql/db_connection.php';

$user = $_POST['user'];
$piloto = $_POST['piloto'];

$conn = OpenCon();

if($user == 'all'){

    $query = "SELECT C.*,S.FECHA,S.HORA,S.CULTIVO,S.PRODUCTO,
            S.TYPE_AREA,S.AREA,S.VOLUMEN,S.LATITUD,S.LONGITUD,
            S.OBSERVACIONES 
            FROM CITAS AS C
            LEFT JOIN SOLICITUD_SERVICIO AS S
                ON S.ID = C.SOLI_ID  
            ORDER BY S.FECHA ASC ; ";
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

    $query = "SELECT C.*,S.FECHA,S.HORA,S.CULTIVO,S.PRODUCTO,
            S.TYPE_AREA,S.AREA,S.VOLUMEN,S.LATITUD,S.LONGITUD,
            S.OBSERVACIONES 
            FROM CITAS AS C
            LEFT JOIN SOLICITUD_SERVICIO AS S
                ON S.ID = C.SOLI_ID 
            WHERE C.PILOTO='$piloto' OR C.USERNAME='$user' 
            ORDER BY S.FECHA ASC ; ";
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