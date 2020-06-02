<?php require_once("include/DB.php"); ?>
<?php require_once("include/Sessions.php"); ?>
<?php require_once("include/Functions.php"); ?>
<!DOCTYPE>
<html>
  <head>
    <title>The Y Word</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/bootstrap.min.js"> </script>
    <link rel="stylesheet" href="css/publicstyles.css">
  </head>
  <body style="background-image: url(images/Bg.jpg);">
    <div style="height: 10px; background: #997438"></div>

    <nav class="navbar navbar-expand-lg navbar-dark bg-custom">
  <a class="navbar-brand" href="Blog.php?Page=1"><img src="images/logo.png" width="350" height="60"></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarTogglerDemo02">

    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
      <li class="nav-item"><a class="nav-link" href="Blog.php?Page=1">Website</a></li>
      <li class="nav-item"><a class="nav-link" href="List.php">Libraries</a></li>
      <li class="nav-item active"><a class="nav-link" href="AboutUs.php">About Us <span class="sr-only">(current)</span></a></li>
      <li class="nav-item"><a class="nav-link" href="ContactUs.php">Contact Us</a></li>
    </ul>

    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="text" placeholder="Search" name="Search">
      <button class="btn btn-warning my-2 my-sm-0" type="submit" name="SearchButton">Search</button>
    </form>
  </div>
</nav>
<div style="height: 1px; background: #997438"></div>
<div style="height: 10px; background: #112121;"></div>
<div style="height: 1px; background: #997438"></div>

<br><br>

<div class="row">
  <div class="col-md-12">
    <blockquote class="blockquote mb-0 card-body text-center">
      <p class="mb-1 text-light" style="font-family: 'Montserrat', sans-serif; letter-spacing: 1px; line-height: 35px;">You can’t connect the dots looking forward; you can only connect them looking backward. So you have to trust that the dots will somehow connect in your future.</p>
      <footer class="blockquote-footer text-secondary" style="font-family: 'Montserrat', sans-serif; letter-spacing: 1px; line-height: 30px; font-weight:bold"> Steve Jobs</footer>
    </blockquote>
  </div>
</div>

<br>

<div class="card-columns mt-4 p-3 mb-5 rounded">
  <div class="card bg-transparent">
    <div class="card-body">
    </div>
  </div>
  <div class="card text-center">
    <div class="card-body">
      <h5 class="card-title">About Me</h5>
      <p class="card-text">I'm looking for a job!</p>
      <img class="img-thumbnail" src="images/cv_cms_project.jpg">
    </div>
  </div>
  <div class="card bg-transparent">
    <div class="card-body">
    </div>
  </div>
</div>

<br><br><br><br><br>

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
