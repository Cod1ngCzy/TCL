<?php
 include_once("models.php");

 // This is where the connection initializes
 $dbhost = 'localhost';
 $dbuser = 'root';
 $dbpass = '';
 $dbname = 'jobapplicant'; // Change this based on the name of the database

 $sql_connect = mysqli_connect($dbhost, $dbuser, $dbpass);

 // Base case to check if connection initializes
 if(!$sql_connect) {
    die('Connection Failed');
 } 

 $db_check_query = "SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '$dbname'";
 $result = mysqli_query($sql_connect, $db_check_query);

 if(mysqli_num_rows($result) > 0){
   if(!$sql_connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname)) {
      die('Connection to Database Failed.');
      echo "Possible Fixes: Check Database Name";
      echo "Possible Fixes: Check Host Name and User Name";
    }
 } else {
   $sql = "CREATE DATABASE jobapplicant";
   if (mysqli_query($sql_connect, $sql)) {
      if(!$sql_connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname)) {
         die('Connection to Database Failed.');
         echo "Possible Fixes: Check Database Name";
         echo "Possible Fixes: Check Host Name and User Name";
       }
   } else {
     echo "Error creating database: " . mysqli_error($sql_connect);
   }
 }
?>