<script>
  function report()
  {
    var vidId="<?php
                 $video=$_GET['video'];
                 echo $video; ?>";
    var report=confirm("Are You Sure You Want To Permanently Report This Video?");
    if (report==true)
    {
      window.location.href=("permanentreport.php?report="+vidId+"&from=vid");
    }
  }

  function unreport()
  {
    var vidId="<?php
                 $image=$_GET['video'];
                 echo $image; ?>";
    var report=confirm("Are You Sure You Want To Unreport This Video?");
    if (report==true)
    {
      window.location.href=("unreport.inc.php?report="+vidId+"&from=vid");
    }
  }
</script>

<?php
$title="Review Reported Video";
include "header.php";
include "..\loginincludes\dbh.inc.php";

$video=$_GET['video'];

$sql="SELECT * FROM files WHERE filesRandomKey='".$video."';";
$result=mysqli_query($conn, $sql);
$queryResults=mysqli_num_rows($result);

$sql1="SELECT * FROM filesreports WHERE filesreportsFile='".$video."';";
$result1=mysqli_query($conn, $sql1);
$queryResults1=mysqli_num_rows($result1);

while ($row=mysqli_fetch_assoc($result))
{
        $rk=$row['filesRandomKey'];
        $src=$row['filesName'];
        $srcActual=$rk.".".$src;
        echo "<div class='blogdiv2'>
                <div>
                  <video controls autoplay class='showvid' src='../../Media/uploads/videos/".$srcActual."' alt='¯\_(ツ)_/¯'>
                </div>
                <div>
                  <h2>".$row['filesTitle']."</h2>
                  <h3>By:&nbsp".$row['filesAuthor']."</h3>
                  <p>".$row['filesDate']."&nbsp|&nbsp".$row['filesViews']."&nbspViews</p>
                  <p>".$row['filesDescription']."</p><br>
                  <a href='javascript:report()' style='color: red; font-size:15px;'>PERMANENTLY REPORT VIDEO</a>
                  <br><br>
                  <a href='javascript:unreport()' style='color: red; font-size:15px;'>UNREPORT VIDEO</a>
                  <br><br>
                  <a href='message.php?to=".$row['filesAuthor']."' target='_blank' style='color: red; font-size:15px;'>MESSAGE ORIGINAL USER</a>
                </div>
              </div><br><br><div class='comment1'>";

        while ($row1=mysqli_fetch_assoc($result1))
        {
          echo "<br>
                <div class='comments'>
                  <p><b>Reason Reported:</b>&nbsp".$row1['filesreportsReason']."</p>
                  <p><b>Additional Comments</b>:&nbsp".$row1['filesreportsComment']."</p>
                </div>";
        }
        echo "</div>";
}

echo "<br><br><br><br><br><br><br>";
include "footer.php";