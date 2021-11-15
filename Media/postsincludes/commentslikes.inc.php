<?php
  include '..\postsincludes\dbh.inc.php';
  session_start();
  $author=$_SESSION["useruid"];
  $file=$_GET['file'];
  $fileType=$_GET['filetype'];
  $rk=$_GET['rk'];

  if($fileType=='img')
  {
    $file1="image";
  }
  elseif($fileType=='vid')
  {
    $file1="video";
  }
  elseif($fileType=='aud')
  {
    $file1="audio";
  }
 
  $sql1="SELECT * FROM filescommentslikes WHERE filescommentslikesUser='$author' AND filescommentslikesFile='$file' AND filescommentslikesRandomKey='$rk';";
  $result1=mysqli_query($conn, $sql1);

  $queryResults1=mysqli_num_rows($result1);

  if ($queryResults1==0)
  {
    $sql="UPDATE filescomments SET filesCommentsLikes = filesCommentsLikes + 1 WHERE filesCommentsFile='".$file."' AND filescommentsRandomKey='$rk';";
    $result=mysqli_query($conn, $sql);

    $sql="INSERT INTO filescommentslikes (filescommentslikesUser, filescommentslikesFile, filescommentslikesRandomKey) VALUES (?, ?, ?);";
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