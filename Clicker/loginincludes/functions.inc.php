<?php

function uidExists($conn, $username, $email)
{
  $sql="SELECT * FROM users WHERE usersUid = ? OR usersEmail = ?;";
  $stmt=mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql))
  {
    header("location: ../codes/signup.php?error=stmtfailed");
    exit();
  }
  mysqli_stmt_bind_param($stmt, "ss", $username, $email);
  mysqli_stmt_execute($stmt);

  $resultData=mysqli_stmt_get_result($stmt);

  if ($row=mysqli_fetch_assoc($resultData))
  {
    return $row;
  }
  else
  {
    $result=false;
    return $result;
  }
  mysqli_stmt_close($stmt);
}

function emptyInputLogin($username, $pwd)
{
  $result;
  if (empty($username)||empty($pwd))
  {
    $result=true;
  }
  else
  {
    $result=false;
  }
  return $result;
}

function loginUser($conn, $username, $pwd)
{
  $uidExists=uidExists($conn, $username, $username);

  if($uidExists===false)
  {
    header("location: ../codes/login.php?error=wronglogin");
    exit();
  }

  $pwdHashed=$uidExists["usersPwd"];
  $checkPwd=password_verify($pwd, $pwdHashed);

  if($checkPwd===false)
  {
    header("location: ../codes/login.php?error=wronglogin");
    exit();
  }
  else if($checkPwd===true)
  {
    session_start();
    $_SESSION["userid"]=$uidExists["usersId"];
    $_SESSION["useruid"]=$uidExists["usersUid"];
    $user=$_SESSION["useruid"];
    header("location: ../codes/clicker.php");
    exit();
  }
}