<?php if(!isset($_SESSION)) { 
  session_start(); 
}

include_once("functions.php");
if (isset($_POST['login'])) {
    $email = clean_text($_POST['email_login']);
    $password = clean_text($_POST['password_login']);
    if ($email == "admin" and $password == "admin"){
        header("Location: manage_user.php");
    } else {
        $_SESSION['error_login'] = "Wrong email or password";
        header("Location: login_admin_page.php");
    }
}