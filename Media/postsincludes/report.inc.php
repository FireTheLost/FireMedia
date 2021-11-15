<?php
session_start();
include 'dbh.inc.php';

if(isset($_SESSION["useruid"]))
{
  $username=$_SESSION["useruid"];
}
$filesId=$_POST['id'];
$why=$_POST["why"];
$other=$_POST["other"];

function report($conn, $filesId, $why, $other, $username)
{
  $sql="INSERT INTO filesreports (filesreportsFile, filesreportsReason, filesreportsComment, filesreportsUser) VALUES (?, ?, ?, ?);";
  $stmt=mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql))
  {
    header("location: ../codes/report.php?error=submittionfailed&report=$filesId");
    exit();
  }

  mysqli_stmt_bind_param($stmt, "ssss", $filesId, $why, $other, $username);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_close($stmt);

  $sql="UPDATE filesmeta SET filesmetaReported = filesmetaReported + 1 WHERE filesmetaRandomKey='".$filesId."';";
  $result=mysqli_query($conn, $sql);

  header("location: ../codes/report.php?error=none&report=$filesId");

  exit();
}

if (isset($_POST["submit"]))
{
  if(isset($_SESSION["useruid"]))
  {
    if (empty($why)||empty($filesId))
    {
      header("location: ../codes/report.php?error=emptyinput&report=$filesId");
      exit();
    }

    report($conn, $filesId, $why, $other, $username);

  }
  else
  {
    header("location: ../codes/report.php?error=falselogin&report=$filesId");
    exit();
  }
}
else
{
  header("location: ../codes/blogs.php");
  exit();
}
