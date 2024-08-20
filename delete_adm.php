<?php
    require("./static/connection.php");
    require("./static/functions.php");

if($_SERVER['REQUEST_METHOD'] == 'GET'){
    $admin_acc = $_GET['adminId'];

    $query = "SELECT * FROM admin WHERE admin_user = '$admin_acc' ";
    $query_response = mysqli_query($sql_connection, $query);
    $admin = mysqli_fetch_assoc($query_response);

    $delete = "DELETE FROM admin WHERE id = '${admin["id"]}' ";
    if(!mysqli_query($sql_connection, $delete)){
        echo "Error";
    } else {
        header("Location: dashboard.php"); 
    }
}
?>