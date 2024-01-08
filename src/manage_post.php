<!DOCTYPE html>
<?php include_once('php/functions.php');?>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="assets/bootstrap.css"/>
    <link rel="stylesheet" href="assets/admin.css">
    <link rel="stylesheet" href="assets/table.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://kit.fontawesome.com/78d03b3312.js" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"></meta>
    <title>Manage Post </title>
   </head>
<body>
  <div class="sidebar">
    <div class="logo-details">
      <i class='bx '></i>
      <span class="logo_name">Instakilogram</span>
    </div>
      <ul class="nav-links">
        <li>
          <a href="manage_user.php">
            <i class='bx bx-grid-alt' ></i>
            <span class="links_name">Manage User</span>
          </a>
        </li>
        <li>
          <a href="manage_post.php"  class="active">
            <i class='bx bx-box' ></i>
            <span class="links_name">Manage Post</span>
          </a>
        </li>
      </ul>
  </div>
  <div class="home-section">
    <nav>
      <div class="sidebar-button">
        <i class='bx bx-menu sidebarBtn'></i>
        <span class="dashboard">Manage Post</span>
      </div>
      <form action="manage_post.php" method="get" enctype="multipart/form-data">
      <div class="search-box">
        <input type="text" placeholder="Search...">
        <i class='bx bx-search' ></i>
      </div>
      </form>
      <img src="assets/instakilogram_logo.png" height="35" width="35" alt="avatar" class="rounded-circle">
    </nav>
    <div class="home-content">
      <div class="sales-boxes">
        <div class="recent-sales box">
          <?php echo "<form action='delete_img_and_post.php' method='post' enctype='multipart/form-data'>"; ?>
          <button class="btn" type="submit" name="delete" style="float:right;">Delete</button>
            <div class="title">Recent Sales</div>
            <div class="sales-details">
              <table id="dtBasicExample">
                <thead>
                  <tr>
                    <th>Username</th>
                    <th>Image</th>
                    <th>Caption</th>
                    <th>Post time</th>
                    <th>Sharing Level</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php require_once('admin_post.php')?>
                </tbody>
              </table>
          <?php echo "</form>"?>
          </div>
        </div>
      </div>
    </div>
  </div>
<script src="assets/admin.js"></script>

</body>
</html>

