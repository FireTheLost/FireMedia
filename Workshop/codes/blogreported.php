<script>
  function report()
  {
    var vidId="<?php
                 $image=$_GET['blog'];
                 echo $image; ?>";
    var report=confirm("Are You Sure You Want To Permanently Report This Blog?");
    if (report==true)
    {
      window.location.href=("permanentreport.php?report="+vidId+"&from=blog");
    }
  }

  function unreport()
  {
    var vidId="<?php
                 $image=$_GET['blog'];
                 echo $image; ?>";
    var report=confirm("Are You Sure You Want To Unreport This Blog?");
    if (report==true)
    {
      window.location.href=("unreport.inc.php?report="+vidId+"&from=blog");
    }
  }
</script>

<?php
$title="Review Reported Blog";
include "header.php";
include "..\loginincludes\dbh.inc.php";

$blog=$_GET['blog'];

$sql="SELECT * FROM blogs WHERE blogRandomKey='".$blog."';";
$result=mysqli_query($conn, $sql);
$queryResults=mysqli_num_rows($result);

$sql1="SELECT * FROM reports WHERE reportsBlog='".$blog."';";
$result1=mysqli_query($conn, $sql1);
$queryResults1=mysqli_num_rows($result1);

while ($row=mysqli_fetch_assoc($result))
{
        echo "<br>
              <div class='blogdiv'>
                <h2>".$row['blogTitle']."</h2>
                <h3>By: ".$row['blogAuthor']."</h3>
                <p>".$row['blogDate']."&nbsp|&nbsp".$row['blogViews']." Views</p>
                <p>".$row['blogDescription']."</p>
                <hr>
                <p align='justify' style='white-space: pre-wrap;'>".$row['blogBody']."</p><hr>
                <a href='javascript:report()' style='color: red; font-size:15px;'>PERMANENTLY REPORT BLOG</a>
                <br><br>
                <a href='javascript:unreport()' style='color: red; font-size:15px;'>UNREPORT BLOG</a>
                <br><br>
                <a href='message.php?to=".$row['blogAuthor']."' target='_blank' style='color: red; font-size:15px;'>MESSAGE ORIGINAL USER</a>
              </div><br><br><div class='comment'>";

        while ($row1=mysqli_fetch_assoc($result1))
        {
          echo "<br>
                <div class='comments'>
                  <p><b>Reason Reported:</b>&nbsp".$row1['reportsReason']."</p>
                  <p><b>Additional Comments</b>:&nbsp".$row1['reportsComment']."</p>
                </div>";
        }
        echo "</div>";
}

echo "<br><br><br><br><br><br><br>";
include "footer.php";