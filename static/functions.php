<?php
include("connection.php");

function get_applicant($sql_connection, $query_id){
    $query = "SELECT * FROM applicant WHERE user_id = '$query_id' limit 1";
    $query_response = mysqli_query($sql_connection, $query);

    if(mysqli_num_rows($query_response) > 0){
        return mysqli_fetch_assoc($query_response);
    } else {
        return false;
    }

}

function generateRandomString($length) {
    // Define the character set to use
    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    
    for ($i = 0; $i < $length; $i++) {
        $randomIndex = rand(0, $charactersLength - 1);
        $randomString .= $characters[$randomIndex];
    }
    
    return $randomString;
}

function unique_id($sql_connection){
    $query = "SELECT * FROM applicant";
    $query_response = mysqli_query($sql_connection, $query);

    $id = mysqli_num_rows($query_response);
    $unique_code =  generateRandomString(3);
    return "APN$unique_code$id";
}

class FlashMessage{
    // Flash Categories 
    // {SUCCESS, ERROR, INFO}
    public function Set($message, $category) {
        $_SESSION['flash_message'] = $message;
        $_SESSION['flash_type'] = $category;
    }

    public function Display(){
        if(isset($_SESSION['flash_message'])) {
            $message = $_SESSION['flash_message'];
            $category = $_SESSION['flash_type'];
            
            if($category == 'success'){
                echo "<div class='flash-message $category'>$message</div>";
            } else {
                echo "<div class='flash-message $category'>$message</div>";
            }

            unset($_SESSION['flash_message']);
            unset($_SESSION['flash_type']);
        }
    }
}

function insert_to_database($table_name,$table,$sql_connection){

    $columns = implode(", ", array_keys($table));
    $values = "'" . implode("', '", array_values($table)) . "'";
    
    $query = "INSERT INTO $table_name ($columns) VALUES ($values)";

    if(!mysqli_query($sql_connection, $query)){
        throw new Exception('Error Inserting to Database');
        return false;
    } else{
        return true;
    }
}

?>