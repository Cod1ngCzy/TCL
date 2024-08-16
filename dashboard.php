<?php
    session_start();
    require("./static/connection.php");
    require("./static/functions.php");

    if(!$_SESSION['ADMIN']){
        header('Location: dashlog.php');
    }

    $fetch_name = "SELECT * FROM applicant";
    $result = mysqli_query($sql_connection, $fetch_name);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        *{
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        main{
            width: 100%;
            min-height: 100vh;
            display: flex;
            position: relative;
            font-size: 16px;
            font-family: "Montserrat", sans-serif;
            font-optical-sizing: auto;
            font-style: normal;
            color: #efefef;
        }

        .dash-left,
        .dash-right{
            min-height: 100vh;
        }

        .dash-left{
            width: 300px;
            position: relative;
            left: 0;
            background-color: #1d283c;
        }

        .dash-right{
            width: 100%;
            display: flex;
            flex-direction: column;
            padding: 0px 20px;
            background-color: rgba(21, 30, 47,1);
        }

        .dash-nav{
            width: 100%;
            padding: 10px;
        }

        .dash-nav input{
            background-color: #1d283c;
            border: 1px solid #1d283c;
            border-radius: 5px;
            width: 300px;
            height: 40px;
            color: white;
            padding: 10px;
        }

        .sidebar{
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 10px;
            height: 300px;
            width: 90%;
            margin: 0 auto;
        }

        .sidebar header{
            font-weight: bold;
        }

        table {
            width: 100%;
            height: 20px;
            border-collapse: collapse;
            margin: 10px 0;
            font-size: 18px;
            text-align: left;
        }
        
        td,th{ 
            padding: 10px;
            text-align: center;
        }

        th{
            background-color: #DDDDDD;
        }

        thead th{
            background-color: #1d283c;
            border-collapse: collapse;
        }

        thead th:first-child{
            border-top-left-radius: 10px;
            border-bottom-left-radius: 10px;
        }
        thead th:last-child{
            border-top-right-radius: 10px;
            border-bottom-right-radius: 10px;
        }

    </style>
</head>
<body>
    <main>
        <div class="dash-left">
            <div class="sidebar">
                <header>TCL ADMIN DASHBOARD</header>
            </div>
        </div>
        <div class="dash-right">
            <div class="dash-nav">
                <input type="text" name="search" id="search" placeholder="Search">
            </div>
            <table>
                <thead>
                    <tr>
                        <th>Applicant Name</th>
                        <th>Applicant Number</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['user_id']) . "</td>";
                        echo "<td>PENDING</td>";
                        echo "<td><button class='view-button' data-user-id='" . htmlspecialchars($row['user_id']) . "'>View</button></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No results found</td></tr>";
                }
                ?>
                </tbody>
            </table>
            <div class="applicant-show" id="show_applicant">
                
            </div>
        </div>
        <script>
            
        </script>
    </main>
</body>
</html>