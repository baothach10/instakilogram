<?php
    if(!isset($_SESSION)) { 
        session_start(); 
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Register</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/login_register-page.css" />
    <link rel="stylesheet" href="assets/bootstrap.css" />
</head>

<body>
    <div class="container">
        <div class="card2">
            <div class="inner-box" id="card">
                <div class="card-back">
                    <h2>InstaKilogram</h2>
                    <form action="register.php" method="post" enctype="multipart/form-data">
                        <?php 
                            require_once 'register.php';
                        ?>
                        <input class="input-box" id="email" type="email" name="email" placeholder="Your Email" required
                            oninput="continuousValidateEmail()" />
                        <div class="popup" onclick="showContent()">
                            <span class="popuptext" id="myPopup">
                                Password is 8-20 characters
                                <br>
                                At least one of the each in the following :
                                <br>
                                1 Lower-case
                                <br>
                                1 Upper-case
                                <br>
                                1 Digit
                                <br>
                                - Click in this box to close -
                            </span>
                            <input class="input-box popup" id="password" type="password" name="password"
                                placeholder="Your Password" required oninput="continuousValidatePassword()" />
                        </div>

                        <input class="input-box" id="retype_password" type="password" name="retype_password"
                            placeholder="Retype Password" required oninput="continuousValidatePassword()" />
                        
                        <input class="input-box" id="f_name" type="text" name="f_name" placeholder="First Name"
                            required oninput="continuousValidateFirstName()" />

                        <input class="input-box" id="l_name" type="text" name="l_name" placeholder="Last Name"
                            required minlength="2" maxlength="20" oninput="continuousValidateLastName()" />
                        <input class="form-control file_btn" id="profile-upload" type="file" name="profile_picture"/>
                        <p class="error-message"><?php echo $_SESSION['error_register']; $_SESSION['error_register'] = "";?></p>
                        <button class="input-box" type="reset" id="reset" onclick="resetValidate()">
                            Clear
                        </button>
                        <button class="input-box" name="submit" type="submit" id="submit">
                            Register
                        </button>
                    </form>
                    <p class="bottom_text_policy">By signing up, you agree to our <a href="privacy_page.html">Terms</a>, <a href="privacy_page.html">Data Policy</a> and <a href="privacy_page.html">Cookies Policy</a></p>
                    <p class="bottom_text2">Have an account? <a href="login_page.php">Log in</a></p>
                </div>
            </div>
        </div>
    </div>
    <script src="assets/register_validate.js"></script>
</body>
</html>
