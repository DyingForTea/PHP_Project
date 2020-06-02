<?php require_once("include/DB.php"); ?>
<?php require_once("include/Sessions.php"); ?>
<?php require_once("include/Functions.php"); ?>
<?php Confirm_Login(); ?>
<?php
if(isset($_POST["Submit"])) {
  $Title = mysqli_real_escape_string($Connection, $_POST["Title"]);
  $Author = mysqli_real_escape_string($Connection, $_POST["Author"]);
  $Category = mysqli_real_escape_string($Connection, $_POST["Category"]);
  $Post = mysqli_real_escape_string($Connection, $_POST["Post"]);
  date_default_timezone_set("Europe/Sofia");
  $CurrentTime = time();
  $DateTime = strftime("%m-%B-%Y%n%H:%M:%S", $CurrentTime);
  $DateTime;
  $Admin = $_SESSION["Username"];
  $Image=$_FILES["Image"]["name"];
  $Target="Upload/".basename($_FILES["Image"]["name"]);

if(empty($Title)) {
    $_SESSION["ErrorMessage"] = "Title cannot be empty.";
    Redirect_to("AddNewPost.php");
} elseif(strlen($Title)<2) {
    $_SESSION["ErrorMessage"] = "Title should be at least 2 characters.";
    Redirect_to("AddNewPost.php");
} else{
    global $ConnectingDB;
    $Query = "INSERT INTO admin_panel(datetime, title, category, author, image, post, admin) VALUES('$DateTime', '$Title', '$Category', '$Author', '$Image', '$Post', '$Admin')";
    $Execute = mysqli_query($Connection, $Query);
    move_uploaded_file($_FILES["Image"]["tmp_name"], $Target);
    if($Execute){
      $_SESSION["SuccessMessage"] = "Posted.";
      Redirect_to("AddNewPost.php");
    } else{
        $_SESSION["ErrorMessage"] = "Something went wrong... Try again.";
        Redirect_to("AddNewPost.php");
    }
  }
}
 ?>

<html>
  <head>
    <title>Add New Book</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/bootstrap.min.js"> </script>

    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/btn.css">
  </head>
  <style>
          .bg-custom{
            background-color: #262a19;
          }
          .mainbg{
            background-color: bg-transparent;
            height: 100%;
          }
  </style>

          <div style="height: 10px; background: #997438"></div>

          <nav class="navbar navbar-expand-lg navbar-dark bg-custom">
          <a class="navbar-brand" href="Blog.php?Page=1" target="_blank"><img src="images/logo.png" width="350" height="60"></a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarTogglerDemo02">

          <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            <li class="nav-item"><a class="nav-link" href="Dashboard.php">Dashboard</a></li>
            <li class="nav-item"><a class="nav-link" href="Admins.php">Admins</a></li>
            <li class="nav-item"><a class="nav-link" href="Comments.php">Comments
              <?php // UNapproved comments
               $ConnectingDB;
              $QueryTotal = "SELECT COUNT(*) FROM comments WHERE status='OFF'";
              $ExecuteTotal = mysqli_query($Connection, $QueryTotal);
              $RowsTotal = mysqli_fetch_array($ExecuteTotal);
              $Total = array_shift($RowsTotal);

                if($Total>0){
              ?>
              <span class="badge badge-warning">
              <?php echo $Total;?>
              </span>
              <?php } ?>
            </a></li>
            <li class="nav-item active"><a class="nav-link" href="AddNewPost.php">Add New Book</a></li>
            <li class="nav-item"><a class="nav-link" href="Categories.php">Categories</a></li>
            <li class="nav-item"><a class="nav-link" href="Libraries.php">Libraries</a></li>
            <li class="nav-item"><a class="nav-link" href="Blog.php?Page=1" target="_blank">Website</a></li>
            <li class="nav-item"><a class="nav-link" href="Logout.php">Log Out</a></li>
          </ul>
          </div>
          </nav>
          <div style="height: 1px; background: #997438"></div>
          <div style="height: 10px; background: #112121;"></div>
          <div style="height: 1px; background: #997438"></div>


          <div class="container">
            <div class="col-6 col-sm-12 mainbg">
              <body style="background-image: url(images/Bg.jpg);">
          <br>
          <div>
            <?php echo ErrorMessage();
                  echo SuccessMessage(); ?>
          </div><br>
          <h1 class="text-center">Add New Book</h1>
          <br><br>
<div>
  <form action="AddNewPost.php" method="post" enctype="multipart/form-data">
    <fieldset>
      <div class="form-group"><!-- TITLE FIELD -->
        <label for="title"><span class="FieldInfo">Title:</span></label>
        <input class="form-control" type="text" name="Title" id="title" placeholder="Title">
      </div>
      <div class="form-group"><!-- AUTHOR FIELD-->
        <label for="author"><span class="FieldInfo">Author:</span></label>
        <input class="form-control" type="text" name="Author" id="author" placeholder="Author">
      </div>
      <div class="form-group"><!-- Category SELECTION -->
        <label for="categoryselect"><span class="FieldInfo">Select Category:</span></label>
        <class="form-control" name="Category" id="category" placeholder="Category">
        <select class="form-control" id="categoryselect" name="Category">
          <?php
          global $ConnectingDB;
          $ViewQuery="SELECT * FROM category ORDER BY datetime";
          $Execute = mysqli_query($Connection, $ViewQuery);
          $SrNo=0;

          while($DataRows=mysqli_fetch_array($Execute)){
          $Id=$DataRows["id"];
          $Category=$DataRows["name"];
          ?>
          <option><?php echo $Category; ?></option>
          <?php } ?>
        </select>
      </div>

      <div class="form-group"><!-- IMAGE SELECTION -->
        <label for="imageselect"><span class="FieldInfo">Select Image:</span></label>
        <input type="File" class="form-control" name="Image" id="imageselect">
      </div>
      <div class="form-group"><!-- POST AREA -->
        <label for="postarea"><span class="FieldInfo">Description:</span></label>
        <textarea class="form-control" name="Post" id="postarea" rows="13"></textarea>
      </div>
      <input class="btn btn-warning btn-block" type="Submit" name="Submit" value="Add New Book">
    </fieldset>
</div>
<br>
    </div>
</div>

<br><br><br><br><br>

<div style="height: 1px; background: #997438"></div>
<div style="height: 10px; background: #112121;"></div>
<div style="height: 1px; background: #997438"></div>
<div id="Footer">
  <hr>
  <p>
    Theme by | Yaroslava Lebedeva | &copy; 2019-2020 --- All rights reserved.
  </p>
  <hr>
</div>
<div style="height:10px; background: #262a19;"></div>
  </body>
</html>
