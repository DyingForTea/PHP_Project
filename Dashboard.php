<?php require_once("include/DB.php"); ?>
<?php require_once("include/Sessions.php"); ?>
<?php require_once("include/Functions.php"); ?>
<?php Confirm_Login(); ?>
<!DOCTYPE>

<html>
  <head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/bootstrap.min.js"> </script>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/table.css">
  </head>
  <style>
  .bg-custom{
    background-color: #262a19;
  }
  .mainbg{
    background-color: #4a513b;
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
    <li class="nav-item active"><a class="nav-link" href="Dashboard.php">Dashboard</a></li>
    <li class="nav-item"><a class="nav-link" href="Admins.php">Admins</a></li>

    <li class="nav-item"><a class="nav-link" href="Comments.php">Comments
      <?php // comment badge
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
        <div class="col-8 col-sm-12 mainbg shadow-lg bg-transparent">
          <body style="background-image: url(images/Bg.jpg);">
          <br><br>
              <div><?php echo ErrorMessage();
                        echo SuccessMessage();
           ?></div>
          <h1 class="text-center">Admin Dashboard</h1>
          <br><br>
            <div>
              <table class="table table-responsive bg-dark">
                <tr>
                  <th>No.</th>
                  <th>Title</th>
                  <th>Author</th>
                  <th>Genre</th>
                  <th>Date & Time</th>
                  <th>Admin</th>
                  <th>Image</th>
                  <th>Comments</th>
                  <th>Action</th>
                  <th>Details</th>
                </tr>
                <?php
                  global $ConnectingDB;
                  $ViewQuery = "SELECT * FROM admin_panel ORDER BY datetime desc";
                  $Execute = mysqli_query($Connection, $ViewQuery);
                  $SrNo = 0;
                  while($DataRows=mysqli_fetch_array($Execute)){
                    $Id = $DataRows["id"];
                    $Title = $DataRows["title"];
                    $Author = $DataRows["author"];
                    $Category = $DataRows["category"];
                    $DateTime = $DataRows["datetime"];
                    $Admin = $DataRows["admin"];
                    $Image = $DataRows["image"];
                    $Post = $DataRows["post"];
                    $SrNo++;
                  ?>
                  <tr>
                    <td><?php echo $SrNo; ?></td>
                    <td style="color:#bd9c42"><?php
                    if(strlen($Title)>12) {$Title=substr($Title,0,12).'...';}
                    echo $Title;
                    ?></td>
                    <td><?php
                    if(strlen($Author)>12) {$Author=substr($Author,0,12).'..';}
                    echo $Author; ?></td>
                    <td><?php
                    if(strlen($Category)>8) {$Category=substr($Category,0,8).'..';}
                    echo $Category; ?></td>
                    <td><?php
                    if(strlen($DateTime)>11) {$DateTime=substr($DateTime,0,11);}
                    echo $DateTime; ?></td>
                    <td><?php
                    if(strlen($Admin)>6) {$Admin=substr($Admin,0,6).'..';}
                    echo $Admin; ?></td>
                    <td><img src="Upload/<?php echo $Image; ?>" width=90px; height=50px></td>
                    <td>

<?php // UNapproved comments
 $ConnectingDB;
$QueryUnApproved = "SELECT COUNT(*) FROM comments WHERE admin_panel_id='$Id' AND status='ON'";
$ExecuteUnApproved = mysqli_query($Connection, $QueryUnApproved);
$RowsUnApproved = mysqli_fetch_array($ExecuteUnApproved);
$TotalUnApproved = array_shift($RowsUnApproved);

  if($TotalUnApproved>0){
?>
<span class="badge badge-danger" style="margin-left:10%;">
<?php echo $TotalUnApproved;?>
</span>
<?php } ?>

<?php // Approved comments
 $ConnectingDB;
$QueryApproved = "SELECT COUNT(*) FROM comments WHERE admin_panel_id='$Id' AND status='ON'";
$ExecuteApproved = mysqli_query($Connection, $QueryApproved);
$RowsApproved = mysqli_fetch_array($ExecuteApproved);
$TotalApproved = array_shift($RowsApproved);

if($TotalApproved>0){
?>
<span class="badge badge-success" style="margin-left:70%;">
<?php echo $TotalApproved;?>
</span>
<?php } ?>



                    </td>
                    <td>
                      <a href="EditPost.php?Edit=<?php echo $Id; ?>"><span class="btn btn-warning">Edit</span></a>
                      <a href="DeletePost.php?Delete=<?php echo $Id; ?>"><span class="btn btn-danger">Delete</span></a>
                    </td>
                    <td><a href="FullPost.php?id=<?php echo $Id; ?>" target="_blank"><span class="btn btn-info">Preview</span></a></td>
                  </tr>

                <?php } ?>

              </table>
            </div>
        </div> <!-- Ending of Main Area -->
      </div> <!-- Ending of Row -->

<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
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
