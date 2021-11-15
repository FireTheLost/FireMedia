<?php
$title="The Workshop";
include_once 'header.php';

if(isset($_SESSION['useruid']))
{
  if($_GET['user']!=$_SESSION['useruid'])
  {
    header("Location: index.php?user=".$_SESSION['useruid']."");
  }
  else
  {
    if($_GET['user']=="admin")
    {
      include_once 'admin.php';
    }
    else
    {
      include_once 'workshop.php';
    }
  }

  include_once 'footer.php';
}
else
{
  header("Location: login.php");
}