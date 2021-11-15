<?php
  $title="Report Blog";
  include 'header.php';
?>
<br>
<div class="signup-form-form">
<section class="signup-form">
  <div>
  <h2 id="signuph2">Report</h2>
  <form action="..\blogincludes\report.inc.php" method="post">
  <div class="signtextdiv">
    <?php
    if(isset($_GET['report']))
    {
      $id=$_GET['report'];
      echo '<input type="hidden" name="id" value="'.$id.'">';
    }
    else
    {
      header("Location: blogs.php");
    }
    ?>
    <input class="signtext" type="text" name="why" placeholder=" Why Do You Want To Report This Post?">
    <br>    
    <input class="signtext" type="text" name="other" placeholder=" Any Other Comments?">
    <br>
    <br>
    <button id="subbutton" type="submit" name="submit">Report</button>
  </div>
  </form>
  </div>
</section>
<?php
  if(isset($_GET["error"]))
  {
    if($_GET["error"]=="falselogin")
    {
      echo '<p style="color:red; font-size:20px; text-align: center">You Must Be Logged In To Report</p>';
    }
    if($_GET["error"]=="emptyinput")
    {
      echo '<p style="color:red; font-size:20px; text-align: center">Please Fill Up The First Two Fields</p>';
    }
    if($_GET["error"]=="submittionfailed")
    {
      echo '<p style="color:red; font-size:20px; text-align: center">Something Went Wrong. Please Try Again.</p>';
    }
    else if($_GET["error"]=="none")
    {
     echo '<p style="color:green; font-size:20px; text-align: center">You Have Reported This Post.<br>Our Team Will Review It And Decide If It\'s Okay.</p>';
    }
  }
?>
</div>
<?php
  include 'footer.php';
?>