<?php
  include '..\blogincludes\dbh.inc.php';
  session_start();
  $author=$_SESSION["useruid"];
  $file=$_GET['file'];
  $fileType=$_GET['filetype'];
  $rk=$_GET['rk'];

  $file1="blog";
 
  $sql1="SELECT * FROM commentslikes WHERE commentslikesUser='$author' AND commentslikesFile='$file' AND commentslikesRandomKey='$rk';";
  $result1=mysqli_query($conn, $sql1);

  $queryResults1=mysqli_num_rows($result1);

  if ($queryResults1==0)
  {
    $sql="UPDATE comments SET commentsLikes = commentsLikes + 1 WHERE commentsFile='".$file."' AND commentsRandomKey='$rk';";
    $result=mysqli_query($conn, $sql);

    $sql="INSERT INTO commentslikes (commentslikesUser, commentslikesFile, commentslikesRandomKey) VALUES (?, ?, ?);";
    $stmt=mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql))
    {
      //header("location: ../codes/$file1.php?$fileType=$file");
      exit();
    }

    mysqli_stmt_bind_param($stmt, "sss", $author, $file, $rk);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../codes/$file1.php?$fileType=$file");
  }
  else
  {
    header("location: ../codes/$file1.php?$fileType=$file");
  }