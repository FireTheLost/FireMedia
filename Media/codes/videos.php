<?php
  $title="All Videos";
  include 'header.php';
  include '../postsincludes/dbh.inc.php';
?>

<h1 align="center">All Videos:</h1>
<?php
    $sql="SELECT * FROM files WHERE filesType='vid' AND filesVisibility='Visible';";
    $result=mysqli_query($conn, $sql);
    $queryResults=mysqli_num_rows($result);

    if ($queryResults>0)
    {
      while ($row=mysqli_fetch_assoc($result))
      {
        $rk=$row['filesRandomKey'];
        $src=$row['filesName'];
        $srcActual=$rk.".".$src;
        echo "<div class='photo'>
                <div><a class='openblog' href='video.php?vid=".$rk."'>
                  <h2>".$row['filesTitle']."</h2>
                </div>
                <div>
                 <video class='upvid' src='../uploads/videos/".$srcActual."' alt='".$row['filesTitle']."&nbsp¯\_(ツ)_/¯'>
                </div>
                <div>
                  <p>".$row['filesDescription']."</p>
                </div>
              </div><br>";
      }
    }
  ?>
<br><br><br><br><br><br>
<?php
  include 'footer.php';
?>