<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A brief description of your webpage">
    <meta name="keywords" content="HTML, CSS, JavaScript, boilerplate">
    <meta name="author" content="Your Name">
    <title>Applicant Access Module</title>
    <style>
        *{
            box-sizing: border-box;
            margin:0;
            padding:0;
        }

        main{
            width: 100%;
            min-height: 100vh;
            flex-direction: column;
            justify-content: center;
        }

        .flex{
            display:flex;
            justify-content: center;
            align-items: center;
        }

        .checker-wrapper{
            width: 500px;
            height: 200px;
            padding: 5px;
            border-radius: 10px;
            position: relative;
            box-shadow: rgba(0, 0, 0, 0.07) 0px 1px 1px, rgba(0, 0, 0, 0.07) 0px 2px 2px, rgba(0, 0, 0, 0.07) 0px 4px 4px, rgba(0, 0, 0, 0.07) 0px 8px 8px, rgba(0, 0, 0, 0.07) 0px 16px 16px;
        }

        .checker{
            width: 100%;
        }

        .checker-wrapper{
            z-index: 5;
        }
        
        .checker-wrapper h1{
            text-align:center;
            color: #f15535;
        }

        header{
            height: 50px;
            text-align: center;
            padding: 10px 0px;
            font-size: 1.5rem;
        }

        .button-style {
            width: 20%;
            border: none;
            background-color: #1363DF;
            text-decoration: none;
            padding: 16.5px;
            font-size: 17px;
            border-radius: 10px;
            color: #fff;
            cursor: pointer;
        }

</style>
</head>
<body>
  <main class="flex">
    <header>TCL APPLICANT NUMBER</header>
    <div class="checker-wrapper flex">
      <div class="checker">
        <h1><?php echo $_SESSION['user_id']; ?></h1>
      </div>
    </div>
    <button class="button-style" type="button" id="home">Return To Home</button>
  </main>

  <script>
    document.getElementById("home").addEventListener("click", () => {
        window.location.href = "/Test/tcl.php";
    });
  </script>
</body>
</html>
