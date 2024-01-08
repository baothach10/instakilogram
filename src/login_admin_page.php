<?php session_start()?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Log In Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link href="https://www.dafontfree.net/embed/bG9ic3Rlci0xMy1yZWd1bGFyJmRhdGEvMTkvbC85MjE1MS9Mb2JzdGVyXzEuMy5vdGY" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="assets/login_register-page.css" />
</head>

<body>
    <div class="container">
        <div class="card1">
            <div class="inner-box" id="card">
                <div class="card-front">
                    <h2>Admin</h2>
                    <form action="login_admin.php" method="post" enctype="multipart/form-data">
                        <?php require_once('login_admin.php')?>
                        <input type="text" name="email_login" class="input-box" placeholder="Your Email" required />
                        <input type="password" name="password_login" class="input-box" placeholder="Your Password" required />
                        <button type="submit" class="submit-btn" name="login">Log In</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="assets/login-page.js"></script>
</body>

</html>
