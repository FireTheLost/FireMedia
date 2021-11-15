<?php

session_start();
include 'dbh.inc.php';

if(isset($_SESSION["useruid"]))
{
  $username=$_SESSION["useruid"];
}
$filesId=$_POST['id'];
$type=$_POST['type'];
$why=$_POST["why"];
$other=$_POST["other"];
$to=$_POST["to"];

function report($conn, $filesId, $why, $to, $username, $type)
{
  $status = "Not Seen";

  $sql="INSERT INTO usersmessages (usersmessagesMessage, usersmessagesFrom, usersmessagesTo, usersmessagesStatus) VALUES (?, ?, ?, ?);";
  $stmt=mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql))
  {
    header("location: ../codes/permanentreport.php?error=submittionfailed&report=$filesId&from=$type");
    exit();
  }

  mysqli_stmt_bind_param($stmt, "ssss", $why, $username, $to, $status);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_close($stmt);

  header("location: ../codes/permanentreport.php?error=none&report=$filesId&from=$type");

  if($type=="blog")
  {
    $sql="UPDATE blogs SET blogsVisibility = 'Reported' WHERE blogRandomKey='".$filesId."';";
    $result=mysqli_query($conn, $sql);

    $sql="UPDATE blogmeta SET blogmetaReported = 0 WHERE blogmetaRandomKey='".$filesId."';";
    $result=mysqli_query($conn, $sql);
  }
  else
  {
    $sql="UPDATE files SET filesVisibility = 'Reported' WHERE filesRandomKey='".$filesId."';";
    $result=mysqli_query($conn, $sql);

    $sql="UPDATE filesmeta SET filesmetaReported = 0 WHERE filesmetaRandomKey='".$filesId."';";
    $result=mysqli_query($conn, $sql);
  }

  exit();
}

if (isset($_POST["submit"]))
{
  if(isset($_SESSION["useruid"]))
  {
    if (empty($why)||empty($filesId))
    {
      header("location: ../codes/permanentreport.php?error=emptyinput&report=$filesId&from=$type");
      exit();
    }

    report($conn, $filesId, $why, $to, $username, $type);

  }
  else
  {
    header("location: ../codes/permanentreport.php?error=falselogin&report=$filesId&from=$type");
    exit();
  }
}
else
{
  header("location: ../codes/index.php");
  exit();
}
