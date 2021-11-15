<?php

session_start();
date_default_timezone_set("America/New_York");
$date=date("F jS\, Y H:i:s");
$author=$_SESSION["useruid"];

$mess=$_POST["message"];
$file=$_POST["file"];

function generateRandomKey()
{
  include 'dbh.inc.php';
  $randomKey="";
  $randomList=array("A","H","I","P","Q","X","Y","f","g","n","o","v","w","3","4",")",
                  "B","G","J","O","R","W","Z","e","h","m","p","u","x","2","5","(",
                  "C","F","K","N","S","V","a","d","i","l","q","t","y","1","6","9",
                  "D","E","L","M","T","U","b","c","j","k","r","s","z","0","7","8",);
  for ($i=0; $i<=15; $i=$i+1)
  {
    $rand=mt_rand(0,63);
    $randomKey=$randomKey.$randomList[$rand];
  }
  $sql="SELECT * FROM filescomments WHERE filesCommentsRandomKey='".$randomKey."';";
  $result=mysqli_query($conn, $sql);
  $queryResults=mysqli_num_rows($result);
  if ($queryResults>0)
  {
    $randomKey=generateRandomKey();
    return $randomKey;
  }
  else
  {
    return $randomKey;
    exit();
  }
}

$rk=generateRandomKey();

function submitComment($conn, $rk, $author, $mess, $file, $date)
{
  include 'dbh.inc.php';
  $sql="INSERT INTO filesComments (filesCommentsRandomKey, filesCommentsAuthor, filesCommentsMessage, filesCommentsFile, filesCommentsDate) VALUES (?, ?, ?, ?, ?);";
  $stmt=mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql))
  {
    header("location: ../codes/image.php?img=$file");
    exit();
  }

  mysqli_stmt_bind_param($stmt, "sssss", $rk, $author, $mess, $file, $date);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_close($stmt);

  $sql="INSERT INTO filescommentslikes (filescommentslikesUser, filescommentslikesFile, filescommentslikesRandomKey) VALUES (?, ?, ?);";
  $stmt=mysqli_stmt_init($conn);

  if (!mysqli_stmt_prepare($stmt, $sql))
  {
    header("location: ../codes/image.php?img=$file");
    exit();
  }

  mysqli_stmt_bind_param($stmt, "sss", $author, $file, $rk);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_close($stmt);

  header("location: ../codes/image.php?img=$file");
  exit();
}

if (isset($_POST["submit"]))
{
  if(isset($_SESSION["useruid"]))
  {
    submitComment($conn, $rk, $author, $mess, $file, $date);
  }
  else
  {
    header("location: ../codes/image.php?img=$file");
    exit();
  }
}
else
{
  header("location: ../codes/image.php?img=$file");
  exit();
}