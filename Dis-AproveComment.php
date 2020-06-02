<?php require_once("include/DB.php"); ?>
<?php require_once("include/Sessions.php"); ?>
<?php require_once("include/Functions.php"); ?>
<?php Confirm_Login(); ?>
<?php
if(isset($_GET["id"]))
  $IdFromURL = $_GET['id'];
  $ConnectingDB;
  $Query = "UPDATE comments SET status='OFF' WHERE id='$IdFromURL'";
  $Execute = mysqli_query($Connection, $Query);
if($Execute){
  $_SESSION["SuccessMessage"] = "Dis-Approved.";
    Redirect_to("Comments.php");
} else{
    $_SESSION["ErrorMessage"] = "Something went wrong... Try again.";
    Redirect_to("Comments.php");
}
 ?>
