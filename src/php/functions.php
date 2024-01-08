<?php
function clean_text($data_string) {
    $data_string = trim($data_string);
    $data_string = stripslashes($data_string);
    $data_string = htmlspecialchars($data_string, ENT_QUOTES);
    return $data_string;
}

function check_img_type($image) {
    $img_type = ['jpeg', 'jpg', 'png', 'gif'];
    if (in_array(strtolower(pathinfo($image, PATHINFO_EXTENSION)), $img_type)) {
        return true;
    } else {
        return false;
    }
}

function check_email($email_string) {
    $pattern = "/^[a-zA-Z0-9_\-.]+@[a-zA-Z0-9\-.]+$/i";
    if (preg_match($pattern, $email_string)) {
        return true;
    } else {
        return false;
    }
}

function check_email_duplicated($email_string, $database_path) {
    $data = retrieve_data($database_path);
    $true = 0;
    for ($i = 0; $i <= count($data); $i++) {
        if (strtolower($email_string) === strtolower($data[$i]['email'])) {
            $true = 1;
            break;
        } else {
            continue;
        }
    }
    if ($true === 1) {
        return true;
    } else {
        return false;
    }
}

function check_email_password_matched($email_string, $password_string, $database_path) {
    $data = retrieve_data($database_path);
    for ($i = 0; $i <= count($data); $i++) {
        if ($email_string === $data[$i]['email']) {
            if (password_verify($password_string, $data[$i]['password'])) {
                return true;
                break;
            } else {
                return false;
            }
        } else {
            continue;
        }
    }
}

function check_password($password_string) {
    $pattern = "/^(?=.*\d)(?=.*[A-Z])(?=.*[a-z])(.{8,20})$/";
    if (preg_match($pattern, $password_string)) {
        return true;
    } else {
        return false;
    }
}

function check_name($name_string) {
    if ((strlen($name_string)) > 1 and (strlen($name_string) < 21)) {
        return true;
    } else {
        return false;
    }
}

function check_img_real($img) {
    $check = getimagesize($img["tmp_name"]);
    if ($check !== false) {
        return true;
    } else {
        return false;
    }
}

function check_img_exist($img) {
    if (file_exists($img)) {
        return true;
    } else {
        return false;
    }
}

function check_file_size($img) {
    if ($img["size"] > 10000000) {
        return false;
    } else {
        return true;
    }
}

function register_profile_img_name($username) {
    $name_frame = 'Profile_Img_';
    $name = $name_frame . $username;
    return $name;
}

function upload_img_name($username) {
    $name_frame = 'Upload_Img_';
    $name = $name_frame . $username;
    return $name;
}

function rename_img($img, $new_name, $database_path) {
    $old_path = $database_path . $img;
    $new_path = $database_path . $new_name;
    return rename($old_path, $new_path);
}

function get_name_via_email($email_string) {
    $email_string = substr($email_string, 0, strpos($email_string, '@'));
    return $email_string;
}

function get_file_extension($file) {
    $path_part = pathinfo($file);
    $file_extension = "." . $path_part['extension'];
    return $file_extension;
}

function upload_img_profile($img_file, $email_string, $fname, $lname, $dir) {
    $email_string = substr($email_string, 0, strpos($email_string, '@'));
    $target_dir = $dir . $email_string;
    $new_file_name = register_profile_img_name($fname . $lname);
    $new_target_file_name = $target_dir . "/" . $new_file_name;
    $target_file = $target_dir . "/" . basename($img_file["name"]);
    $file_extension = get_file_extension($target_file);
    $new_target_file_name .= $file_extension;
    if (file_exists($target_dir)) {
        return false;
    } else {
        if (!mkdir($target_dir, 0777, true)) {
            return false;
        } else {
            if (move_uploaded_file($img_file['tmp_name'], $target_file)) {
                rename($target_file, $new_target_file_name);
                return true;
            } else {
                return false;
            }
        }
    }
}

