<?php
    session_start();

    require("./static/functions.php");
    require("./static/connection.php");

    $flash_message = new FlashMessage();
    
    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        if($matches = get_applicant($sql_connection, $_POST['applicant_id'])){
            $_SESSION['user_id'] = $matches['user_id'];
            header('Location: applicant.php');
        } else {
            $flash_message->Set('Applicant Not Found', 'error');
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="./static/tcl.css">
    <title>TCL</title>
</head>
<body>
    <?php $flash_message->Display(); // Display the flash message ?>
    <nav>
        <img src="./assets/tcl-logo.svg" alt="tcl logo">
        <div class="social-media-icons">
            <a href="https://www.facebook.com/TCLPhilippines" target="https://www.facebook.com/TCLPhilippines"><i class="fab fa-facebook-f"></i></a>
            <a href="https://x.com/TCLPH" target="https://x.com/TCLPH"><i class="fab fa-twitter"></i></a>
            <a href="https://www.instagram.com/tclphilippines/" target="https://www.instagram.com/tclphilippines/"><i class="fab fa-instagram"></i></a>
            <a href="https://www.youtube.com/channel/UCfF8bbllDwor-o0FqstbDRQ" target="https://www.youtube.com/channel/UCfF8bbllDwor-o0FqstbDRQ"><i class="fab fa-youtube"></i></a>
            <a href="https://www.lazada.com.ph/shop/tcl1632665919/?spm=a2o4l.searchlist.card.1.45a7240e6yneaG&path=promotion-432363-0.htm&tab=promotion&from=onesearch_brand_931" target="https://www.lazada.com.ph/shop/tcl1632665919/?spm=a2o4l.searchlist.card.1.45a7240e6yneaG&path=promotion-432363-0.htm&tab=promotion&from=onesearch_brand_931"><i class="fas fa-shopping-cart"></i></a>
        </div>
    </nav>
    <main>
        <div class="app-wrapper style-bg">
            <div class="upper">
                <img class="float-img" src="./assets/nav-logo.png" alt="Company Logo" class="logo">
                <button type="button" id="apply">Apply</button>
            </div>
            <div class="main-cont">
                <div class="scrolling">
                    <div class="scrolling-images">
                      <img src="./assets/hp-banner.png"  alt="Image 1" loading="lazy">
                      <img src="./assets/hp-banner1.png" alt="Image 2" loading="lazy">
                      <img src="./assets/hp-banner2.png" alt="Image 3" loading="lazy">
                      <img src="./assets/hp-banner3.png" alt="Image 4" loading="lazy">
                    </div>
                    <div class="scrolling-btn">
                      <div class="scrolling-btns"></div>
                      <div class="scrolling-btns"></div>
                      <div class="scrolling-btns"></div>
                      <div class="scrolling-btns"></div>
                    </div>
                  </div>
            </div>
        </div>
        <form method="POST" class="form-wrapper style-bg">
            <input type="text" id="applicant_id" name="applicant_id" placeholder="Search Applicant ID" required>
            <button type="submit" id="submit">Search</button>
        </form>
    </main>
    <script>
        let currentIndex = 0;
        const images = document.querySelectorAll('.scrolling-images img');
        const totalImages = images.length;
        const scrollingBtns = document.querySelectorAll('.scrolling-btns');
        const userBtn = document.getElementById('dropdown');
        function updateActiveButton(index) {
            scrollingBtns.forEach(btn => btn.classList.remove('active'));
            scrollingBtns[index].classList.add('active');
        }
  
        function showNextImage() {
            currentIndex++;
            
            if (currentIndex === totalImages) {
                currentIndex = 0;
            }
            
            const offset = -currentIndex * 100;
            document.querySelector('.scrolling-images').style.transform = `translateX(${offset}%)`;
            
            updateActiveButton(currentIndex);
        }
  
        setInterval(showNextImage, 5000); // Change image every 8 seconds
  
        scrollingBtns.forEach((btn, index) => {
            btn.addEventListener('click', () => {
                currentIndex = index;
                const offset = -currentIndex * 100;
                document.querySelector('.scrolling-images').style.transform = `translateX(${offset}%)`;
                updateActiveButton(currentIndex);
            });
        });

        document.getElementById('apply').addEventListener("click", () => {
            window.location.href ="/Test/apply.php";
        })

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
  
    </script>
</body>
</html>