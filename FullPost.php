<?php require_once("include/DB.php"); ?>
<?php require_once("include/Sessions.php"); ?>
<?php require_once("include/Functions.php"); ?>

<?php
if(isset($_POST["Submit"])) {
  $Name = mysqli_real_escape_string($Connection, $_POST["Name"]);
  $Email = mysqli_real_escape_string($Connection, $_POST["Email"]);
  $Comment = mysqli_real_escape_string($Connection, $_POST["Comment"]);
  date_default_timezone_set("Europe/Sofia");
  $CurrentTime = time();
  $DateTime = strftime("%m-%B-%Y%n%H:%M:%S", $CurrentTime);
  $DateTime;
  $PostId = $_GET["id"];

if(empty($Name) || empty($Email) || empty($Comment)) {
    $_SESSION["ErrorMessage"] = "All Fields Are Required.";
} elseif(strlen($Comment)>500) {
    $_SESSION["ErrorMessage"] = "Only 500 Characters Are Allowed In Comment.";
} else{
    global $ConnectingDB;
    $PostIDFromURL = $_GET['id'];
    $Query = "INSERT INTO comments (datetime, name, email, comment, approvedby, status, admin_panel_id)
    VALUES ('$DateTime', '$Name', '$Email', '$Comment', 'Pending', 'OFF', '$PostIDFromURL')";
    $Execute = mysqli_query($Connection, $Query);
    if($Execute){
      $_SESSION["SuccessMessage"] = "Comment Submitted.";
        Redirect_to("FullPost.php?id={$PostId}");
    } else{
        $_SESSION["ErrorMessage"] = "Something went wrong... Try again.";
        Redirect_to("FullPost.php?id={$PostId}");
    }
  }
}
 ?>
<!DOCTYPE>

<html>
  <head>
    <title>The Y Word</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/bootstrap.min.js"> </script>
    <link rel="stylesheet" href="css/publicstyles.css">
  </head>
  <style>
  h2{
    color: #997438;
    text-align: center;
    font-size: 40px;
    font-weight: 300;
    font-family: 'Bookman', 'URW Bookman L', serif;
    text-transform: uppercase;
    letter-spacing: 2px;
    line-height: 48px;
    margin: 0;
  }
  </style>
<body style="background-image: url(images/Bg.jpg);">
    <div style="height: 10px; background: #997438"></div>

    <nav class="navbar navbar-expand-lg navbar-dark bg-custom">
  <a class="navbar-brand" href="Blog.php"><img src="images/logo.png" width="350" height="60"></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarTogglerDemo02">

    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
      <li class="nav-item active"><a class="nav-link" href="Blog.php?Page=1">Website</a></li>
      <li class="nav-item"><a class="nav-link" href="List.php">Libraries</a></li>
      <li class="nav-item"><a class="nav-link" href="AboutUs.php">About Us</a></li>
      <li class="nav-item"><a class="nav-link" href="ContactUs.php">Contact Us</a></li>
      <li class="nav-item"><a class="nav-link" href="Login.php">Log In</a></li>
    </ul>

    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="text" placeholder="Search" name="Search">
      <button class="btn btn-success my-2 my-sm-0" type="submit" name="SearchButton">Search</button>
    </form>
  </div>
</nav>
<div style="height: 1px; background: #997438"></div>
<div style="height: 10px; background: #112121;"></div>
<div style="height: 1px; background: #997438"></div>

<div>
  <br>
  <?php echo ErrorMessage();
        echo SuccessMessage(); ?>
</div>

