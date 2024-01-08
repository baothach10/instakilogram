<?php
include_once('functions.php');
session_start();
if (isset($_POST['submit'])) {
    $email = $_POST['submit'];
    $user_database = 'UserData/UserAccounts/accounts.db';
    $image_database = 'UserData/ProfileImages/';
    $data = retrieve_data($user_database);
    for ($i=0; $i<count($data); $i++) {
        if (strtolower($data[$i]['email']) == strtolower($email)) {
            $fname = $data[$i]['f_name'];
            $lname = $data[$i]['l_name'];
            break;
        }
    }
    $_SESSION['username_search'] = get_name_via_email($email);
    $_SESSION['fname_search'] = $fname;
    $_SESSION['lname_search'] = $lname;
    header('Location: ./profile_page_search.php');
}