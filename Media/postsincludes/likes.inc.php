<?php
  session_start();
  $author=$_SESSION["useruid"];
  $type=$_GET['type'];
  $vidId=$_GET['vid'];
  include 'dbh.inc.php';
  $filetype=$_GET['filetype'];

if($filetype=="vid")
{
  if($type=="like")
  {
    $sql="UPDATE filesmeta SET filesmetaLikes = filesmetaLikes + 1 WHERE filesmetaRandomKey='".$vidId."';";
    $result=mysqli_query($conn, $sql);
 
    $sql="SELECT * FROM fileslikes WHERE fileslikesFile='".$vidId."' AND fileslikesUser='".$author."';";
    $result=mysqli_query($conn, $sql);
    $queryResults=mysqli_num_rows($result);
    if ($queryResults==0)
    {
      $sql="INSERT INTO fileslikes (fileslikesUser, fileslikesFile, fileslikesType) VALUES (?, ?, ?);";
      $stmt=mysqli_stmt_init($conn);

      if (!mysqli_stmt_prepare($stmt, $sql))
      {
        header("location: ../codes/video.php?vid=$vidId");
        exit();
      }
      $type1="like";
      mysqli_stmt_bind_param($stmt, "sss", $author, $vidId, $type1);
      mysqli_stmt_execute($stmt);
      mysqli_stmt_close($stmt);
      header("location: ../codes/video.php?vid=$vidId");
    }
    else
    {
      $sql="UPDATE fileslikes SET fileslikesType = 'like' WHERE fileslikesFile='".$vidId."' AND fileslikesUser='".$author."';";
      $result=mysqli_query($conn, $sql);
      header("location: ../codes/video.php?vid=$vidId");
    }
  }
  elseif($type=="unlike")
  {
    $sql="UPDATE filesmeta SET filesmetaLikes = filesmetaLikes - 1 WHERE filesmetaRandomKey='".$vidId."';";
    $result=mysqli_query($conn, $sql);

    $sql="UPDATE fileslikes SET fileslikesType = 'unlike' WHERE fileslikesFile='".$vidId."' AND fileslikesUser='".$author."';";
    $result=mysqli_query($conn, $sql);
    header("location: ../codes/video.php?vid=$vidId");
  }
}
elseif($filetype=="img")
{
  if($type=="like")
  {
    $sql="UPDATE filesmeta SET filesmetaLikes = filesmetaLikes + 1 WHERE filesmetaRandomKey='".$vidId."';";
    $result=mysqli_query($conn, $sql);
 
    $sql="SELECT * FROM fileslikes WHERE fileslikesFile='".$vidId."' AND fileslikesUser='".$author."';";
    $result=mysqli_query($conn, $sql);
    $queryResults=mysqli_num_rows($result);
    if ($queryResults==0)
    {
      $sql="INSERT INTO fileslikes (fileslikesUser, fileslikesFile, fileslikesType) VALUES (?, ?, ?);";
      $stmt=mysqli_stmt_init($conn);

      if (!mysqli_stmt_prepare($stmt, $sql))
      {
        header("location: ../codes/image.php?img=$vidId");
        exit();
      }
      $type1="like";
      mysqli_stmt_bind_param($stmt, "sss", $author, $vidId, $type1);
      mysqli_stmt_execute($stmt);
      mysqli_stmt_close($stmt);
      header("location: ../codes/image.php?img=$vidId");
    }
    else
    {
      $sql="UPDATE fileslikes SET fileslikesType = 'like' WHERE fileslikesFile='".$vidId."' AND fileslikesUser='".$author."';";
      $result=mysqli_query($conn, $sql);
      header("location: ../codes/image.php?img=$vidId");
    }
  }
  elseif($type=="unlike")
  {
    $sql="UPDATE filesmeta SET filesmetaLikes = filesmetaLikes - 1 WHERE filesmetaRandomKey='".$vidId."';";
    $result=mysqli_query($conn, $sql);

    $sql="UPDATE fileslikes SET fileslikesType = 'unlike' WHERE fileslikesFile='".$vidId."' AND fileslikesUser='".$author."';";
    $result=mysqli_query($conn, $sql);
    header("location: ../codes/image.php?img=$vidId");
  }
}
elseif($filetype=="aud")
{
  if($type=="like")
  {
    $sql="UPDATE filesmeta SET filesmetaLikes = filesmetaLikes + 1 WHERE filesmetaRandomKey='".$vidId."';";
    $result=mysqli_query($conn, $sql);
 
    $sql="SELECT * FROM fileslikes WHERE fileslikesFile='".$vidId."' AND fileslikesUser='".$author."';";
    $result=mysqli_query($conn, $sql);
    $queryResults=mysqli_num_rows($result);
    if ($queryResults==0)
    {
      $sql="INSERT INTO fileslikes (fileslikesUser, fileslikesFile, fileslikesType) VALUES (?, ?, ?);";
      $stmt=mysqli_stmt_init($conn);

      if (!mysqli_stmt_prepare($stmt, $sql))
      {
        header("location: ../codes/audio.php?aud=$vidId");
        exit();
      }
      $type1="like";
      mysqli_stmt_bind_param($stmt, "sss", $author, $vidId, $type1);
      mysqli_stmt_execute($stmt);
      mysqli_stmt_close($stmt);
      header("location: ../codes/audio.php?aud=$vidId");
    }
    else
    {
      $sql="UPDATE fileslikes SET fileslikesType = 'like' WHERE fileslikesFile='".$vidId."' AND fileslikesUser='".$author."';";
      $result=mysqli_query($conn, $sql);
      header("location: ../codes/audio.php?aud=$vidId");
    }
  }
  elseif($type=="unlike")
  {
    $sql="UPDATE filesmeta SET filesmetaLikes = filesmetaLikes - 1 WHERE filesmetaRandomKey='".$vidId."';";
    $result=mysqli_query($conn, $sql);

    $sql="UPDATE fileslikes SET fileslikesType = 'unlike' WHERE fileslikesFile='".$vidId."' AND fileslikesUser='".$author."';";
    $result=mysqli_query($conn, $sql);
    header("location: ../codes/audio.php?aud=$vidId");
  }
}