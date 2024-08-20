<?php
    session_start();
    require("./static/connection.php");
    require("./static/functions.php");

    if(!$_SESSION['ADMIN']){
        header('Location: dashlog.php');
    }

    $fetch_name = "SELECT * FROM applicant";
    $result = mysqli_query($sql_connection, $fetch_name);

    $fetch_admin = "SELECT * FROM admin";
    $admin = mysqli_query($sql_connection, $fetch_admin);

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $unique_code =  generateRandomString(3);
        $admin_username = isset($_POST['username']) ? $_POST['username'] : null ;
        $admin_password = isset($_POST['password']) ? $_POST['password'] : null;
        $admin_access = true;
        $admin_id = "ADM_$unique_code";

        $query = "INSERT INTO admin (admin_id,admin_user,admin_password,admin_access) VALUES ('$admin_id', '$admin_username', '$admin_password', '$admin_access')";
        $query_response = mysqli_query($sql_connection, $query);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/0d989788cd.js" crossorigin="anonymous"></script>
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
            background-color: #CCCCCC;
        }

        .dash-right{
            width: 100%;
            display: flex;
            flex-direction: column;
            padding: 0px 20px;
            background-color: #FFFFFF;
        }

        .dash-nav{
            width: 100%;
            padding: 10px;
            display: flex;
            justify-content: space-between;
        }

        .dash-nav button{
            width: 100px;
            border-radius: 5px;
            background-color: #CCCCCC;
            border: 1px solid #CCCCCC;
            cursor: pointer;
        }

        .view-button{
            width: 70px;
            height: 30px;
            background-color: #CCCCCC;
            border: 1px solid #CCCCCC;
            color: black;
            border-radius: 5px;
            cursor: pointer;
        }

        .view-button:hover,
        .dash-nav button:hover{
            background-color: #FF4742;
            border: 1px solid #FF4742;
            color: #efefef;
        }

        .dash-nav input{
            background-color: #CCCCCC;
            border: 1px solid #CCCCCC;
            border-radius: 5px;
            width: 300px;
            height: 40px;
            color: black;
            padding: 10px;
        }

        .bottom-nav{
            width: 100%;
            height: 50px;
            position: absolute;
            bottom: 0;
            display: flex;
            align-items: center;
            justify-content: space-evenly;
        }

        .fa-user{
            font-size: 1.5em;
            color: red;
        }

        .sidebar{
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 10px;
            height: 300px;
            width: 90%;
            margin: 0 auto;
            color: #FF4742;
            font-size: 1.5em;
        }

        .controls{
            margin-top: 50px;
            width: 100%;
            padding: 10px;
        }

        .controls input{
            width: 180px;
            height: 20px;
            text-align: center;
            font-size: 16px;
            font-family: "Montserrat", sans-serif;
            font-optical-sizing: auto;
            font-style: normal;
            border: none;
            border-radius: 5px;
            cursor: pointer;
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
            background-color: white;
            box-shadow: 0px 4px 6px -1px rgba(0, 0, 0, 0.1); 
            border: 1px solid 0px 4px 6px -1px rgba(0, 0, 0, 0.1) ;
            border-radius: 10px;
            color: black;
        }
        
        td,th{ 
            padding: 10px;
            text-align: center;
        }

        th{
            background-color: #DDDDDD;
        }

        thead th{
            background-color: #DDDDDD;
            border-collapse: collapse;
            color: #FF4742;
        }

        thead th:first-child{
            border-top-left-radius: 10px;
            border-bottom-left-radius: 10px;
        }
        thead th:last-child{
            border-top-right-radius: 10px;
            border-bottom-right-radius: 10px;
        }

        .show_admin{
            width: 100%;
            height: 200px;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: white;
            box-shadow: 0px 4px 6px -1px rgba(0, 0, 0, 0.1); 
            border: 1px solid 0px 4px 6px -1px rgba(0, 0, 0, 0.1) ;
            border-radius: 10px;
            display: none;
        }

        .show_admin form,
        .available_admin{
            width: 50%;
            height: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: black;
        }

        .header,
        .view{
            width: 100%;
            color: black;
            display: flex;
            justify-content: space-between;
            padding: 10px;
        }

        .header{
            background-color: #DDDDDD;
            border-collapse: collapse;
            justify-content: space-around;
        }
         
        .show_admin input,
        .show_admin button{
            width: 50%;
            margin: 5px 0px ;
            text-align: center;
        }
    </style>
</head>
<body>
    <main>
        <div class="dash-left">
            <div class="sidebar">
                <header>TCL DASHBOARD</header>
                <div class="controls">
                    <input type="text" value="Applicants" id="applicant" readonly>
                    <input type="text" value="Admin Account Control" id="admin" readonly>
                </div>
            </div>
            <div class="bottom-nav">
                <i class="fa-solid fa-user"></i>
            </div>
        </div>
        <div class="dash-right">
            <div class="dash-nav">
                <input type="text" name="search" id="search" placeholder="Search">
                <button type="button" id="logout">Log Out</button>
            </div>
            <table class="show_table">
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
                        echo "<td><button class='view-button' data-user-id='" . htmlspecialchars($row['user_id']) . "' name='" . htmlspecialchars($row['user_id']) . "'>View</button></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No results found</td></tr>";
                }
                ?>
                </tbody>
            </table>
            <div class="show_admin">
                <div class="available_admin">
                    <div class="header">
                        <label for="">Admin Users</label>
                        <label for="">Account Type</label>
                    </div>
                    <div class="view">
                    <?php
                        if(mysqli_num_rows($admin) > 0){
                            while($row = mysqli_fetch_assoc($admin)){
                                echo "<input type='text' value='${row['admin_user']}' readonly>";
                                echo "<input type='text' value='Elevated' readonly>";
                            }
                        }
                    ?>
                </div>
                </div>
                <form method="POST">
                    <input type="text" placeholder="Admin Username" name="username">
                    <input type="text" placeholder="Admin Password" name="password">
                    <button type="submit">Add Admin Account</button>
                </form>
            </div>
        </div>
        <script>
            const viewBtn = document.querySelectorAll('.view-button');
            const applicantPage = document.querySelector('.show_table');
            const adminPage = document.querySelector('.show_admin');
            const applicantBtn = document.getElementById("applicant");
            const adminBtn = document.getElementById("admin");

            viewBtn.forEach(btn => {
                btn.addEventListener("click", () => {
                    window.location.href = `/Test/get_user.php?userId=${btn.name}`;
                });
            });

            applicantBtn.addEventListener("click", () => {
                adminPage.style.display = "none";
                applicantPage.style.display = "";
            });

            adminBtn.addEventListener("click", () => {
                applicantPage.style.display = "none";
                adminPage.style.display = "flex";
            });

            document.getElementById("logout").addEventListener("click", () => {
                window.href.location = "tcl.php";
            });

        </script>
    </main>
</body>
</html>