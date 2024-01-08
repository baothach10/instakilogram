<?php 
if(!isset($_SESSION)) { 
  session_start(); 
}

if (!isset($_SESSION['error_login'])){
    $_SESSION['error_login'] = "";
}
if (!isset($_SESSION['login'])){
    $_SESSION['login'] = false;
}
include_once("functions.php");
if (isset($_POST['login'])) {
    $email = clean_text($_POST['email_login']);
    $password = clean_text($_POST['password_login']);
    $user_database_path = 'UserData/UserAccounts/accounts.db';
    $data = retrieve_data($user_database_path);
    $_SESSION['email'] = $email;
    if (check_email_password_matched($email, $password, $user_database_path)) {
        for ($i = 0; $i <= count($data); $i++) {
            foreach ($data[$i] as $key => $value) {
                if (strtolower($email) === strtolower($data[$i]['email'])) {
                    $fname = $data[$i]['f_name'];
                    $lname = $data[$i]['l_name'];
                    $username = substr($data[$i]['email'], 0, strpos($data[$i]['email'], '@'));
                    $_SESSION['fname'] = $fname;
                    $_SESSION['lname'] = $lname;
                    $_SESSION['username'] = $username;
                    $_SESSION['login'] = true;
                    break;
                }
            }
            if ($_SESSION['login'] == true) {
                break;
            }
        }
        header("Location: ./newsfeed.php");
        exit;
    } else {
        $_SESSION['error_login'] = "Wrong email or password";
        header("Location: ./login_page.php");
        exit;
    }
}