function update_img_profile($img_file, $email_string, $fname, $lname, $dir) {
    $email_string = substr($email_string, 0, strpos($email_string, '@'));
    $target_dir = $dir . $email_string;
    $new_file_name = register_profile_img_name($fname . $lname);
    $new_target_file_name = $target_dir . "/" . $new_file_name;
    $target_file = $target_dir . "/" . basename($img_file["name"]);
    $file_extension = get_file_extension($target_file);
    $new_target_file_name .= $file_extension;
    if (move_uploaded_file($img_file['tmp_name'], $target_file)) {
        rename($target_file, $new_target_file_name);
        return true;
    } else {
        return false;
    }
}

function delete_img($img_file, $email_string, $dir) {
    $email_string = substr($email_string, 0, strpos($email_string, '@'));
    $target_dir = $dir . $email_string;
    if (file_exists($target_dir)) {
        $target_file = $target_dir . "/" . basename($img_file["name"]);
        if (unlink($target_file)) {
            return true;
        } else {
            $_SESSION['error_delete'] = 'Cannot delete image!';
            return false;
        }
    } else {
        $_SESSION['error_delete'] = 'There are no images!';
        return false;
    }
}

function verify_img($img_file, $target_dir) {
    global $error_upload_img;
    $target_file = $target_dir . basename($img_file["name"]);
    global $ipaddress;
    $error_upload_img = $ipaddress . '_error_upload_img';
    if (check_img_real($img_file)) {
        if (!check_img_exist($target_file)) {
            if (check_file_size($img_file)) {
                if (check_img_type($target_file)) {
                    return true;
                } else {
                    $_SESSION['error_register'] = 'Only JPG, JPEG, PNG and GIF files are allowed!';
                    return false;
                }
            } else {
                $_SESSION['error_register'] = 'Your file is too large!';
                return false;
            }   
        } else {
            $_SESSION['error_register'] = 'File is already exist!';
            return false;
        }
    } else {
        $_SESSION['error_register'] = 'File is not an image!';
        return false;
    }
}

function verify_update_img($img_file, $target_dir) {
    $target_file = $target_dir . basename($img_file["name"]);
    if (check_img_real($img_file)) {
        if (check_file_size($img_file)) {
            if (check_img_type($target_file)) {
                return true;
            } else {
                $_SESSION['error_update'] = 'Only JPG, JPEG, PNG and GIF files are allowed!';
                return false;
            }
        } else {
           $_SESSION['error_update'] = 'Your file is too large!';
            return false;
        }   
    } else {
        $_SESSION['error_update'] = 'File is not an image!';
        return false;
    }
}

function retrieve_data($database_path) {
    $decoded_data = json_decode(file_get_contents($database_path), true);
    return $decoded_data;
}

function get_profile_img($user){
    $file_location = 'UserData/ProfileImages/'.$user.'/';
    $files = scandir ($file_location);
    if (count($files) >= 3) {
        $image = $file_location . $files[2];
        return $image;
    }
}

function get_upload_img($total, $i){
    $folder = 'UserData/UserUpload/Images/';
    $file = scandir ($folder);
    $img = $folder . $file[$total - $i];
    return $img;
}
function upload_img($img_file, $email_string, $unix_time, $dir) {
    $email_string = substr($email_string, 0, strpos($email_string, '@'));
    $target_dir = $dir . '/' .'Images';
    $new_file_name = upload_img_name((explode('.',$img_file['name'])[0]) . '@' . $email_string . '@@' . $unix_time);
    $new_target_file_name = $target_dir . "/" . $new_file_name;
    $target_file = $target_dir . "/" . basename($img_file["name"]);
    $file_extension = get_file_extension($target_file);
    $new_target_file_name .= $file_extension;
    if (move_uploaded_file($img_file['tmp_name'], $target_file)) {
        rename($target_file, $new_target_file_name);
        return true;
    } else {
        return false;
    }
}
