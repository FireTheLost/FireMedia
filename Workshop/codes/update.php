<?php
include '..\loginincludes\dbh.inc.php';
$username1 = $_GET['user'];
$what = $_GET['what'];
$title = "Update ".ucfirst($what);
include 'header.php';

$sql = "SELECT * FROM users WHERE usersUid='" . $username1 . "';";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

if($what == "description")
{
	echo "<form action='..\loginincludes\update.inc.php?user=".$username1."&what=description' method='post'>
		  <textarea type='text' name='info' id='updatedesc' name='about' maxlength='320'>" . $row['usersAbout'] . "</textarea>
          <button id='updatedescbtn' type='submit' name='submit'>
		    Save Description
          </button>
		  </form>";


  echo "<br><br><br>";

  if(isset($_GET["error"]))
  {
      if($_GET["error"]=="one")
      {
        echo '<p style="color:red; font-size:25px; text-align: center">Sorry, Something Went Wrong, Probably From Our Side. Please Try Again.</p>';
      }
      else if($_GET["error"]=="none")
      {
        echo '<p style="color:green; font-size:25px; text-align: center">Update Success!</p>';
      }
  }
}
if($what == "blog")
{
  $randomKey=mysqli_real_escape_string($conn, $_GET['id']);
  $sql="SELECT * FROM blogs WHERE blogRandomKey='$randomKey'";
  $result=mysqli_query($conn, $sql);
  $queryResult=mysqli_num_rows($result);

  $row=mysqli_fetch_assoc($result);
      
  echo '<div class="signup-form-form">
  <section class="signup-form">
    <div>
    <h2 id="signuph2">Update Blog Post</h2>
    <form action="..\loginincludes\update.inc.php?id='.$randomKey.'&what=blog" method="post">
    <div class="signtextdiv">
      <input class="signtext" type="text" name="title" value="'.$row['blogTitle'].'">
      <br>
      <input class="signtext" type="text" name="desc" value="'.$row['blogDescription'].'">
      <br>
      <textarea class="signtextarea" type="text" name="content">'.$row['blogBody'].'</textarea>
      <br>
      <br>
      <button id="subbutton" type="submit" name="submit">Save All Changes</button>
    </div>
    </form>
    </div>
  </section>';

    if(isset($_GET["error"]))
    {
      if($_GET["error"]=="title" || $_GET["error"]=="desc" || $_GET["error"]=="body")
      {
        echo '<p style="color:red; font-size:25px; text-align: center">Sorry, Something Went Wrong, Please Try Again.</p>';
      }
      if($_GET["error"]=="empty")
      {
        echo '<p style="color:red; font-size:25px; text-align: center">Please Fill Up All The Fields</p>';
      }
      else if($_GET["error"]=="none")
      {
        echo '<p style="color:green; font-size:25px; text-align: center">Update Success!</p>';
      }
    }
  
  echo "</div>";
}
if($what == "video")
{
  $randomKey=$_GET['id'];
  $sql="SELECT * FROM files WHERE filesRandomKey='$randomKey'";
  $result=mysqli_query($conn, $sql);
  $queryResult=mysqli_num_rows($result);

  $row=mysqli_fetch_assoc($result);

  $rk=$row['filesRandomKey'];
  $src=$row['filesName'];
  $srcActual=$rk.".".$src;
      
  echo '<div class="signup-form-form">
  <section class="signup-form">
    <div>
    <h2 id="signuph2">Update Video Post</h2>
    <form action="..\loginincludes\update.inc.php?id='.$randomKey.'&what=video" method="post">
    <div class="signtextdiv">
      <input class="signtext" type="text" name="title" value="'.$row['filesTitle'].'">
      <br>
      <input class="signtext" type="text" name="desc" value="'.$row['filesDescription'].'">
      <br>
      <br>
      <br>
      <div>
        <video controls autoplay class="showvid" src="../../Media/uploads/videos/'.$srcActual.'" alt="'.$row['filesTitle'].'&nbsp¯\_(ツ)_/¯">
      </div>
      <br>
      <br>
      <button id="subbutton" type="submit" name="submit">Save All Changes</button>
    </div>
    </form>
    </div>
  </section>';

    if(isset($_GET["error"]))
    {
      if($_GET["error"]=="title" || $_GET["error"]=="body")
      {
        echo '<p style="color:red; font-size:25px; text-align: center">Sorry, Something Went Wrong, Please Try Again.</p>';
      }
      if($_GET["error"]=="empty")
      {
        echo '<p style="color:red; font-size:25px; text-align: center">Please Fill Up All The Fields</p>';
      }
      else if($_GET["error"]=="none")
      {
        echo '<p style="color:green; font-size:25px; text-align: center">Update Success!</p>';
      }
    }
  
  echo "</div>";
}
if($what == "photo")
{
  $randomKey=$_GET['id'];
  $sql="SELECT * FROM files WHERE filesRandomKey='$randomKey'";
  $result=mysqli_query($conn, $sql);
  $queryResult=mysqli_num_rows($result);

  $row=mysqli_fetch_assoc($result);

  $rk=$row['filesRandomKey'];
  $src=$row['filesName'];
  $srcActual=$rk.".".$src;
      
  echo '<div class="signup-form-form">
  <section class="signup-form">
    <div>
    <h2 id="signuph2">Update Photo Post</h2>
    <form action="..\loginincludes\update.inc.php?id='.$randomKey.'&what=photo" method="post">
    <div class="signtextdiv">
      <input class="signtext" type="text" name="title" value="'.$row['filesTitle'].'">
      <br>
      <input class="signtext" type="text" name="desc" value="'.$row['filesDescription'].'">
      <br>
      <br>
      <br>
      <div>
        <img class="showimg" src="../../Media/uploads/images/'.$srcActual.'" alt="'.$row['filesTitle'].'&nbsp¯\_(ツ)_/¯">
      </div>
      <br>
      <br>
      <button id="subbutton" type="submit" name="submit">Save All Changes</button>
    </div>
    </form>
    </div>
  </section>';

    if(isset($_GET["error"]))
    {
      if($_GET["error"]=="title" || $_GET["error"]=="body")
      {
        echo '<p style="color:red; font-size:25px; text-align: center">Sorry, Something Went Wrong, Please Try Again.</p>';
      }
      if($_GET["error"]=="empty")
      {
        echo '<p style="color:red; font-size:25px; text-align: center">Please Fill Up All The Fields</p>';
      }
      else if($_GET["error"]=="none")
      {
        echo '<p style="color:green; font-size:25px; text-align: center">Update Success!</p>';
      }
    }
  
  echo "</div>";
}
if($what == "audio")
{
  $randomKey=$_GET['id'];
  $sql="SELECT * FROM files WHERE filesRandomKey='$randomKey'";
  $result=mysqli_query($conn, $sql);
  $queryResult=mysqli_num_rows($result);

  $row=mysqli_fetch_assoc($result);

  $rk=$row['filesRandomKey'];
  $src=$row['filesName'];
  $srcActual=$rk.".".$src;
      
  echo '<div class="signup-form-form">
  <section class="signup-form">
    <div>
    <h2 id="signuph2">Update Audio Post</h2>
    <form action="..\loginincludes\update.inc.php?id='.$randomKey.'&what=audio" method="post">
    <div class="signtextdiv">
      <input class="signtext" type="text" name="title" value="'.$row['filesTitle'].'">
      <br>
      <input class="signtext" type="text" name="desc" value="'.$row['filesDescription'].'">
      <br>
      <br>
      <br>
      <audio controls>
        <source src="../../Media/uploads/audios/'.$srcActual.'">
      </audio>
      <br>
      <br>
      <button id="subbutton" type="submit" name="submit">Save All Changes</button>
    </div>
    </form>
    </div>
  </section>';

    if(isset($_GET["error"]))
    {
      if($_GET["error"]=="title" || $_GET["error"]=="body")
      {
        echo '<p style="color:red; font-size:25px; text-align: center">Sorry, Something Went Wrong, Please Try Again.</p>';
      }
      if($_GET["error"]=="empty")
      {
        echo '<p style="color:red; font-size:25px; text-align: center">Please Fill Up All The Fields</p>';
      }
      else if($_GET["error"]=="none")
      {
        echo '<p style="color:green; font-size:25px; text-align: center">Update Success!</p>';
      }
    }
  
  echo "</div>";
}