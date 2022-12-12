<?php
header('Access-Control-Allow-Origin: *'); 
#include 'mysql\db_connection.php';
include '/storage/ssd1/260/19457260/public_html/mysql/db_connection.php';

$mode = (int)$_POST['mode'];
$nickname = $_POST['nick'];
$month = (int)$_POST['month'];

$conn = OpenCon();

if($mode===0){

    $query = "SELECT DISTINCT NICKNAME FROM DATA_DRON";
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


    $data = array();
    $data['nicknames'] = $array;
    echo json_encode($data);

    

}elseif($mode===1){
    if($month===0){

        //query Sum SPRAY USAGE
        $query = "SELECT DATE_FORMAT(start_timestamp, '%Y-%m-01') AS DATE,
                SUM(spray_usage) AS SUM_SPRAY 
                FROM DATA_DRON
                WHERE UPPER(nickname) = UPPER('$nickname')
                GROUP BY DATE";
        $resource = $conn->query($query);
        $total = $resource->num_rows;
        $array=array();
        if($total>0) {
            while($row = $resource->fetch_assoc()) {
                $array[] = $row;
            }
         } else {
             $array['fail']='No se encontraron filas SUM SPRAY USAGE';
         }


        //QUERY SUM TIME
        $query = "SELECT DATE_FORMAT(start_timestamp, '%Y-%m-01') AS DATE,
                SUM(work_time_seconds) AS SUM_WORK_SECONDS  
                FROM DATA_DRON
                WHERE UPPER(nickname) = UPPER('$nickname')
                GROUP BY DATE";
        $resource = $conn->query($query);
        $total = $resource->num_rows;
        $array2=array();
        if($total>0) {
            while($row = $resource->fetch_assoc()) {
                $array2[] = $row;
            }
        } else {
            $array2['fail']='No se encontraron filas QUERY SUM TIME';
        }


        //QUERY WORK AREA
        $query = "SELECT DATE_FORMAT(start_timestamp, '%Y-%m-01') AS DATE,
                SUM(new_work_area) AS SUM_WORK_AREA   
                FROM DATA_DRON
                WHERE UPPER(nickname) = UPPER('$nickname')
                GROUP BY DATE";
        $resource = $conn->query($query);
        $total = $resource->num_rows;
        $array3=array();
        if($total>0) {
            while($row = $resource->fetch_assoc()) {
                $array3[] = $row;
            }
        } else {
            $array3['fail']='No se encontraron filas WORK AREA';
        }

        $data = array();
        $data['sum_spray'] = $array;
        $data['sum_time'] = $array2;
        $data['sum_area'] = $array3;
        echo json_encode(array('sum_spray' => $array, 'sum_time' => $array2, 'sum_area' =>$array3));



    }else{

        //query Sum SPRAY USAGE
        $query = "SELECT DATE(start_timestamp) AS DATE,
                SUM(spray_usage) AS SUM_SPRAY 
                FROM DATA_DRON
                WHERE UPPER(nickname) = UPPER('$nickname')
                AND MONTH(start_timestamp) = '$month'
                GROUP BY DATE";
        $resource = $conn->query($query);
        $total = $resource->num_rows;
        $array=array();
        if($total>0) {
            while($row = $resource->fetch_assoc()) {
                $array[] = $row;
            }
         } else {
             $array['fail']='No se encontraron filas SUM SPRAY USAGE';
         }


        //QUERY SUM TIME
        $query = "SELECT DATE(start_timestamp) AS DATE,
                SUM(work_time_seconds) AS SUM_WORK_SECONDS  
                FROM DATA_DRON
                WHERE UPPER(nickname) = UPPER('$nickname')
                AND MONTH(start_timestamp) = '$month'
                GROUP BY DATE";
        $resource = $conn->query($query);
        $total = $resource->num_rows;
        $array2=array();
        if($total>0) {
            while($row = $resource->fetch_assoc()) {
                $array2[] = $row;
            }
        } else {
            $array2['fail']='No se encontraron filas QUERY SUM TIME';
        }


        //QUERY WORK AREA
        $query = "SELECT DATE(start_timestamp) AS DATE,
                SUM(new_work_area) AS SUM_WORK_AREA   
                FROM DATA_DRON
                WHERE UPPER(nickname) = UPPER('$nickname')
                AND MONTH(start_timestamp) = '$month'
                GROUP BY  DATE";
        $resource = $conn->query($query);
        $total = $resource->num_rows;
        $array3=array();
        if($total>0) {
            while($row = $resource->fetch_assoc()) {
                $array3[] = $row;
            }
        } else {
            $array3['fail']='No se encontraron filas WORK AREA';
        }

        $data = array();
        $data['sum_spray'] = $array;
        $data['sum_time'] = $array2;
        $data['sum_area'] = $array3;
        echo json_encode(array('sum_spray' => $array, 'sum_time' => $array2, 'sum_area' =>$array3));



    }
}else{

    $array=array();
    $array['fail']='Check parameters';
    echo json_encode($array);
}


$conn->close();



?>