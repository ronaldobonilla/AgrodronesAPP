<?php

function OpenCon()
 {
    $servername = "localhost";
    $username = "id19457260_agro";
    $password = "{ARF8P-v_p0aZkr-";
    $dbname = "id19457260_agrodrones";


    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

 
    return $conn;
 }
 
function CloseCon($conn)
 {
 $conn -> close();
 }
   
?>