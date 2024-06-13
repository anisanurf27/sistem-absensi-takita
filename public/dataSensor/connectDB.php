<?php
/* Database connection Anisa Server */
	$servername = "192.168.210.224";
    $username = "anisa-server";		//put your phpmyadmin username.(default is "root")
    $password = "anisaserver123";			//if your phpmyadmin has a password put it here.(default is "root")
    $dbname = "sistem-absensi";
    
	$conn = mysqli_connect($servername, $username, $password, $dbname);
	
	if ($conn->connect_error) {
        die("Database Connection failed: " . $conn->connect_error);
    }
?>