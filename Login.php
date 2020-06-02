<?php require_once("include/DB.php"); ?>
<?php require_once("include/Sessions.php"); ?>
<?php require_once("include/Functions.php"); ?>
<?php
if(isset($_POST["Submit"])) {
  $Username = mysqli_real_escape_string($Connection, $_POST["Username"]);
  $Password = mysqli_real_escape_string($Connection, $_POST["Password"]);

if(empty($Username) || empty($Password)) {
    $_SESSION["ErrorMessage"] = "All Fields must be filled.";
    Redirect_to("Login.php");
} else{
    $Found_Account = Login_Attempt($Username, $Password);
    $_SESSION["User_Id"] = $Found_Account["id"];
    $_SESSION["Username"] = $Found_Account["username"];
      if($Found_Account){
        $_SESSION["SuccessMessage"] = "Welcome Back, {$_SESSION["Username"]}";
        Redirect_to("Dashboard.php");
      }else{
        $_SESSION["ErrorMessage"] = "Invalid Username or Password. Try again.";
        Redirect_to("Login.php");
      }
  }
}
 ?>

<!DOCTYPE>

<html>
  <head>
    <title>Log In</title>
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
  </nav>
<div style="height: 1px; background: #997438"></div>
<div style="height: 10px; background: #112121;"></div>
<div style="height: 1px; background: #997438"></div>

<br><br><br><br><br><br>
<div class="container">
  <div class="col-md-6 offset-md-3 mainbg">
    <body style="background-image: url(images/Bg.jpg);">
      <div>
        <?php echo ErrorMessage();
              echo SuccessMessage(); ?>
      </div>
        <br>
        <br>
        <h1 class="text-center">Log In</h1>
        <br>
<div>
  <br>
  <form action="Login.php" method="post">
    <fieldset>
      <div class="form-group">
        <label for="Username"><span class="FieldInfo"></span></label>
        <input type="text" class="form-control" name="Username" id="Username" placeholder="Username">
      </div>
      <br>
      <div class="form-group">
        <label for="Password"><span class="FieldInfo"></span></label>
        <input type="Password" class="form-control" name="Password" id="categoryname" placeholder="Password">
      </div>
      <br>
      <input class="btn btn-success btn-block" type="Submit" name="Submit" value="Log In">
    </fieldset>
</div>
  </div>
</div>

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
