<?php
include "..\loginincludes\dbh.inc.php";

$id=$_GET['report'];
$type=$_GET['from'];

if($type=="blog")
{
  $sql="UPDATE blogmeta SET blogmetaReported = 0 WHERE blogmetaRandomKey='".$id."';";
  $result=mysqli_query($conn, $sql);

  header("location: index.php?user=admin&page=reports&subpage=blogs");
}
else
{
  $sql="UPDATE filesmeta SET filesmetaReported = 0 WHERE filesmetaRandomKey='".$id."';";
  $result=mysqli_query($conn, $sql);

  if($type=="aud")
  {
    header("location: index.php?user=admin&page=reports&subpage=audios");
  }
  elseif($type=="vid")
  {
    header("location: index.php?user=admin&page=reports&subpage=videos");
  }
  else
  {
    header("location: index.php?user=admin&page=reports&subpage=photos");
  }
}