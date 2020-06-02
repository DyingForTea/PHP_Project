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
      <li class="nav-item"><a class="nav-link" href="AboutUs.php">About Us</a></li>
      <li class="nav-item active"><a class="nav-link" href="ContactUs.php">Contact Us<span class="sr-only">(current)</span></a></li>
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

<body style="background-image: url(images/Bg.jpg);">
<br><br>

<div class="row">
  <div class="col-md-12">
    <blockquote class="blockquote mb-0 card-body text-center">
      <p class="mb-1 text-light" style="font-family: 'Montserrat', sans-serif; letter-spacing: 1px; line-height: 35px;">′Classic′ - a book which people praise and don't read.</p>
      <footer class="blockquote-footer text-secondary" style="font-family: 'Montserrat', sans-serif; letter-spacing: 1px; line-height: 30px; font-weight:bold"> Mark Twain</footer>
    </blockquote>
  </div>
</div>

<br>

<div class="card-columns mt-4 mt-4 p-3 mb-5 rounded">
<div class="card p-3 bg-transparent">
  <blockquote class="blockquote mb-0 card-body">
  </blockquote>
</div>
  <div class="card border-info text-center p-3">
    <div class="card-body text-info">
      <h5><img src="images/LinkedIn.jpg" style="width:30px; height:30px">&nbsp;&nbsp;Me on LinkedIn!</h5>
      <a href="https://www.linkedin.com/in/yaroslava-l-386565117/" class="btn btn-info">Hire me</a>
      <br>
    </div>
  </div>
  <div class="card border-primary text-center p-3">
    <div class="card-body text-primary">
      <h5><img src="images/fb.jpg" style="width:30px; height:30px">&nbsp;&nbsp;Me on Facebook!</h5>
      <a href="https://www.facebook.com/profile.php?id=100010376856338" class="btn btn-primary">Message me</a>
      <br>
    </div>
  </div>
  <div class="card border-danger text-center p-3">
    <div class="card-body text-danger">
      <h5><img src="images/gmail.png" style="width:30px; height:30px">&nbsp;&nbsp;Gmail Me!</h5>
      <a href="mailto:yarily09@gmail.com" class="btn btn-danger">Mail Me!</a>
      <br>
    </div>
  </div>
  <div class="card p-3 bg-transparent">
    <blockquote class="blockquote mb-0 card-body">
    </blockquote>
  </div>
  <div class="card border-secondary text-center p-3">
    <div class="card-body text-secondary">
      <h5><img src="images/discord.png" style="width:30px; height:30px">&nbsp;&nbsp;Me on Discord: DyingForTea#6726</h5>
      <a href="https://discord.com" class="btn btn-secondary">Call Me!</a>
    </div>
  </div>
</div>

<br><br><br><br><br><br><br><br><br><br>
</body>
</html>
