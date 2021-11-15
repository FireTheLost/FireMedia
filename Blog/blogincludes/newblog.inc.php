<?php
session_start();
date_default_timezone_set("America/New_York");
$date=date("F jS\, Y H:i:s");
$author=$_SESSION["useruid"];

function generateRandomKey()
{
  include 'dbh.inc.php';
  $randomKey="";
  $randomList=array("A","H","I","P","Q","X","Y","f","g","n","o","v","w","3","4",")",
                  "B","G","J","O","R","W","Z","e","h","m","p","u","x","2","5","(",
                  "C","F","K","N","S","V","a","d","i","l","q","t","y","1","6","9",
                  "D","E","L","M","T","U","b","c","j","k","r","s","z","0","7","8",);
  for ($i=0; $i<=7; $i=$i+1)
  {
    $rand=mt_rand(0,63);
    $randomKey=$randomKey.$randomList[$rand];
  }

  $sql="SELECT * FROM blogs WHERE blogRandomKey='".$randomKey."';";
  $result=mysqli_query($conn, $sql);
  $queryResults=mysqli_num_rows($result);
  if ($queryResults>0)
  {
    $randomKey=generateRandomKey();
    return $randomKey;
  }
  else
  {
    $sql="SELECT * FROM files WHERE filesRandomKey='".$randomKey."';";
    $result=mysqli_query($conn, $sql);
    $queryResults=mysqli_num_rows($result);
    if($queryResults>0)
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
}

$rk=generateRandomKey();

function submitBlog($conn, $title, $content, $author, $date, $desc, $views, $rk)
{
  include 'dbh.inc.php';
  $sql="INSERT INTO blogs (blogTitle, blogBody, blogAuthor, blogDate, blogDescription, blogViews, blogRandomKey) VALUES (?, ?, ?, ?, ?, ?, ?);";
  $stmt=mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql))
  {
    header("location: ../codes/newblog.php?error=submittionfailed");
    exit();
  }

  mysqli_stmt_bind_param($stmt, "sssssis", $title, $content, $author, $date, $desc, $views, $rk);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_close($stmt);
  

  $sql="INSERT INTO blogmeta (blogmetaRandomKey) VALUES (?);";
  $stmt=mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql))
  {
    header("location: ../codes/newblog.php?error=submittionfailed");
    exit();
  }

  mysqli_stmt_bind_param($stmt, "s", $rk);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_close($stmt);

  $sql="INSERT INTO likes (likesUser, likesBlog, likesType) VALUES (?, ?, ?);";
  $stmt=mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql))
  {
    header("location: ../codes/newblog.php?error=submittionfailed");
    exit();
  }

  $type1="like";
  mysqli_stmt_bind_param($stmt, "sss", $author, $rk, $type1);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_close($stmt);
  header("location: ../codes/newblog.php?error=none&url=".$rk."");

  exit();
}

if (isset($_POST["submit"]))
{
  if(isset($_SESSION["useruid"]))
  {
    $title=$_POST["title"];
    $content=$_POST["content"];
    $desc=$_POST["desc"];
  
    if (strlen($title)>256)
    {
      header("location: ../codes/newblog.php?error=titlerror");
      exit();
    }
    if (strlen($desc)>64)
    {
      header("location: ../codes/newblog.php?error=descriptionerror");
      exit();
    }
    if (empty($title)||empty($content))
    {
      header("location: ../codes/newblog.php?error=emptyinput");
      exit();
    }

    submitBlog($conn, $title, $content, $author, $date, $desc, 0, $rk);

  }
  else
  {
    header("location: ../codes/newblog.php?error=falselogin");
    exit();
  }
}
else
{
  header("location: ../codes/newblog.php");
  exit();
}