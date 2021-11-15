<?php
  session_start();
  $author=$_SESSION["useruid"];
  $type=$_GET['type'];
  $blogId=$_GET['blog'];
  include 'dbh.inc.php';

  if($type=="like")
  {
    $sql="UPDATE blogmeta SET blogmetaLikes = blogmetaLikes + 1 WHERE blogmetaRandomKey='".$blogId."';";
    $result=mysqli_query($conn, $sql);
 
    $sql="SELECT * FROM likes WHERE likesBlog='".$blogId."' AND likesUser='".$author."';";
    $result=mysqli_query($conn, $sql);
    $queryResults=mysqli_num_rows($result);
    if ($queryResults==0)
    {
      $sql="INSERT INTO likes (likesUser, likesBlog, likesType) VALUES (?, ?, ?);";
      $stmt=mysqli_stmt_init($conn);

      if (!mysqli_stmt_prepare($stmt, $sql))
      {
        header("location: ../codes/blog.php?blog=$blogId");
        exit();
      }
      $type1="like";
      mysqli_stmt_bind_param($stmt, "sss", $author, $blogId, $type1);
      mysqli_stmt_execute($stmt);
      mysqli_stmt_close($stmt);
      header("location: ../codes/blog.php?blog=$blogId#likeimg");
    }
    else
    {
      $sql="UPDATE likes SET likesType = 'like' WHERE likesBlog='".$blogId."' AND likesUser='".$author."';";
      $result=mysqli_query($conn, $sql);
      header("location: ../codes/blog.php?blog=$blogId#likeimg");
    }
  }
  elseif($type=="unlike")
  {
    $sql="UPDATE blogmeta SET blogmetaLikes = blogmetaLikes - 1 WHERE blogmetaRandomKey='".$blogId."';";
    $result=mysqli_query($conn, $sql);

    $sql="UPDATE likes SET likesType = 'unlike' WHERE likesBlog='".$blogId."' AND likesUser='".$author."';";
    $result=mysqli_query($conn, $sql);
    header("location: ../codes/blog.php?blog=$blogId#likeimg");
  }