<?php
// local
$server 	= "localhost";
$db 		= "jobs";
$username 	= "root";
$charset 	= "utf8";
$password 	= "";



// // //live
// $server 	= "198.91.81.7";
// $server 	= "localhost";

// $db 		= "pesox10h_jobs";
// $username 	= "pesox10h";
// $charset 	= "utf8";
// $password 	= "matantei999";





$db = new PDO("mysql:host=$server;dbname=$db;charset=$charset", $username, $password);
