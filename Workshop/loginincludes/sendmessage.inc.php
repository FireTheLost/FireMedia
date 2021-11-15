<?php
session_start();

function sendMessage($conn, $from, $to, $message, $status)
{
  include 'dbh.inc.php';

  $sql="INSERT INTO usersmessages (usersmessagesMessage, usersmessagesFrom, usersmessagesTo, usersmessagesStatus) VALUES (?, ?, ?, ?);";
  $stmt=mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql))
  {
    header("location: ../codes/message.php?error=submittionfailed&to=".$to."");
    exit();
  }

  mysqli_stmt_bind_param($stmt, "ssss", $message, $from, $to, $status);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_close($stmt);
  
  header("location: ../codes/message.php?error=none&to=".$to."");
  exit();
}



if (isset($_POST["submit"]))
{
  if(isset($_SESSION["useruid"]))
  {
    include 'dbh.inc.php';

    $to = $_GET['to'];
    $from = $_SESSION['useruid'];
    $message = $_POST['mess'];
    $status = "Not Seen";

    if (empty($message))
    {
      header("location: ../codes/message.php?error=emptyinput&to=".$to."");
      exit();
    }

    sendMessage($conn, $from, $to, $message, $status);
    exit();

  }
  else
  {
    header("location: ../codes/message.php?error=falselogin&to=".$to."");
    exit();
  }
}
else
{
  header("location: ../codes/message.php");
  exit();
}