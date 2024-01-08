<?php
include_once('functions.php');
session_start();
if (isset($_GET['search'])) {
    $userAccountFolder = 'UserData/UserAccounts/accounts.db';
    $data = retrieve_data($userAccountFolder);
    $_SESSION['search-result'] = [];
    $user_search = clean_text($_GET['user_search']);
    if ($user_search == '') {
        $_SESSION['search-status'] = 'No results';
    } else {
        for ($i = (count($data) - 1); $i >= 0; $i--) {
            $resultOK = 1;
            if (strtolower($data[$i]['email']) == strtolower($_SESSION['email'])) {
                continue;
            } else {
                foreach ($data[$i] as $key => $value) {
                    if (str_contains(strtolower($data[$i]['f_name']), strtolower($user_search))) {
                        $_SESSION['search-result'][] = ['fname' => $data[$i]['f_name'], 'lname' => $data[$i]['l_name'], 'email' => $data[$i]['email']];
                        break;
                    }
                    if (str_contains(strtolower($data[$i]['l_name']), strtolower($user_search))) {
                        $_SESSION['search-result'][] = ['fname' => $data[$i]['f_name'], 'lname' => $data[$i]['l_name'], 'email' => $data[$i]['email']];
                        break;
                    }
                    if (str_contains(strtolower($data[$i]['email']), strtolower($user_search))) {
                        $_SESSION['search-result'][] = ['fname' => $data[$i]['f_name'], 'lname' => $data[$i]['l_name'], 'email' => $data[$i]['email']];
                        break;
                    }
                    if (str_contains(strtolower(get_name_via_email($data[$i]['email'])), strtolower($user_search))) {
                        $_SESSION['search-result'][] = ['fname' => $data[$i]['f_name'], 'lname' => $data[$i]['l_name'], 'email' => $data[$i]['email']];
                        break;
                    }
                }
            }
        }
        if ($_SESSION['search-result'] == []) {
            $_SESSION['search-status'] = 'No results';
        }
    }
    header("Location: manage_user.php");

}