<?php require_once("include/DB.php"); ?>
<?php require_once("include/Sessions.php"); ?>
<?php require_once("include/Functions.php"); ?>
<?php Confirm_Login(); ?>
<!DOCTYPE>

<html>
  <head>
    <title>Comment Section</title>
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
    <li class="nav-item"><a class="nav-link" href="Dashboard.php">Dashboard</a></li>
    <li class="nav-item"><a class="nav-link" href="Admins.php">Admins</a></li>
    <li class="nav-item active"><a class="nav-link" href="Comments.php">Comments</a></li>
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
        <div class="col-8 col-sm-12 mainbg shadow-lg bg-transparent" style="padding-left:6%;">
          <body style="background-image: url(images/Bg.jpg);">
          <br><br>
              <div><?php echo ErrorMessage();
                        echo SuccessMessage();
           ?></div>
          <h1 class="text-center">Comment Section</h1>
          <br><br>
          <!--UN-APPROVED COMMENT SECTION BEGINNING -->
          <h3 class="text-center" style="color:#f00; font-weight:300; font-family: 'Bookman', 'URW Bookman L', serif;
          text-transform: uppercase;letter-spacing: 2px;line-height:48px; margin:0;">Un-Approved Comments</h3>
            <div>
              <table class="table table-responsive bg-dark">
                <tr>
                  <th>&nbsp;&nbsp;&nbsp;No.&nbsp;&nbsp;&nbsp;</th>
                  <th>&nbsp;&nbsp;&nbsp;Name&nbsp;&nbsp;&nbsp;</th>
                  <th>&nbsp;&nbsp;&nbsp;Date</th>
                  <th>&nbsp;&nbsp;&nbsp;Comment</th>
                  <th>&nbsp;&nbsp;&nbsp;Approve&nbsp;&nbsp;&nbsp;</th>
                  <th>&nbsp;&nbsp;&nbsp;Delete&nbsp;&nbsp;&nbsp;</th>
                  <th>&nbsp;&nbsp;&nbsp;Details&nbsp;&nbsp;&nbsp;</th>
                </tr>
                <?php
                    $ConnectingDB;
                  $Query = "SELECT * FROM comments WHERE status='OFF'";
                  $Execute = mysqli_query($Connection, $Query);
                  $SrNo = 0;
                  while($DataRows=mysqli_fetch_array($Execute)){
                    $CommentId = $DataRows["id"];
                    $DateTimeComment = $DataRows["datetime"];
                    $PersonName = $DataRows["name"];
                    $PersonComment = $DataRows["comment"];
                    $CommentedPostId = $DataRows["admin_panel_id"];
                    $SrNo++;
                  ?>
                  <tr>
                    <td><?php echo htmlentities($SrNo); ?></td>
                    <td style="color:#bd9c42"><?php
                    if(strlen($PersonName)>12) {$PersonName=substr($PersonName,0,12).'...';}
                    echo htmlentities($PersonName);
                    ?></td>
                    <td><?php echo htmlentities($DateTimeComment); ?></td>
                    <td><?php
                    if(strlen($PersonComment)>30) {$PersonComment=substr($PersonComment,0,30).'...';}
                    echo htmlentities($PersonComment); ?></td>
                    <td>&nbsp;&nbsp;&nbsp;<a href="ApproveComment.php?id=<?php echo $CommentId; ?>"><span class="btn btn-success">Approve</span></a>&nbsp;&nbsp;&nbsp;</td>
                    <td>&nbsp;&nbsp;&nbsp;<a href="DeleteComment.php?id=<?php echo $CommentId; ?>"><span class="btn btn-danger">Delete</span></a>&nbsp;&nbsp;&nbsp;</td>
                    <td>&nbsp;&nbsp;&nbsp;<a href="FullPost.php?id=<?php echo $CommentedPostId; ?>" target="_blank"><span class="btn btn-info">Live Preview</span></a>&nbsp;&nbsp;&nbsp;</td>
                  </tr>
                <?php } ?>
              </table>
            </div> <!--UN-APPROVED COMMENT SECTION ENDING -->
<br>
            <!--APPROVED COMMENT SECTION -->
            <h3 class="text-center" style="color:#15ff00; font-weight:300; font-family: 'Bookman', 'URW Bookman L', serif;
            text-transform: uppercase;letter-spacing: 2px;line-height:48px; margin:0;">Approved Comments</h3>
              <div>
                <table class="table bg-dark table-responsive">
                  <tr>
                    <th>&nbsp;&nbsp;&nbsp;No.</th>
                    <th>&nbsp;&nbsp;&nbsp;Name</th>
                    <th>&nbsp;&nbsp;&nbsp;Date</th>
                    <th>&nbsp;&nbsp;&nbsp;Comment</th>
                    <th>&nbsp;&nbsp;Approved &nbsp;&nbsp;By</th>
                    <th>&nbsp;&nbsp;Revert &nbsp;&nbsp;Approve</th>
                    <th>&nbsp;&nbsp;Delete</th>
                    <th>&nbsp;&nbsp;Details</th>
                  </tr>
                  <?php
                    $ConnectingDB;
                      $Query = "SELECT * FROM comments WHERE status='ON'";
                      $Execute = mysqli_query($Connection, $Query);
                      $SrNo = 0;
                    while($DataRows=mysqli_fetch_array($Execute)){
                      $CommentId = $DataRows["id"];
                      $DateTimeComment = $DataRows["datetime"];
                      $PersonName = $DataRows["name"];
                      $PersonComment = $DataRows["comment"];
                      $ApprovedBy = $DataRows["approvedby"];
                      $CommentedPostId = $DataRows["admin_panel_id"];
                      $SrNo++;
                    ?>
                    <tr>
                      <td><?php echo htmlentities($SrNo); ?></td>
                      <td style="color:#bd9c42"><?php
                      if(strlen($PersonName)>12) {$PersonName=substr($PersonName,0,12).'..';}
                      echo htmlentities($PersonName);
                      ?></td>
                      <td><?php echo htmlentities($DateTimeComment); ?></td>
                      <td><?php
                      if(strlen($PersonComment)>30) {$PersonComment=substr($PersonComment,0,30).'...';}
                      echo htmlentities($PersonComment); ?></td>
                      <td><?php echo htmlentities($ApprovedBy); ?></td>
                      <td><a href="Dis-AproveComment.php?id=<?php echo $CommentId; ?>"><span class="btn btn-warning">Dis-Approve</span></a></td>
                      <td><a href="DeleteComment.php?id=<?php echo $CommentId; ?>"><span class="btn btn-danger">Delete</span></a></td>
                      <td><a href="FullPost.php?id=<?php echo $CommentedPostId; ?>" target="_blank"><span class="btn btn-info">Preview</span></a></td>
                    </tr>
                  <?php } ?>
                </table>
              </div> <!--APPROVED COMMENT SECTION ENDING -->
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
