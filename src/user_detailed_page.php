<?php 
  session_start();
  include_once('functions.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/bootstrap.css"/>
    <link rel="stylesheet" href="assets/admin.css">
    <link rel="stylesheet" href="assets/table.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://kit.fontawesome.com/78d03b3312.js" crossorigin="anonymous"></script>
    <title>User's detailed page</title>
</head>
<body>
    <div class="sidebar">
    <div class="logo-details">
      <i class='bx '></i>
      <span class="logo_name">Instakilogram</span>
    </div>
      <ul class="nav-links">
        <li>
          <a href="manage_user.php" class="active">
            <i class='bx bx-grid-alt' ></i>
            <span class="links_name">Manage User</span>
          </a>
        </li>
        <li>
          <a href="manage_post.php">
            <i class='bx bx-box' ></i>
            <span class="links_name">Manage Post</span>
          </a>
        </li>
      </ul>
  </div>
  <section class="home-section">
    <nav>
      <div class="sidebar-button">
        <i class='bx bx-menu sidebarBtn'></i>
        <span class="dashboard">Manage User</span>
      </div>
      <form action="manage_user.php" method="get" enctype="multipart/form-data">
        <div class="search-box">
            <input type="text" name="user_search" placeholder="Search...">
            <button class="action-btn" type="submit" name="search" value="Search"><i class='bx bx-search' ></i></button>
        </div>
      </form>
      <img src="UserData/ProfileImages/a/Profile_Img_asdasd.png" onerror="this.src='assets/default_image/default_image.jpeg';" height="35" width="35" alt="avatar" class="rounded-circle">
    </nav>
    <div class="home-content user_page">
        <div class="profile-image">
            <img src="<?php echo get_profile_img(get_name_via_email($_SESSION['email_user_detail'])); ?>" onerror="this.src='assets/default_image/default_image.jpeg';" height='150' width='150' alt="User's profile image">
        </div>
        <h1 style="margin-top: 15px;"><?php echo $_SESSION['fname_user_detail'] . ' ' . $_SESSION['lname_user_detail'] . "'s detailed page"?></h1>
        <form action="reset_password.php" method="Post" enctype="multipart/form-data">
            <p><?php echo 'Email: ' . $_SESSION['email_user_detail']?></p>
            <br>
            <br>
            <label for="new_password">Enter new password:</label>
            <br>
            <input type="password" name="new_password" id="new_password">
            <button type="submit" name="change">Change password</button>
            <p class="error-message"><?php echo $_SESSION['change_password']; $_SESSION['change_password']= "";?></p>
        </form>
    </div>
  </section>
</body>
<script src="assets/admin.js"></script>
</html>