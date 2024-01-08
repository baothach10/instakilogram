<?php
if(!isset($_SESSION)) { 
    session_start(); 
}
if (!isset($_SESSION['login'])){
    $_SESSION['login'] = false;
}
if ($_SESSION['login'] === false){
header("Location: ./login_page.php");
}?>
<?php require_once('functions.php')?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/cookies.css"/>
    <link rel="stylesheet" href="assets/bootstrap.css"/>
    <link rel="stylesheet" href="assets/newsfeed.css"/>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <script src="assets/main.js" defer></script>
    <script src="https://kit.fontawesome.com/78d03b3312.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <title>Instakilogram</title>
</head>
<body>
    <header>
        <nav>
            <div class="navigation">
                <div class="logo">
                    <a class="no-underline" href="index.php">InstaKilogram</a>
                </div>
                <div class="navigation-search-container">
                    <i class="fa fa-search"></i>
                    <form>
                        <input class="search-field" type="text" placeholder="Search" id="search-bar">
                        <div class="search-container">
                            <div class="search-container-box">
                                    <div class="search-results">

                                    </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="navigation-icons">
                <a href="newsfeed.php" class="navigation-link">
                        <i class="fa-solid fa-house"></i>
                    </a>
                    <a href="#" class="navigation-link">
                        <i class="fa-brands fa-facebook-messenger"></i>
                    </a>
                    <a href="#" class="navigation-link">
                        <i class="fa-solid fa-heart" id="heart_nav">
                        </i>
                    </a>
                    <a href="profile_page.php" class="navigation-link user-icon">
                        <img src="<?php echo get_profile_img($_SESSION['username']); ?>" onerror="this.src='assets/default_image/default_image.jpeg';" height="30" width="30" alt="avatar" class="rounded-circle">
                    </a>
                </div>
            </div>
        </nav>
    </header>
    <main>
        <div class="container my-5">
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-8">
                <!--Add button-->
                <div class="d-flex justify-content-center w-100" id="post">
                    <button class="post-btn" data-bs-toggle="modal" data-bs-target="#postModal">Add post</button>
                </div>
                <!--Post-->
                <?php 
                $data = retrieve_data("UserData/UserUpload/posts.db");
                for ($i = (count($data) - 1); $i >= 0; $i--){
                    $username = '';
                    $caption = '';
                    $sharing_level = '';
                    $image = '';
                    foreach ($data[$i] as $key => $value) {
                        $username = get_name_via_email($data[$i]['email']);
                        $caption = $data[$i]['caption'];
                        $sharing_level = $data[$i]['sharing_level'];
                        $image = $data[$i]['image_location'];
                    }
                    if ($sharing_level == "private" and $username != $_SESSION['username']){
                        continue;
                    }
                    else{
                        echo 
                        '<div class="newfeed my-5">
                            <div class="feed">
                                <div class="card border">
                                    <div class="card-header">
                                        <!--Author-->
                                        <div class="row">
                                            <div class="col-8">
                                                <div class="d-flex">
                                                    <img src="'.get_profile_img($username).'" onerror="this.src=\'assets/default_image/default_image.jpeg\';'.'" class="rounded-circle" height="40" width="40" alt="Avatar">
                                                    <div class="mt-2">
                                                        <a href="" class="text-dark">
                                                            <strong class="mt-5 username">'.$username.'</strong>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <i class="fas fa-ellipsis-h icon-size mt-2 float-right"></i>
                                            </div>
                                        </div>      
                                    </div>
                                    <!--Photo-->
                                    <div>
                                        <img src="UserData/UserUpload/Images/'.$image.'" class="w-100" alt="newpicture"/>
                                    </div>
                                    <!--Interaction-->
                                    <div class="card-body">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <i class="far fa-heart heart icon-size ml-0"></i>
                                                    <i class="far fa-comment icon-size mx-3"></i>
                                                    <i class="far fa-paper-plane icon-size"></i>
                                                    <i class="far fa-bookmark bookmark icon-size float-right"></i>
                                                </div>
                                            </div>
                                            <!--Like by-->
                                            <div class="row mt-2">
                                                <div class="col-md-8 mt-1">
                                                    <small><strong class="">925,529 likes</strong></small>
                                                </div>
                                            </div>
                                            <!--Description-->
                                            <div class="row">
                                                <div class="col-md-12 mt-2">
                                                    <p class="description-p">
                                                        <strong class="text-dark">'.$username.'</strong>'.' '.$caption.
                                                    '</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>';
                    }
                }
                ?>    
            </div>
            <div class="col-md-3"></div>
        </div>
        </div>
    </main>
    <footer>
        <div class="footer-container">
            <a href="about_page.html">About Us</a>
            <a href="privacy_page.html" class="footer-space">Privacy Policy</a>
        </div>
        <div class="footer-container">
            <p>©2022 Team 925, Inc. All rights reserved</p>
        </div>
    </footer>
    <!-- Post modal -->
    <form action="upload_image.php" method="POST" enctype="multipart/form-data">
        <div class="modal fade" id="postModal" tabindex="-1" aria-labelledby="postModal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content model-height">
                    <div class="modal-body text-center">
                        <p class="comfirmation-text border-bottom">Create new post</p>
                        <input class="form-control file_btn margin-top" type="file" name="file_upload" required>
                        <textarea class="form-control file_btn" maxlength="1000" name="description" placeholder="Enter your caption"></textarea>
                        <Select name="privacy" class='form-control file_btn'>
                            <option value="public">Public</option>
                            <option value="internal">Internal</option>
                            <option value="private">Private</option>
                        </Select>
                        <input class="form-control submit_btn" type="submit" name="upload" value="Upload">
                    </div>
                </div>
            </div>
        </div>
    </form>

    <!-- Cookies modal -->
    <div id="cookies">
        <div class="container-cookies">
            <div class="subcontainer">
                <h3>Our website will use cookies</h3>
                <div class="cookies">
                    <p>This website uses your cookies to improve the performance of our website as well as your
                        experiences at our website. This cookies consent is only appear one, if you accept it, it will not appear again across pages.</p>
                    <a href="https://gdpr-info.eu/">Learn More</a>
                    <button id="cookies-btn">I accept</button>
                </div>
            </div>
        </div>
    </div>
    <script src="assets/cookies.js"></script>
</body>
</html>