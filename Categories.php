<?php require_once("include/DB.php"); ?>
<?php require_once("include/Sessions.php"); ?>
<?php require_once("include/Functions.php"); ?>
<?php Confirm_Login(); ?>
<?php
if(isset($_POST["Submit"])) {
  $Category = mysqli_real_escape_string($Connection, $_POST["Category"]);
  date_default_timezone_set("Europe/Sofia");
  $CurrentTime = time();
  $DateTime = strftime("%m-%B-%Y%n%H:%M:%S", $CurrentTime);
  $DateTime;
  $Admin = $_SESSION["Username"];

if(empty($Category)) {
    $_SESSION["ErrorMessage"] = "All Fields must be filled.";
    Redirect_to("Categories.php");
} elseif(strlen($Category)>99) {
    $_SESSION["ErrorMessage"] = "Too long name.";
    Redirect_to("Categories.php");
} else{
    global $ConnectingDB;
    $Query = "INSERT INTO category(datetime, name, creator) VALUES('$DateTime', '$Category', '$Admin')";
    $Execute = mysqli_query($Connection, $Query);
    if($Execute){
      $_SESSION["SuccessMessage"] = "New Category was added successfully.";
      Redirect_to("Categories.php");
    } else{
        $_SESSION["ErrorMessage"] = "Something went wrong... Try again.";
        Redirect_to("Categories.php");
    }
  }
}
 ?>

<!DOCTYPE>

<html>
  <head>
    <title>Manage Categories</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/bootstrap.min.js"> </script>

    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/btn.css">
  </head>
          <style>
          table {
            border: 1.5px solid #d5bda7;
            width: 100%;
            max-width: 100%;
          }
          th {
            font-weight: normal;
            font-size: 16px;
            color: white;
            text-transform: uppercase;
            border-right: 1px solid #d5bda7;
            border-top: 1px solid #d5bda7;
            border-left: 1px solid #d5bda7;
            border-bottom: 1px solid #d5bda7;
            padding: 20px;
          }
          td {
            color: white;
            border-right: 1px dashed #d5bda7;
            padding: 10px 20px;
          }

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
                <?php // comments badge in menu
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
              <li class="nav-item"><a class="nav-link" href="AddNewPost.php">Add New Book</a></li>
              <li class="nav-item active"><a class="nav-link" href="Categories.php">Categories</a></li>
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
        </div>
        <br>
        <h1 class="text-center">Manage Categories</h1>
        <br>
<div>
  <br>
  <form action="Categories.php" method="post">
    <fieldset>
      <div class="form-group">
        <label for="categoryname"><span class="FieldInfo">Name:</span></label>
        <input type="text" class="form-control" name="Category" id="categoryname" placeholder="New Category's Name">
      </div>
      <input class="btn btn-warning btn-block" type="Submit" name="Submit" value="Add New Category">
    </fieldset>
</div>

<br>

<div> <!-- TABLE -->
  <table class="bg-dark">
    <tr>
      <th>Sr No.</th>
      <th>Date & Time</th>
      <th>Category</th>
      <th>Admin</th>
      <th>Action</th>
    </tr>
    <?php
global $ConnectingDB;
$ViewQuery="SELECT * FROM category ORDER BY datetime";
$Execute = mysqli_query($Connection, $ViewQuery);
$SrNo=0;

while($DataRows=mysqli_fetch_array($Execute)){
  $Id=$DataRows["id"];
  $DateTime=$DataRows["datetime"];
  $Category=$DataRows["name"];
  $Creator=$DataRows["creator"];
  $SrNo++;
    ?>
    <tr>
      <td><?php echo $SrNo; ?></td>
      <td><?php echo $DateTime; ?></td>
      <td><?php echo $Category; ?></td>
      <td><?php echo $Creator; ?></td>
      <td><a href="DeleteCategory.php?id=<?php echo $Id; ?>"><span class="btn btn-danger">Delete</span></a></td>
    </tr>
<?php } ?>
  </table>
</div> <!-- Ending of TABLE -->
</div>
  </div>
    </div>
<br><br><br><br><br><br><br><br><br><br>
<br><br><br><br><br><br><br><br><br><br>
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
