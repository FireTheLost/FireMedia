<script>
  function report()
  {
    var vidId="<?php
                 $image=$_GET['audio'];
                 echo $image; ?>";
    var report=confirm("Are You Sure You Want To Permanently Report This Audio?");
    if (report==true)
    {
      window.location.href=("permanentreport.php?report="+vidId+"&from=aud");
    }
  }

  function unreport()
  {
    var vidId="<?php
                 $image=$_GET['audio'];
                 echo $image; ?>";
    var report=confirm("Are You Sure You Want To Permanently Unreport This Audio?");
    if (report==true)
    {
      window.location.href=("unreport.inc.php?report="+vidId+"&from=aud");
    }
  }
</script>

<?php
$title="Review Reported Audio";
include "header.php";
include "..\loginincludes\dbh.inc.php";

$image=$_GET['audio'];

$sql="SELECT * FROM files WHERE filesRandomKey='".$image."';";
$result=mysqli_query($conn, $sql);
$queryResults=mysqli_num_rows($result);

$sql1="SELECT * FROM filesreports WHERE filesreportsFile='".$image."';";
$result1=mysqli_query($conn, $sql1);
$queryResults1=mysqli_num_rows($result1);

while ($row=mysqli_fetch_assoc($result))
{
        $rk=$row['filesRandomKey'];
        $src=$row['filesName'];
        $srcActual=$rk.".".$src;
        echo "<div class='blogdiv'>
                <h2>".$row['filesTitle']."</h2>
                <h3>By:&nbsp".$row['filesAuthor']."</h3>
                <p>".$row['filesDate']."&nbsp|&nbsp".$row['filesViews']." Views</p>
                <p>".$row['filesDescription']."</p>
                <hr>
                <audio controls>
                  <source src='../../Media/uploads/audios/".$srcActual."'>
                </audio><br><br>
                  <a href='javascript:report()' style='color: red; font-size:15px;'>PERMANENTLY REPORT AUDIO</a>
                  <br><br>
                  <a href='javascript:unreport()' style='color: red; font-size:15px;'>UNREPORT AUDIO</a>
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