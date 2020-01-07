<?php
// Report all errors
error_reporting(-1);    
// Display all errors          
ini_set("display_errors", 1);  

//
session_start();

// Loads the classes automatically
 spl_autoload_register(function($class) {
		    include '../classes/' . $class . '.class.php';
		});

// Create local connection 
// $conn = new mysqli('studentmysql.miun.se', 'momo1600', 'mg7xuf28', 'momo1600');
// Create local connection 
   $conn = new mysqli('localhost', 'root', '', 'webb3project');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
?>