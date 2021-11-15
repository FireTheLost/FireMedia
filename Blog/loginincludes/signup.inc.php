<?php

if (isset($_POST["submit"]))
{
  date_default_timezone_set("America/New_York");
  $date=date("F jS\, Y");
  $name=$_POST["name"];
  $email=$_POST["email"];
  $username=$_POST["uid"];
  $pwd=$_POST["pwd"];
  $pwdRepeat=$_POST["pwdrepeat"];

  require_once 'dbh.inc.php';
  require_once 'functions.inc.php';

  if (emptyInputSignup($name, $email, $username, $pwd, $pwdRepeat)!==false)
  {
    header("location: ../codes/signup.php?error=emptyinput");
    exit();
  }
  if (invalidUid($username)!==false)
  {
    header("location: ../codes/signup.php?error=invalidusername");
    exit();
  }
  if (invalidEmail($email)!==false)
  {
    header("location: ../codes/signup.php?error=invalidemail");
    exit();
  }
  if (pwdMatch($pwd, $pwdRepeat)!==false)
  {
    header("location: ../codes/signup.php?error=passwordmismatch");
    exit();
  }
  if (uidExists($conn, $username, $email)!==false)
  {
    header("location: ../codes/signup.php?error=emailexists");
    exit();
  }

  createUser($conn, $name, $email, $username, $pwd, $date, $rk);

}
else
{
  header("location: ../codes/signup.php");
  exit();
}