<?php

include("./static/connection.php");

if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    $userId = $_GET['userId'] ?? 'No value provided';
    $query = "SELECT * FROM applicant WHERE user_id = '$userId' limit 1";
    $query_response = mysqli_query($sql_connection, $query);
    $user = mysqli_fetch_assoc($query_response);
    $user_id = $user['user_id'];

    $user_query_data = [];

    $queries = [
        'personal' => "SELECT * FROM personal_information WHERE user_id = '$user_id'",
        'family' =>  "SELECT * FROM family_background WHERE user_id = '$user_id'",
        'educational' => "SELECT * FROM educational_background WHERE user_id = '$user_id'",
        'work' => "SELECT * FROM work_experience WHERE user_id = '$user_id'",
        'voluntary' =>  "SELECT * FROM voluntary_work WHERE user_id = '$user_id'",
        'ld' => "SELECT * FROM learning_and_development WHERE user_id = '$user_id'",
        'other' => "SELECT * FROM other_information WHERE user_id = '$user_id'"
    ];

    foreach($queries as $property => $value){
        $query_response = mysqli_query($sql_connection, $value);
        $user_query_data[$property] = mysqli_fetch_assoc($query_response);
    }

    echo $user_query_data['personal']['surname'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Applicant View</title>
</head>
<body>
    
</body>
    <script>
        
    </script>
</html>

