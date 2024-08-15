<?php
  session_start();
  // Initialize connect to PHP/Database
  require("./static/connection.php");
  require("./static/functions.php");

    // Validate User Login
    $user_id = $user_data['user_id'];

    // Query to fetch the user_id from each table
    $query_personal = "SELECT * FROM personal_information WHERE user_id = '$user_id'";
    $query_family = "SELECT * FROM family_background WHERE user_id = '$user_id'";
    $query_educational = "SELECT * FROM educational_background WHERE user_id = '$user_id'";
    $query_work = "SELECT * FROM work_experience WHERE user_id = '$user_id'";
    $query_voluntary = "SELECT * FROM voluntary_work WHERE user_id = '$user_id'";
    $query_ld = "SELECT * FROM learning_and_development WHERE user_id = '$user_id'";
    $query_other = "SELECT * FROM other_information WHERE user_id = '$user_id'";

    // Execute each query and fetch the result
    $result_personal = mysqli_query($sql_connection, $query_personal);
    $user_data_personal = mysqli_fetch_assoc($result_personal);
    
    $result_family = mysqli_query($sql_connection, $query_family);
    $user_data_family = mysqli_fetch_assoc($result_family);
    
    $result_educational = mysqli_query($sql_connection, $query_educational);
    $user_data_educational = mysqli_fetch_assoc($result_educational);
    
    $result_work = mysqli_query($sql_connection, $query_work);
    $user_data_work = mysqli_fetch_assoc($result_work);
    
    $result_voluntary = mysqli_query($sql_connection, $query_voluntary);
    $user_data_voluntary = mysqli_fetch_assoc($result_voluntary);
    
    $result_ld = mysqli_query($sql_connection, $query_ld);
    $user_data_ld = mysqli_fetch_assoc($result_ld);
    
    $result_other = mysqli_query($sql_connection, $query_other);
    $user_data_other = mysqli_fetch_assoc($result_other);

    $user_query_data = [
        'personal' => $user_data_personal,
        'family' => $user_data_family,
        'educational' => $user_data_educational,
        'work' => $user_data_work,
        'voluntary' => $user_data_voluntary,
        'learning_and_development' => $user_data_ld,
        'other' => $user_data_other
    ];

    // Check if there is a query data
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
    <main class="profile-main-wrapper">
      <!--NAV PROPERTIES -->
        <nav class="navbar">
            <img src="./assets/tcl-logo.svg" alt="tcl logo">
            <div class="user">
              <?php echo $_SESSION['firstname'] . " " . $_SESSION['surname']; ?>
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

        <div class="applicant-wrapper">
            <div class="applicant-number">
                <h3>Your Applicant ID</h3>
                <h1><?php echo "TCLM_{$user_data['user_id']}"; ?></h1>
                <button type="button" id="show_status">View Application</button>
            </div>
            <div class="view_applicant_wrapper" id="view_applicant_wrapper">
              <div class="view_applicant">
              <?php
                  if (isset($user_query_data)) {
                    echo '<div class="header">
                    <img src="./assets/nav-logo.png" alt="Company Logo" class="logo">
                    <h1>Job Application Form</h1>
                     </div>';
                      foreach ($user_query_data as $columns => $data) {
                        echo "<div class='column-wrapper'>";
                          foreach ($data as $key => $value) {
                              if ($key == "user_id" || $key == "id") {
                                  continue;
                              } else {
                                  if ($value == "" || $value == "0") {
                                      $value = "None";
                                  }
                                  $format_str = str_replace("_", " ", $key);
                                  $upperKey = ucwords($format_str);
                                  echo "<div class='inline-inp'>";
                                  echo "<label>$upperKey</label>";
                                  echo "<input placeholder='$value'readonly>";
                                  echo "</div>";
                              }
                          }
                        echo "</div>";
                      }
                  } else {
                      echo '<h1 class="no-data">No Applicant Data</h1>';
                  }
                  ?>
                <button type="button" id="close_status">Close</button>
              </div>
            </div>
        </div>

        <div class="bottom-wrapper" id="bottom-wrapper">
          <div class="bottom-nav">
            <img src="./assets/tcl-logo.svg" alt="tcl logo">
            <div class="social-media-icons">
              <a href="https://www.facebook.com/TCLPhilippines" target="https://www.facebook.com/TCLPhilippines"><i class="fab fa-facebook-f"></i></a>
              <a href="https://x.com/TCLPH" target="https://x.com/TCLPH"><i class="fab fa-twitter"></i></a>
              <a href="https://www.instagram.com/tclphilippines/" target="https://www.instagram.com/tclphilippines/"><i class="fab fa-instagram"></i></a>
              <a href="https://www.youtube.com/channel/UCfF8bbllDwor-o0FqstbDRQ" target="https://www.youtube.com/channel/UCfF8bbllDwor-o0FqstbDRQ"><i class="fab fa-youtube"></i></a>
              <a href="https://www.lazada.com.ph/shop/tcl1632665919/?spm=a2o4l.searchlist.card.1.45a7240e6yneaG&path=promotion-432363-0.htm&tab=promotion&from=onesearch_brand_931" target="https://www.lazada.com.ph/shop/tcl1632665919/?spm=a2o4l.searchlist.card.1.45a7240e6yneaG&path=promotion-432363-0.htm&tab=promotion&from=onesearch_brand_931"><i class="fas fa-shopping-cart"></i></a>
            </div>
            <header>Philippines/English</header>
          </div>
      </div>

    </main>

    <!--JS SCRIPTS -->
    <script>
        const userBtn = document.getElementById('dropdown');
        const openApplicant = document.getElementById('show_status');
        const closeApplicant = document.getElementById('close_status');
        const viewWrapper = document.getElementById('view_applicant_wrapper');

        userBtn.addEventListener('click', () => {
          const dropdown = document.getElementById('show_dropdown');
          dropdown.classList.toggle('show_dropdown');
        });

        openApplicant.addEventListener('click', () => {
          viewWrapper.classList.add('view_applicant_show');
          document.getElementById("bottom-wrapper").classList.remove('bottom-wrapper');
        });

        closeApplicant.addEventListener('click', () => {
          viewWrapper.classList.remove('view_applicant_show');
          document.getElementById("bottom-wrapper").classList.add('bottom-wrapper');
        });

        function redirect(load) {
            if (load == 'logout'){
            window.location.href = "./static/logout.php";
            } else if(load == 'profile'){
            window.location.href = "/Test/profile.php";
            } else if (load == 'home'){
            window.location.href = "/Test/home.php";
            }
        }
    </script>
</body>
</html>
