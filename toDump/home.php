<?php
session_start();
  // Initialize connect to PHP/Database
  include("./static/connection.php");
  include("./static/functions.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <link rel="stylesheet" type="text/css" href="./static/base.css"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <title>TCL</title>
</head>
<body>
  <main class="home-main-wrapper">
    <!--NAV PROPERTIES -->
      <nav class="navbar">
          <img src="./assets/tcl-logo.svg" alt="tcl logo">
          <div class="user">
            <h1>Dashboard</h1>
            <img src="./assets/user_icon.png" id="dropdown">
            <div class="dropdown" id="show_dropdown">
              <label class="btn" for="profile" value="profile" onclick="redirect(load='home');">
                <img src="./assets/home.png" alt="tcl logo">
                 Home
              </label>
              <label class="btn" for="profile" value="profile" onclick="redirect(load='profile');">
                <img src="./assets/profile.png" alt="tcl logo">
                 Profile
              </label>
              <label class="btn" for="logout" value="logout" onclick="redirect(load='logout');">
                <img src="./assets/logout.png" alt="tcl logo">
                 Logout
              </label>
            </div>
          </div>
      </nav>
      <!--NAV PROPERTIES -->

      <section class="main">
        <a href="./apply.php" id="apply" class="apply">Apply</a>
      </section>

      <div class="bottom-wrapper">
        <div class="bottom-nav">
          <img src="./assets/tcl-logo.svg" alt="tcl logo">
          <header>Philippines/English</header>
        </div>
      </div>
  </main>
    <!--JS SCRIPTS -->
    
</body>
</html>
