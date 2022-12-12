<?php

#include 'mysql\db_connection.php';
include '/storage/ssd1/260/19457260/public_html/mysql/db_connection.php';

$flyer_name = $_POST['flyer'];
$place  = $_POST['location'];
$team_name = $_POST['team'];
$spray_usage = (float)$_POST['spu'];
$nickname = $_POST['nick'];
$new_work_area = (float)$_POST['nwa'];
$start_timestamp = $_POST['start'];
$end_timestamp = $_POST['end'];
$work_time_seconds = (float)$_POST['wkts'];
$mode_name = (float)$_POST['mode'];
$work_speed = (float)$_POST['wksp'];
$spray_width = (float)$_POST['spw'];
$radar_height = (float)$_POST['rh'];
$plot_name = $_POST['plot'];
$mission_serial_number = $_POST['mission'];


$conn = OpenCon();

$sql = "INSERT INTO DATA_DRON(flyer_name,place,team_name,spray_usage,nickname,new_work_area,start_timestamp,end_timestamp,	
                              work_time_seconds,mode_name,work_speed,spray_width,radar_height,plot_name,mission_serial_number) 
        VALUES ('$flyer_name','$place','$team_name','$spray_usage','$nickname','$new_work_area','$start_timestamp','$end_timestamp',
                '$work_time_seconds','$mode_name','$work_speed','$spray_width','$radar_height','$plot_name','$mission_serial_number')";

if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

?>