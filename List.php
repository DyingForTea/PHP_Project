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
</style>


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
      <li class="nav-item active"><a class="nav-link" href="List.php">Libraries <span class="sr-only">(current)</span></a></li>
      <li class="nav-item"><a class="nav-link" href="AboutUs.php">About Us</a></li>
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

<div class="card-columns mt-4">
  <div class="card bg-transparent">
    <div class="card-body">
    </div>
  </div>
  <div class="card text-center shadow-lg bg-transparent">
    <div class="card-body bg-light bg-transparent">
      <h5 class="card-title" style="color:white;">All the books on the website are avaliable in:</h5>
      <br>
      <div> <!-- TABLE -->
        <table class="table-responsive bg-dark">
          <tr>
            <th>Sr No.</th>
            <th>Library's Name</th>
            <th>Address</th>
          </tr>
          <?php
      global $ConnectingDB;
      $ViewQuery="SELECT * FROM libraries ORDER BY name";
      $Execute = mysqli_query($Connection, $ViewQuery);
      $SrNo=0;

      while($DataRows=mysqli_fetch_array($Execute)){
        $Id=$DataRows["id"];
        $Library=$DataRows["name"];
        $Address=$DataRows["address"];
        $SrNo++;
          ?>
          <tr>
            <td><?php echo $SrNo; ?></td>
            <td><?php echo $Library; ?></td>
            <td><?php echo $Address; ?></td>
          </tr>
      <?php } ?>
        </table>
      </div> <!-- Ending of TABLE -->
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
</html>
