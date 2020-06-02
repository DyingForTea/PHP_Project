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
      <li class="nav-item active"><a class="nav-link" href="Blog.php?Page=1">Website</a></li>
      <li class="nav-item"><a class="nav-link" href="List.php">Libraries</a></li>
      <li class="nav-item"><a class="nav-link" href="AboutUs.php">About Us</a></li>
      <li class="nav-item"><a class="nav-link" href="ContactUs.php">Contact Us</a></li>
      <li class="nav-item"><a class="nav-link" href="Login.php">Log In</a></li>
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

<div class="container py-5">
  <div class="row">
    <div class="col-md-12">
      <blockquote class="blockquote text-center">
        <p class="mb-0 text-light">I have always imagined that Paradise will be a kind of library.</p>
        <footer class="blockquote-footer"> Jorge Luis Borges</footer>
      </blockquote>
    </div>
  </div>

<br>

  <div class="row mt-2">
      <?php
      global $ConnectingDB;
        if(isset($_GET["SearchButton"])){
              $Search = $_GET["Search"];
              $ViewQuery = "SELECT * FROM admin_panel WHERE datetime LIKE '%$Search%'
              OR title LIKE '%$Search%' OR post LIKE '%$Search%'
              OR author LIKE '%$Search%' OR category LIKE '%$Search%'";
        }elseif(isset($_GET["Page"])){//when pagination is active!
          $Page = $_GET["Page"];
            if($Page==0 || $Page<1){
              $ShowPostFrom = 0;
            }else{
              $ShowPostFrom = ($Page*6)-6;
            }
            $ViewQuery = "SELECT * FROM admin_panel ORDER BY datetime desc LIMIT $ShowPostFrom,6";
        }else{
              $ViewQuery = "SELECT * FROM admin_panel ORDER BY datetime desc"; }

      $Execute = mysqli_query($Connection, $ViewQuery);
      $Check = mysqli_num_rows($Execute) > 0;


      if($Check){
        while($row = mysqli_fetch_array($Execute))
        { $Id = $row["id"];
        ?>
          <div class="col-md-4 mt-3">
            <div class="card shadow-lg p-2 mb-5 bg-light rounded">
              <img class="img-thumbnail" src="Upload/<?php echo $row['image']; ?>" max-width="60" max-height="80" alt="Post images">
              <div class="card-body">
                <h6 class="card-title" style="font-family: 'Montserrat', sans-serif; line-height:20px; font-weight:bold"><?php echo $row['title']; ?></h6>
                <h7 class="card-text" style="font-family: 'Montserrat', sans-serif;"><small class="text">Genre: <?php echo $row['category']; ?></small></h7>
                <p class="card-text" style="font-family: 'Montserrat', sans-serif;"><small class="text" style="font-weight:bold">By <?php echo $row['author']; ?></small></p>
                <p class="card-text" style="font-family: 'Montserrat', sans-serif;"><small class="text-muted"><?php echo $row['datetime']; ?></small></p>
                  <div class="mx-auto">
                    <a href="FullPost.php?id=<?php echo $Id; ?>"><span class="btn btn-dark">Read Description</span></a>
                  </div>
              </div>
            </div>
          </div>
      <?php
        }
      } else{
        echo "No DATA Found...";
      }

      ?>
      <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
        <div class="btn-group mr-2" role="group" aria-label="First group">
      <?php
      if(isset($Page)){
        if($Page>1){
          ?>
          <a class="btn btn-secondary" type="button" href="Blog.php?Page=<?php echo $Page-1; ?>">&laquo;</a>
        <?php      }
                      }
        ?>
      <?php
        global $ConnectingDB;
        $QueryPagination = "SELECT COUNT(*) FROM admin_panel";
        $ExecutePagination = mysqli_query($Connection, $QueryPagination);
        $RowPagination = mysqli_fetch_array($ExecutePagination);
        $TotalPosts = array_shift($RowPagination);
        $PostPagination = $TotalPosts/6;
        $PostPagination = ceil($PostPagination);
        //echo $PostPerPage;
          for($i=1;$i<=$PostPagination;$i++){
            if(isset($Page)){
              if($i==$Page){
        ?>
            <a class="btn btn-secondary active" type="button" href="Blog.php?Page=<?php echo $i; ?>"><?php echo $i; ?></a>
          <?php
        }else{ ?>
          <a class="btn btn-secondary" type="button" href="Blog.php?Page=<?php echo $i; ?>"><?php echo $i; ?></a>
          <?php
            }
          }
        }
          ?>
          <?php
          if(isset($Page)){
            if($Page+1<=$PostPagination){
              ?>
              <a class="btn btn-secondary" type="button" href="Blog.php?Page=<?php echo $Page+1; ?>">&raquo;</a>
            <?php      }
                          }
            ?>
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
