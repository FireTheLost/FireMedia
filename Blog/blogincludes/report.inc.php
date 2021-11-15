<?php
session_start();
include 'dbh.inc.php';

if(isset($_SESSION["useruid"]))
{
  $username=$_SESSION["useruid"];
}

$blogId=$_POST['id'];
$why=$_POST["why"];
$other=$_POST["other"];

function report($conn, $blogId, $why, $other, $username)
{
  $sql="INSERT INTO reports (reportsBlog, reportsReason, reportsComment, reportsUser) VALUES (?, ?, ?, ?);";
  $stmt=mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql))
  {
    header("location: ../codes/report.php?error=submittionfailed&report=$blogId");
    exit();
  }

  mysqli_stmt_bind_param($stmt, "ssss", $blogId, $why, $other, $username);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_close($stmt);

  $sql="UPDATE blogmeta SET blogmetaReported = blogmetaReported + 1 WHERE blogmetaRandomKey='".$blogId."';";
  $result=mysqli_query($conn, $sql);

  header("location: ../codes/report.php?error=none&report=$blogId");

  exit();
}

if (isset($_POST["submit"]))
{
  if(isset($_SESSION["useruid"]))
  {
    if (empty($why)||empty($blogId))
    {
      header("location: ../codes/report.php?error=emptyinput&report=$blogId");
      exit();
    }

    report($conn, $blogId, $why, $other, $username);

  }
  else
  {
    header("location: ../codes/report.php?error=falselogin&report=$blogId");
    exit();
  }
}
else
{
  header("location: ../codes/blogs.php");
  exit();
}
