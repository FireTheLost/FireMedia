<?php

function emptyInputSignup($name, $email, $username, $pwd, $pwdRepeat)
{
  $result;
  if (empty($name)||empty($email)||empty($username)||empty($pwd)||empty($pwdRepeat))
  {
    $result=true;
  }
  else
  {
    $result=false;
  }
  return $result;
}

function invalidUid($username)
{
  $result;
  if (!preg_match("/^[a-zA-Z0-9]*$/", $username))
  {
    $result=true;
  }
  else
  {
    $result=false;
  }
  return $result;
}

function invalidEmail($email)
{
  $result;
  if (!filter_var($email, FILTER_VALIDATE_EMAIL))
  {
    $result=true;
  }
  else
  {
    $result=false;
  }
  return $result;
}

function pwdMatch($pwd, $pwdRepeat)
{
  $result;
  if ($pwd!==$pwdRepeat)
  {
    $result=true;
  }
  else
  {
    $result=false;
  }
  return $result;
}

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

function generateRandomKey()
{
  include 'dbh.inc.php';
  $randomKey="";
  $randomList=array("A","H","I","P","Q","X","Y","f","g","n","o","v","w","3","4",")",
                  "B","G","J","O","R","W","Z","e","h","m","p","u","x","2","5","(",
                  "C","F","K","N","S","V","a","d","i","l","q","t","y","1","6","9",
                  "D","E","L","M","T","U","b","c","j","k","r","s","z","0","7","8",);
  for ($i=0; $i<=11; $i=$i+1)
  {
    $rand=mt_rand(0,63);
    $randomKey=$randomKey.$randomList[$rand];
  }

  $sql="SELECT * FROM users WHERE usersRandomKey='".$randomKey."';";
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

function createUser($conn, $name, $email, $username, $pwd, $date, $rk)
{
  $sql="INSERT INTO users (usersName, usersEmail, usersUid, usersPwd, usersJoined, usersRandomKey) VALUES (?, ?, ?, ?, ?, ?);";
  $stmt=mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql))
  {
    header("location: ../codes/signup.php?error=usercreationfailed");
    exit();
  }

  $hashedPwd=password_hash($pwd, PASSWORD_DEFAULT);

  mysqli_stmt_bind_param($stmt, "ssssss", $name, $email, $username, $hashedPwd, $date, $rk);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_close($stmt);
  header("location: ../codes/signup.php?error=none");

  exit();
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
    header("location: ../codes/videos.php");
    exit();
  }
}