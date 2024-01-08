<?php 
if(!isset($_SESSION)) { 
  session_start(); 
}

if (!isset($_SESSION['error_register'])) {
    $_SESSION['error_register'] = "";
}

include_once("functions.php");
if (isset($_POST['submit'])) {
    $registerOK = 1;
    date_default_timezone_set('UTC');
    $register_time = date('d/m/Y H:i:s e');
    $fname = clean_text($_POST['f_name']);
    $lname = clean_text($_POST['l_name']);
    $email = clean_text($_POST['email']);
    $password = clean_text($_POST['password']);
    $profile_img = $_FILES['profile_picture'];
    $profile_img_path = get_file_extension($profile_img['name']);
    // Verify first name
    if (!check_name($fname)) {
        $registerOK = 0;
    }
    // Verify last name
    if (!check_name($lname)) {
        $registerOK = 0;
    }
    // Verify email
    if (!check_email($email)) {
        $registerOK = 0;
    }
    // Check email duplications
    if (check_email_duplicated($email, 'UserData/UserAccounts/accounts.db')) {
        $registerOK = 0;
        $_SESSION['error_register'] = 'Register failed, email already used!';
    }
    // Verify password and hash password
    if (check_password($password)) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    } else {
        $registerOK = 0;
    }
    //  Verify image
    if ($profile_img['size'] > 0 && $profile_img['error'] == 0) {
        if (!verify_img($profile_img, "UserData/ProfileImages/")) {
            $registerOK = 0;
        }
    }
    // Bring the data all together inside an array
    $form_data = [
        'f_name' => $fname,
        'l_name' => $lname,
        'email' => $email,
        'password' => $hashed_password,
        'registered_time' => $register_time
    ];
    if ($registerOK == 1) {
        upload_img_profile($profile_img, $email, $fname, $lname, "UserData/ProfileImages/");
        if (filesize('UserData/UserAccounts/accounts.db') == 0) {
            $first_record = [$form_data];
            $data_to_save = $first_record;
        } else {
            $old_records = json_decode(file_get_contents('UserData/UserAccounts/accounts.db'));
            array_push($old_records, $form_data);
            $data_to_save = $old_records;
        }
        if (file_put_contents('UserData/UserAccounts/accounts.db', json_encode($data_to_save, JSON_PRETTY_PRINT), LOCK_EX)) {
            header("Location: login_page.php");
        } else {
            $_SESSION['error_register'] = 'Register failed, please try again!';
            header("Location: register_page.php");
        }
    } else {
        header("Location: register_page.php");
    }
}