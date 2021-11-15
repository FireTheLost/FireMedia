<?php
  $title="All Audio Files";
  include 'header.php';
  include '../postsincludes/dbh.inc.php';
?>

<h1 align="center">All Audios:</h1>
<?php
    $sql="SELECT * FROM files WHERE filesType='aud' AND filesVisibility='Visible';";
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
                <a class='openblog' href='audio.php?aud=".$rk."'>
                <h2>".$row['filesTitle']."</h2>
                <h3>By: ".$row['filesAuthor']."</h3>
                <p>".$row['filesDescription']."</p>
                <p>".$row['filesDate']."&nbsp|&nbsp1 View</p>
              </div><br>";
      }
    }
  ?>
<br><br><br><br><br><br>
<?php
  include 'footer.php';
?>