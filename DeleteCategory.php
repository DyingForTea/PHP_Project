<?php require_once("include/DB.php"); ?>
<?php require_once("include/Sessions.php"); ?>
<?php require_once("include/Functions.php"); ?>
<?php Confirm_Login(); ?>
<?php
if(isset($_GET["id"]))
  $IdFromURL = $_GET['id'];
  $ConnectingDB;
  $Query = "DELETE FROM category WHERE id='$IdFromURL'";
  $Execute = mysqli_query($Connection, $Query);
if($Execute){
  $_SESSION["SuccessMessage"] = "Category deleted Successfully.";
    Redirect_to("Categories.php");
} else{
    $_SESSION["ErrorMessage"] = "Something went wrong... Try again.";
    Redirect_to("Categories.php");
}
 ?>
