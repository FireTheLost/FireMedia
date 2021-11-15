<?php
  $title="All Photos";
  include 'header.php';
  include '../postsincludes/dbh.inc.php';
?>

<h1 align="center">All Photos:</h1>
<?php
    $sql="SELECT * FROM files WHERE filesType='img' AND filesVisibility='Visible';";
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
                <div><a class='openblog' href='image.php?img=".$rk."'>
                  <h2>".$row['filesTitle']."</h2>
                </div>
                <div>
                 <img class='upimg' src='../uploads/images/".$srcActual."' alt='".$row['filesTitle']."&nbsp¯\_(ツ)_/¯'>
                </div>
                <div>
                  <p>".$row['filesDescription']."</p>
                </div>
              </div><br>";
      }
    }
  ?>

<br><br><br><br><br>
<?php
  include 'footer.php';
?>