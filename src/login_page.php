<?php session_start()?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Log In</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link href="https://www.dafontfree.net/embed/bG9ic3Rlci0xMy1yZWd1bGFyJmRhdGEvMTkvbC85MjE1MS9Mb2JzdGVyXzEuMy5vdGY" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="assets/login_register-page.css" />
</head>

<body>
    <div class="container">
        <div class="card1">
            <div class="inner-box" id="card">
                <div class="card-front">
                    <h2>InstaKilogram</h2>
                    <form action="login.php" method="post" enctype="multipart/form-data">
                        <?php require_once('login.php')?>
                        <input type="text" name="email_login" class="input-box" placeholder="Your Email" required />
                        <input type="password" name="password_login" class="input-box" placeholder="Your Password" required />
                        <p class="error-message"><?php echo $_SESSION['error_login']; $_SESSION['error_login']= "";?></p>
                        <button type="submit" class="submit-btn" name="login">Log In</button>
                    </form>
                    <p class="bottom_text">Don't have an account?</p>
                    <a href="register_page.php" class="register_btn">Register here</a>
                    <p class="bottom_text3">Or <a href="index.php">Go back</a></p>
                </div>
            </div>
        </div>
    </div>
    <script src="assets/login-page.js"></script>
</body>

</html>
