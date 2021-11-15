<?php
$title="Permanently Report The Video";
include "header.php";
include "..\loginincludes\dbh.inc.php";


$id=$_GET['report'];
$type=$_GET['from'];
$to;

if ($type=="blog")
{
  $sql="SELECT * FROM blogs WHERE blogRandomKey='".$id."';";
  $result=mysqli_query($conn, $sql);
  $queryResults=mysqli_num_rows($result);

  while ($row=mysqli_fetch_assoc($result))
  {
    $to=$row['blogAuthor'];
  }
}
else
{
  $sql="SELECT * FROM files WHERE filesRandomKey='".$id."';";
  $result=mysqli_query($conn, $sql);
  $queryResults=mysqli_num_rows($result);

  while ($row=mysqli_fetch_assoc($result))
  {
    $to=$row['filesAuthor'];
  }
}


?>

<br>
<div class="signup-form-form">
<section class="signup-form">
  <div>
  <h2 id="signuph2">Permanent Report</h2>
  <form action="..\loginincludes\permanentreport.inc.php" method="post">
  <div class="signtextdiv">
    <?php
    if(isset($_GET['report']))
    {
      echo '<input type="hidden" name="id" value="'.$id.'">';
      echo '<input type="hidden" name="type" value="'.$type.'">';
      echo '<input type="hidden" name="to" value="'.$to.'">';
    }
    ?>
    <input class="signtext" type="text" name="why" placeholder=" Reason For Reporting?">
    <br>    
    <input class="signtext" type="text" name="other" placeholder=" Any Other Comments?">
    <br>
    <br>
    <button id="subbutton" type="submit" name="submit">Permanently Report</button>
  </div>
  </form>
  </div>
</section>
<?php
  if(isset($_GET["error"]))
  {
    if($_GET["error"]=="falselogin")
    {
      echo '<p style="color:red; font-size:20px; text-align: center">Fraud Alert!</p>';
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
     echo '<p style="color:green; font-size:20px; text-align: center">The Report Has Been Filed. The Uploader Has Recieved A Message</p>';
    }
  }
?>
</div>
<?php
  include 'footer.php';
?>