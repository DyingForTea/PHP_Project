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
    Redirect_to("EditPost.php?Edit=<?php echo $SearchQueryParameter; ?>");
} elseif(strlen($Title)<2) {
    $_SESSION["ErrorMessage"] = "Title should be at least 2 characters.";
    Redirect_to("EditPost.php?Edit=<?php echo $SearchQueryParameter; ?>");
} else{
    global $ConnectingDB;
    $EditFromURL = $_GET['Edit'];

    $Query = "UPDATE admin_panel SET datetime='$DateTime', title='$Title', author='$Author',
    category='$Category', image='$Image', post='$Post', admin='$Admin' WHERE id='$EditFromURL'";

    $Execute = mysqli_query($Connection, $Query);
    move_uploaded_file($_FILES["Image"]["tmp_name"], $Target);
    if($Execute){
      $_SESSION["SuccessMessage"] = "Updated.";
      Redirect_to("Dashboard.php");
    } else{
        $_SESSION["Dashboard"] = "Something went wrong... Try again.";
        Redirect_to("Dashboard.php");
    }
  }
}
 ?>

<html>
  <head>
    <title>Edit information</title>
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
            <li class="nav-item"><a class="nav-link" href="AddNewPost.php">Add New Book</a></li>
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
          <h1 class="text-center">Edit information</h1>
          <br><br>
<div>
          <?php
          $SearchQueryParameter = $_GET['Edit'];
          $ConnectingDB;
          $Query = "SELECT * FROM admin_panel WHERE id='$SearchQueryParameter'";
          $ExecuteQuery = mysqli_query($Connection, $Query);
          while($DataRows=mysqli_fetch_array($ExecuteQuery)){
            $TitleToBeUpdated = $DataRows['title'];
            $AuthorToBeUpdated = $DataRows['author'];
            $CategoryToBeUpdated = $DataRows['category'];
            $ImageToBeUpdated = $DataRows['image'];
            $PostToBeUpdated = $DataRows['post'];
          }
          ?>
  <form action="EditPost.php?Edit=<?php echo $SearchQueryParameter; ?>" method="post" enctype="multipart/form-data">
    <fieldset>
      <div class="form-group"><!-- TITLE FIELD -->
        <label for="title"><span class="FieldInfo">Title:</span></label>
          <input value="<?php echo $TitleToBeUpdated; ?>" class="form-control" type="text" name="Title" id="title" placeholder="Title">
      </div>
      <div class="form-group"><!-- AUTHOR FIELD-->
        <label for="author"><span class="FieldInfo">Author:</span></label>
        <input value="<?php echo $AuthorToBeUpdated; ?>" class="form-control" type="text" name="Author" id="author" placeholder="Author">
      </div>
      <div class="form-group"><!-- Category SELECTION -->
        <span class="FieldInfo" style="color:white;">Previous Category: <?php echo $CategoryToBeUpdated; ?></span>
        <br>
        <label for="categoryselect"><span class="FieldInfo">New Category:</span></label>
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
<br>
      <div class="form-group"><!-- IMAGE SELECTION -->
        <span class="FieldInfo" style="color:white;">Previous Image: </span>
        <img src="Upload/<?php echo $ImageToBeUpdated; ?>" width="130px"; height="80px">
        <br>
        <label for="imageselect"><span class="FieldInfo">Image:</span></label>
        <input type="File" class="form-control" name="Image" id="imageselect">
      </div>
      <div class="form-group"><!-- POST AREA -->
        <label for="postarea"><span class="FieldInfo">Edit Description:</span></label>
        <textarea class="form-control" name="Post" id="postarea" rows="13">
          <?php echo $PostToBeUpdated; ?>
        </textarea>
      </div>
      <br>
      <input class="btn btn-success btn-block" type="Submit" name="Submit" value="Update">
    </fieldset>
</div>
<br>
    </div>
</div>
<br><br><br><br><br><br><br><br><br><br><br>

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