<div class="container responsive col-md-5 py-5">
<br>
  <div class="row mt-3">
      <?php
      global $ConnectingDB;
        if(isset($_GET["SearchButton"])){
              $Search = $_GET["Search"];
              $ViewQuery = "SELECT * FROM admin_panel WHERE datetime LIKE '%$Search%'
              OR title LIKE '%$Search%' OR post LIKE '%$Search%'
              OR author LIKE '%$Search%' OR category LIKE '%$Search%'";
        }else{
          $PostIdFromURL = $_GET["id"];
              $ViewQuery = "SELECT * FROM admin_panel WHERE id='$PostIdFromURL' ORDER BY datetime desc"; }

      $Execute = mysqli_query($Connection, $ViewQuery);

        while($DataRows = mysqli_fetch_array($Execute))
        {
          $PostId = $DataRows["id"];
          $Image = $DataRows["image"];
          $Title = $DataRows["title"];
          $Category = $DataRows["category"];
          $Author = $DataRows["author"];
          $DateTime = $DataRows["datetime"];
          $Post = $DataRows["post"];
        ?>
      <div class="thumbnail shadow-lg p-3 mb-5 bg-white rounded">
        <img class="rounded mx-auto d-block" src="Upload/<?php echo $Image; ?>">
        <div class="caption">
          <h3 style="font-family: 'Montserrat', sans-serif; letter-spacing: 1px; line-height: 20px; margin:20px; font-weight:bold"><?php echo htmlentities($Title); ?></h3>
          <h7 style="font-family: 'Montserrat', sans-serif; padding-left:20px; font-weight:bold">Genre: <?php echo htmlentities($Category); ?></h7>
          <p style="font-family: 'Montserrat', sans-serif; padding-left:20px; font-weight:bold">By <?php echo htmlentities($Author); ?></p>
          <p style="font-family: 'Montserrat', sans-serif; padding-left:20px"><small class="text-muted"><?php echo htmlentities($DateTime); ?></small></p>
          <p style="font-family: 'Montserrat', sans-serif; padding-left:20px;"><?php echo nl2br($Post); ?></p>
          <br>
          <a href="Blog.php?Page=1"><span class="btn btn-dark">Back to the Website</span></a>
        </div>

      </div>
    <?php } ?>


<div class="container">
  <br>
  <h2>Comments</h2>
  <br>

      <div class="row">
      <div class="col-md-12" style="padding-left:16%;">
        <?php
        $ConnectingDB;
        $PostIdForComments = $_GET['id'];
        $ExtractingCommentsQuery = "SELECT * FROM comments WHERE admin_panel_id='$PostIdForComments' AND status='ON'";
        $Execute = mysqli_query($Connection, $ExtractingCommentsQuery);

        while($DataRows=mysqli_fetch_array($Execute)){
        $CommentDate = $DataRows["datetime"];
        $Comments = $DataRows["comment"];
        $CommenterName = $DataRows["name"];

         ?>

         <div class="card mb-3" style="max-width: 540px;">
        <div class="row no-gutters">
          <div class="col-md-4">
            <img src="images/user.png" class="card-img">
          </div>
          <div class="col-md-8">
            <div class="card-body">
              <h5 class="card-title" style="color:#a30000"><?php echo $CommenterName; ?></h5>
              <p class="card-text"><?php echo nl2br($Comments); ?></p>
              <p class="card-text"><small class="text-muted"><?php echo $CommentDate; ?></small></p>
            </div>
          </div>
        </div>
        </div>
        <?php } ?>
</div>
</div>


        <div class="row">
        <div class="col-md-12" style="padding-left:7%;">
      <form action="FullPost.php?id=<?php echo $PostId; ?>" method="post" enctype="multipart/form-data">
        <fieldset>
          <div class="form-group"><!-- USERNAME FIELD -->
            <label for="Name"><span class="FieldInfo"></span></label>
            <input class="form-control" type="text" name="Name" id="Name" placeholder="Name">
          </div>
          <div class="input-group mb-3"><!-- EMAIL FIELD-->
            <div class="input-group-prepend">
              <span class="input-group-text" id="basic-addon1">@</span>
            </div>
            <input class="form-control" type="email" name="Email" id="Email" placeholder="E-mail">
          </div>
          <div class="form-group"><!-- COMMENT AREA -->
            <label for="commentarea"><span class="FieldInfo"></span></label>
            <textarea class="form-control" name="Comment" id="commentarea" rows="5"></textarea>
          </div>
          <input class="btn btn-dark btn-block" type="Submit" name="Submit" value="Submit">
        </fieldset>
      </div>
    </div>
    </div>
  </div>
</div>
<div style="height: 1px; background: #997438"></div>
<div style="height: 10px; background: #112121;"></div>
<div style="height: 1px; background: #997438"></div>
<div id="Footer">
    <hr>
    <p>
      --- The Y Word | Theme by | Yaroslava Lebedeva | &copy; 2019-2020 ---
    </p>
    <p>
      This prototype of the website is made for study purpose.
    </p>
    <hr>
</div>
<div style="height:10px; background: #262a19;"></div>
  </body>
</html>
