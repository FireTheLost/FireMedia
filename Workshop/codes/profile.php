<?php
include '..\loginincludes\dbh.inc.php';
$username1 = $_GET['user'];

$sql = "SELECT * FROM users WHERE usersUid='" . $username1 . "';";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$queryResults = mysqli_num_rows($result);

$sql1 = "SELECT * FROM files WHERE filesAuthor='" . $username1 . "';";
$sql2 = "SELECT * FROM blogs WHERE blogAuthor='" . $username1 . "';";
$result1 = mysqli_query($conn, $sql1);
$result2 = mysqli_query($conn, $sql2);
$queryResults = mysqli_num_rows($result1)+mysqli_num_rows($result2);

$sql="SELECT * FROM viewscounter WHERE viewscounterUser = '" . $username1 . "';";
$result=mysqli_query($conn, $sql);
$sql1="SELECT * FROM filesviewscounter WHERE filesViewscounteruser = '" . $username1 . "';";
$result1=mysqli_query($conn, $sql1);
$queryViews=(mysqli_num_rows($result))+(mysqli_num_rows($result1));

echo "

<div class='profile'>
   <div class='profileinfo'>
      <h1 class='profilelements'>User:&nbsp" . $username1 . "</h1>
      <h3 class='profilelements'>Joined On: " . $row['usersJoined'] . "</h3>
      <h3 class='profilelements'>Total Posts:&nbsp" . $queryResults . "</h3>
      <h3 class='profilelements'>Total Views:&nbsp" . $queryViews . "</h3>
   </div>
   <textarea class='profileabout' name='about' maxlength='320' readonly>" . $row['usersAbout'] . "</textarea>
</div>
</div>
<button id='savedesc'>
  <a id='updatelink' href='update.php?user=".$username1."&what=description'>
    Update Description
  </a>
</button>


";