<?php
    session_start();
    require("./static/functions.php");
    require("./static/connection.php");

    $flash_message = new FlashMessage();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["log_user"]) && isset($_POST["log_pass"])) {
            if($_POST["log_user"] == 'tcladmin'){
                if($_POST['log_pass'] == 'loc@ladm1n'){
                    $_SESSION['ADMIN'] = true;
                    header("Location: dashboard.php");
                }
            }
        } 
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TCL</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Arvo:ital,wght@0,400;0,700;1,400;1,700&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Sankofa+Display&display=swap');
        *{
            box-sizing: border-box;
            margin: 0;
            height: 0;
        }

        body{
            background-color: #FAF9F6;
        }

        header,
        form,
        .form-group label,
        .form-group{
            display: flex;
            align-items: center;
            justify-content: center;   
        }

        main{
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            width: 100%;
            min-height: 100vh;
            font-family: "Montserrat", sans-serif;
            font-optical-sizing: auto;
            font-style: normal;
            font-size: 16px;
        }

        nav{
            width: 100%;
            height: 100px;
            position: fixed;
            padding: 0px 10px;
        }

        nav img{
            width: 100px;
            height: 100px;
            cursor: pointer;
        }
        
        header{
            width: 500px;
            height: 100px;
            font-size: 2.5em;
            font-weight: 900;
            color: #f15535;
        }

        form{
            width: 500px;
            height: 300px;
            background-color: white;
            box-shadow: 0px 4px 6px -1px rgba(0, 0, 0, 0.1); 
            border: 1px solid 0px 4px 6px -1px rgba(0, 0, 0, 0.1) ;
            border-radius: 10px;
            flex-direction: column;
            padding: 10px;
            position: relative;
        }

        .form-group{
            justify-content: space-between;
            width: 100%;
            padding: 10px;
            height: 50%;
        }

        .form-group input{
            cursor: text;
            font-size: 14px;
            line-height: 20px;
            padding: 0 16px;
            height: 50px;
            width: 80%;
            background-color: #fff;
            border: 1px solid #d6d6e7;
            border-radius: 3px;
            color: rgb(35, 38, 59);
            box-shadow: inset 0 1px 4px 0 rgb(119 122 175 / 30%);
            overflow: hidden;
            transition: all 100ms ease-in-out;
        }

        .form-group label{
            height: 50px;
            font-weight: 500;
        }

        .form-group input:focus {
            border-color: #3c4fe0;
            box-shadow: 0 1px 0 0 rgb(35 38 59 / 5%);
        }


        .button-24 {
            width: 500px;
            background: #FF4742;
            border: 1px solid #FF4742;
            border-radius: 6px;
            box-shadow: rgba(0, 0, 0, 0.1) 1px 2px 4px;
            box-sizing: border-box;
            color: #FFFFFF;
            cursor: pointer;
            display: inline-block;
            font-family: nunito,roboto,proxima-nova,"proxima nova",sans-serif;
            font-size: 16px;
            font-weight: 800;
            line-height: 16px;
            min-height: 40px;
            outline: 0;
            padding: 12px 14px;
            margin: 10px 0;
            text-align: center;
            text-rendering: geometricprecision;
            text-transform: none;
            user-select: none;
            touch-action: manipulation;
            vertical-align: middle;
            position: absolute;
            bottom: -70px;
        }

        .button-24:hover,
        .button-24:active {
            background-color: initial;
            background-position: 0 0;
            color: #FF4742;
        }

        .button-24:active {
            opacity: .5;
        }

    </style>
</head>
<body>
    <nav>
        <img id="home" src="./assets/tcl-logo.svg" alt="tcl logo">
    </nav>
    <main>
        <header>TCL ADMIN</header>
        <form method="POST">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" name="log_user" id="log_user" required>
            </div>
            <div class="form-group">       
                <label for="password">Password</label>
                <input type="password" name="log_pass" id="log_pass" required>
            </div>
            <button type="submit" class="button-24" role="button">Login</button>
        </form>
    </main>
        <!--SCRIPTS-->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var flashMessage = document.querySelector('.flash-message');
            if (flashMessage) {
                // Set a timeout to start fading out the message after 5 seconds
                setTimeout(function() {
                    flashMessage.classList.add('fade-out');
                }, 5000); // 5000 milliseconds = 5 seconds

                // Optionally, remove the message from the DOM after fading out
                setTimeout(function() {
                    flashMessage.remove();
                }, 6000); // 6000 milliseconds = 6 seconds (to ensure it has fully faded out)
            }
        });

        document.getElementById("home").addEventListener("click", () => {
            window.location.href = "/Test/tcl.php";
        });
    </script>
</body>
</html>