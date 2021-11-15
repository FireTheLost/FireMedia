<?php
  $title="All Blogs";
  include 'header.php';
  include '../blogincludes/dbh.inc.php';
?>

<h1 align="center">All Articles:</h1>

  <?php
    $sql="SELECT * FROM blogs WHERE blogsVisibility='Visible'";
    $result=mysqli_query($conn, $sql);
    $queryResults=mysqli_num_rows($result);

    if ($queryResults>0)
    {
      while ($row=mysqli_fetch_assoc($result))
      {
        if($row['blogViews']==1)
        {
          echo "<div class='blogdiv1'><a class='openblog' target='_blank' href='blog.php?blog=".$row['blogRandomKey']."'>
                  <h2>".$row['blogTitle']."</h2>
                  <h3>By: ".$row['blogAuthor']."</h3>
                  <p>".$row['blogDate']."&nbsp|&nbsp1 View</p>
                  <p>".$row['blogDescription']."</p>
                </a></div>
                <br>";
        }
        elseif($row['blogViews']!=1)
        {
          echo "<div class='blogdiv1'><a class='openblog' target='_blank' href='blog.php?blog=".$row['blogRandomKey']."'>
                  <h2>".$row['blogTitle']."</h2>
                  <h3>By: ".$row['blogAuthor']."</h3>
                  <p>".$row['blogDate']."&nbsp|&nbsp".$row['blogViews']." Views</p>
                  <p>".$row['blogDescription']."</p>
                </a></div>
                <br>";
        }
      }
    }
  ?>

<br><br><br><br><br>
<?php
  include 'footer.php';
?>