<?php
  $title="Login To The Workshop";
  include_once 'header.php';
?>
<br>
<div class="signup-form-form">
<section class="signup-form">
  <div>
  <h2 id="signuph2">Login</h2>
  <form action="..\loginincludes\login.inc.php" method="post">
  <div class="signtextdiv">
    <input class="signtext" type="text" name="uid" placeholder=" Email/Username...">
    <br>    
    <input class="signtext" type="password" name="pwd" placeholder=" Password...">
    <br>
    <br>
    <button id="subbutton" type="submit" name="submit">Login</button>
  </div>
  </form>
  </div>
</section>

<?php
  if(isset($_GET["error"]))
  {
    if($_GET["error"]=="emptyinput")
    {
      echo '<p style="color:red; font-size:20px; text-align: center">Fill In All Fields!</p>';
    }
    else if($_GET["error"]=="wronglogin")
    {
      echo '<p style="color:red; font-size:20px; text-align: center">Sorry, You\'re Login Details Don\'t Match. Please Enter Them Again</p>';
    }
  }
?>
</div>

<?php
  include_once 'footer.php';
?>