<?php $user_accounts = 'UserData/UserAccounts/accounts.db';
                $data = retrieve_data($user_accounts);
                
                if (isset($_GET['search'])) {
                  $user_search = clean_text($_GET['user_search']);
                  for ($i = (count($data) - 1); $i >= 0; $i--) {
                    $fname = $data[$i]['f_name'];
                    $lname = $data[$i]['l_name'];
                    $email = $data[$i]['email'];
                    $registered_time = $data[$i]['registered_time'];
                    if (str_contains(strtolower($fname), strtolower($user_search)) or 
                    str_contains(strtolower($lname), strtolower($user_search)) or 
                    str_contains(strtolower($email), strtolower($user_search))){
                      $pagination_data[] = $data[$i];
                    }
                  }

                  for ($i = 0; $i < count($pagination_data); $i++) {
                    unset($pagination_data[$i]["password"]);
                  }
                  if (isset($_GET['page'])) {
                    $page = $_GET['page'];
                  } else {
                    $page = 1;
                  }
                  $limit = 5;
                  $offset = ($page - 1) * $limit;
                  $total_items = count($pagination_data);
                  $total_pages = ceil($total_items / $limit);
                  $final = array_splice($pagination_data, $offset, $limit);
                  for ($i=0;$i<count($final); $i++) {
                    echo
                    '<form action="set_detailed_page.php" method="Post" enctype="multipart/form-data">
                    <tr>
                      <td>'.$final[$i]['f_name'].'</td>
                      <td>'.$final[$i]['l_name'].'</td>
                      <td>'.$final[$i]['email'].'</td>
                      <td>'.$final[$i]['registered_time'].'</td>
                      <td>
                        <button class="action-btn" type="submit" name="submit" value="'.$final[$i]['email'].'"><i class="fa-solid fa-pen-to-square"></i></button>
                      </td>
                    </tr>
                    </form';
                  }
                }
                else {
                  $pagination_data = retrieve_data($user_accounts);
                  krsort($pagination_data);
                  for ($i = 0; $i < count($pagination_data); $i++) {
                    unset($pagination_data[$i]["password"]);
                  }
                  if (isset($_GET['page'])) {
                    $page = $_GET['page'];
                  } else {
                    $page = 1;
                  }
                  $limit = 5;
                  $offset = ($page - 1) * $limit;
                  $total_items = count($pagination_data);
                  $total_pages = ceil($total_items / $limit);
                  $final = array_splice($pagination_data, $offset, $limit);
                  for ($i=0;$i<count($final); $i++) {
                    echo
                    '<form action="set_detailed_page.php" method="Post" enctype="multipart/form-data">
                    <tr>
                      <td>'.$final[$i]['f_name'].'</td>
                      <td>'.$final[$i]['l_name'].'</td>
                      <td>'.$final[$i]['email'].'</td>
                      <td>'.$final[$i]['registered_time'].'</td>
                      <td>
                        <button class="action-btn" type="submit" name="submit" value="'.$final[$i]['email'].'"><i class="fa-solid fa-pen-to-square"></i></button>
                      </td>
                    </tr>
                    </form';
                  }
                }
?>