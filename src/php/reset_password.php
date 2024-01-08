<?php
session_start();
include_once('functions.php');
if (isset($_POST['change'])) {
    $user_account = 'UserData/UserAccounts/accounts.db';
    $data = retrieve_data($user_account);
    $email = $_SESSION['email_user_detail'];
    $new_password = $_POST['new_password'];
    $resetOK = 1;
    if ($new_password != '') {
        if (!check_password($new_password)) {
            $resetOK = 0;
        }
    }
    if ($resetOK == 1) {
        for ($i = 0; $i < count($data); $i++) {
            foreach ($data[$i] as &$value) {
                if (strtolower($data[$i]['email']) == strtolower($email)) {
                    if ($new_password != '') {
                        $data[$i]['password'] = password_hash($new_password, PASSWORD_DEFAULT);
                        $_SESSION['change_password'] = 'Password is changed!';
                        break 2;
                    } else {
                        $data[$i]['password'] = '';
                        $_SESSION['change_password'] = 'Password is cleared!';
                        break 2;
                    }
                } else {
                    continue;
                }
            }
        }
        if (file_put_contents($user_account, json_encode($data, JSON_PRETTY_PRINT), LOCK_EX)) {
            header('Location: user_detailed_page.php');
        } else {
            $_SESSION['change_password'] = 'Failed to change password!';
            header('Location: user_detailed_page.php');
        }
    } else {
        $_SESSION['change_password'] = 'Password is not correctly in format!';
        header('Location: user_detailed_page.php');
    }
}

