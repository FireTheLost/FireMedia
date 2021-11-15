<?php
  $title="New Blog Post";
  include 'header.php';
?>
<br>
<div class="signup-form-form">
<section class="signup-form">
  <div>
  <h2 id="signuph2">New Blog Post</h2>
  <form action="..\blogincludes\newblog.inc.php" method="post">
  <div class="signtextdiv">
    <input class="signtext" type="text" name="title" placeholder=" Title...">
    <br>
    <input class="signtext" type="text" name="desc" placeholder=" Write A Short, Catchy Description...">
    <br>
    <textarea class="signtextarea" type="text" name="content" placeholder=" Content..."></textarea>
    <br>
    <br>
    <button id="subbutton" type="submit" name="submit">Post</button>
  </div>
  </form>
  </div>
</section>
<?php
  if(isset($_GET["error"]))
  {
    if($_GET["error"]=="falselogin")
    {
      echo '<p style="color:red; font-size:20px; text-align: center">You Must Be Logged In To Submit A Post</p>';
    }
    if($_GET["error"]=="titlerror")
    {
      echo '<p style="color:red; font-size:20px; text-align: center">The Title Must Be Less Than 256 Characters</p>';
    }
    if($_GET["error"]=="descriptionerror")
    {
      echo '<p style="color:red; font-size:20px; text-align: center">The Description Must Be Less Than 64 Characters</p>';
    }
    if($_GET["error"]=="emptyinput")
    {
      echo '<p style="color:red; font-size:20px; text-align: center">Please Fill Up All The Fields</p>';
    }
    if($_GET["error"]=="submittionfailed")
    {
      echo '<p style="color:red; font-size:20px; text-align: center">Something Went Wrong. Please Try Again.</p>';
    }
    else if($_GET["error"]=="none")
    {
     echo '<p style="color:green; font-size:20px; text-align: center">Post Success!</p>';
     echo '<p style="font-size:20px; text-align: center;">Link To Blog Post:&nbsp<a style="color: #4561F7;" href="blog.php?blog='.$_GET["url"].'">blog.php?blog='.$_GET["url"].'</a></p>';
    }
  }
?>

</div>
<br><br><br><br><br><br><br>
<?php
  include 'footer.php';
?>