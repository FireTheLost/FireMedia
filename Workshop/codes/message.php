<?php
$title="Message User";
include "header.php";
include "..\loginincludes\dbh.inc.php";

if (isset($_GET['to']))
{
  $to=$_GET['to'];
}
else
{
  header("Location: login.php");
}

?>

<div class="signup-form-form">
<section class="signup-form">
  <div>
  <h2 id="signuph2">Message <?php echo $to; ?></h2>
  <form action="..\loginincludes\sendmessage.inc.php?to=<?php echo $to; ?>" method="post">
  <div class="signtextdiv">
    <input class="signtext" type="text" name="mess" placeholder=" Your Message Here...">
    <br>
    <br>
    <button id="subbutton" type="submit" name="submit">Message</button>
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
     echo '<p style="color:green; font-size:20px; text-align: center">Message Sent!</p>';
    }
  }
?>
</div>

<?php

include "footer.php";