<?php
  $title="Signup";
  include_once 'header.php';
?>
<br>
<div class="signup-form-form">
<section class="signup-form">
  <div>
  <h2 id="signuph2">Sign Up</h2>
  <form action="..\loginincludes\signup.inc.php" method="post">
  <div class="signtextdiv">
    <input class="signtext" type="text" name="name" placeholder=" Full Name...">
    <br>    
    <input class="signtext" type="text" name="email" placeholder=" Email...">
    <br>    
    <input class="signtext" type="text" name="uid" placeholder=" Username...">
    <br>    
    <input class="signtext" type="password" name="pwd" placeholder=" Password...">
    <br>    
    <input class="signtext" type="password" name="pwdrepeat" placeholder=" Repeat Password...">
    <br>
    <br>
    <button id="subbutton" type="submit" name="submit">Sign Up</button>
    <p>Already Have An Account? <a href="login.php">Login Here</a></p>
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
    else if($_GET["error"]=="invalidusername")
    {
      echo '<p style="color:red; font-size:20px; text-align: center">Invalid Username</p>';
    }
    else if($_GET["error"]=="invalidemail")
    {
      echo '<p style="color:red; font-size:20px; text-align: center">Input A Proper Email</p>';
    }
    else if($_GET["error"]=="passwordmismatch")
    {
      echo '<p style="color:red; font-size:20px; text-align: center">The Passwords Don\'t Match: Please Type Them In Again</p>';
    }
    else if($_GET["error"]=="emailexists")
    {
      echo '<p style="color:red; font-size:20px; text-align: center">An Account With This Username/Email Already Exists</p>';
    }
    else if($_GET["error"]=="usercreationfailed")
    {
      echo '<p style="color:red; font-size:20px; text-align: center">Sorry, Something Went Wrong: Please Try Again</p>';
    }
    else if($_GET["error"]=="stmtfailed")
    {
      echo '<p style="color:red; font-size:20px; text-align: center">Sorry, Something Went Wrong: Please Try Again</p>';
    }
    else if($_GET["error"]=="none")
    {
     header("location: ../codes/login.php");
    }
  }
?>
</div>

<?php
  include_once 'footer.php';
?>