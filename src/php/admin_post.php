<?php 
error_reporting(0);
$folder = 'UserData/UserUpload/';
$folder_location = $folder . 'Images';
$user_account = 'UserData/UserAccounts/accounts.db';
$post_database = 'UserData/UserUpload/posts.db';
$post_data = retrieve_data($post_database);
$data = retrieve_data($user_account);
for ($j = (count($post_data) - 1); $j >= 0; $j--) {
  foreach (scandir($folder_location) as $img) {
    $image_location = $folder_location . '/' . $img;
    $username = explode('@', explode('@@', $img)[0])[1];
    $created_seconds = explode('@@', explode('.', $img)[0])[1];
    $image_name = substr(explode('@', $img)[0], 11);
    if (str_contains($post_data[$j]['email'], explode('@', explode('@@', $img)[0])[1])) {
        if (explode('@@', explode('.', $img)[0])[1] == $post_data[$j]['created_seconds']) {
            if (str_contains($post_data[$j]['image']['name'], substr(explode('@', $img)[0], 11))) {
                echo 
                '<tr>
                  <td>'.$username.'</td>
                  <td>'."<img src='" . $image_location . "' height='150' width='150' alt='User's upload image'>".'</td>
                  <td>'.$post_data[$j]['caption'].'</td>
                  <td>'.$post_data[$j]['created_time'].'</td>
                  <td>'.$post_data[$j]['sharing_level']."</td>
                  <td>
                    <input type='checkbox' name='deleteimages[]' value='" . $post_data[$j]['created_seconds'] . '@' . get_name_via_email($data[$i]['email']) . '___' . $post_data[$j]['image']['name'] . "'>
                  </td>
                </tr>";
                break;
            } else {
                continue;
            }
        } else {
            continue;
        }
    } else {
        continue;
    }
  }
}