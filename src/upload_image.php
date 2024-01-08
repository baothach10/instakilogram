<?php
if(!isset($_SESSION)) { 
    session_start(); 
}
include('functions.php');
if (isset($_POST['upload'])) {
    $fname = $_SESSION['fname'];
    $lname = $_SESSION['lname'];
    $email = $_SESSION['email'];
    $email_name = get_name_via_email($email);   
    $caption = htmlspecialchars($_POST['description']);
    $sharing_level = $_POST['privacy'];
    $upload_image = $_FILES['file_upload'];
    date_default_timezone_set('UTC');
    $database_location = 'UserData/UserUpload';
    $posts_database = $database_location . '/' . 'posts.db';
    $img_database_location = $database_location . '/' . 'Images' . '/';
    $target_file = $img_database_location . "/" . basename($upload_image["name"]);
    $file_extension = get_file_extension($target_file);
    $new_file_name = upload_img_name((explode('.',$upload_image['name'])[0]) . '@' . $email_name . '@@' . time()).$file_extension;
    $uploadOK = 1;
    $post_data = [
        'email' => $email,
        'caption' => $caption,
        'sharing_level' => $sharing_level,
        'created_time' => date('d/m/Y H:i:s e'),
        'created_seconds' => time(),
        'image_location' => $new_file_name,
        'image' => $upload_image
    ];
    if (!verify_update_img($upload_image, $img_database_location)) {
        $uploadOK = 0;
    }
    if ($uploadOK == 1) {
        if (filesize($posts_database) == 0) {
            $first_record = [$post_data];
            $data_to_save = $first_record;
        } else {
            $old_records = json_decode(file_get_contents($posts_database));
            array_push($old_records, $post_data);
            $data_to_save = $old_records;
        }
        if (file_put_contents($posts_database, json_encode($data_to_save, JSON_PRETTY_PRINT), LOCK_EX)) {
            upload_img($upload_image, $email, time(), $database_location);
            header("Location: ./newsfeed.php");
        } else {
            echo 'failed';
        }
    }
}
