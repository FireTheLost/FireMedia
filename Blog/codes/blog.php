<?php
  include '../blogincludes/dbh.inc.php';
  $randomKey=mysqli_real_escape_string($conn, $_GET['blog']);
  $sql="SELECT * FROM blogs WHERE blogRandomKey='$randomKey'";
  $result=mysqli_query($conn, $sql);
  $queryResult=mysqli_num_rows($result);

  while ($row=mysqli_fetch_assoc($result))
  {
    $title=$row['blogTitle']." (Blog)";
    if($row['blogsVisibility']=="Reported")
    {
      header("location: ../codes/blogs.php");
    }
  }

  include 'header.php';
  $blogId=$_GET['blog'];

  if (!isset($_SESSION[$blogId]) and isset($_SESSION["useruid"]))
  {
    $sql="UPDATE blogs SET blogViews = blogViews + 1 WHERE blogRandomKey='".$blogId."';";
    $result=mysqli_query($conn, $sql);

    $sql="INSERT INTO viewscounter (viewscounterUser, viewscounterBlog) VALUES (?, ?);";
    $stmt=mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql))
    {
      header("location: ../codes/blogs.php");
      exit();
    }

    mysqli_stmt_bind_param($stmt, "ss", $username, $blogId);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    $_SESSION[$blogId]=1;
  }
?>
<script>
  function report()
  {
    var blogId="<?php echo $blogId; ?>";
    var report=confirm("Are You Sure You Want To Report This Blog Post?");
    if (report==true)
    {
      window.location.href=("report.php?report="+blogId);
    }
  }
</script>
<div>
  <?php
    if (isset($_GET['blog']))
    {
      $randomKey=mysqli_real_escape_string($conn, $_GET['blog']);
      $sql="SELECT * FROM blogs WHERE blogRandomKey='$randomKey'";
      $result=mysqli_query($conn, $sql);
      $queryResult=mysqli_num_rows($result);

      while ($row=mysqli_fetch_assoc($result))
      {
        echo "<br>
              <div class='blogdiv'>
                <h2>".$row['blogTitle']."</h2>
                <h3>By:&nbsp<a href='profile.php?profile=".$row['blogAuthor']."' target='_blank' class='linknone'>".$row['blogAuthor']."</a></h3>
                <p>".$row['blogDate']."&nbsp|&nbsp".$row['blogViews']." Views</p>
                <p>".$row['blogDescription']."</p>
                <hr>
                <p align='justify' style='white-space: pre-wrap;'>".$row['blogBody']."</p>";
                if(isset($_SESSION["useruid"]))
                {
                  $sql="SELECT * FROM likes WHERE likesUser='$username' AND likesBlog='$randomKey' AND likesType='like'";
                  $result1=mysqli_query($conn, $sql);
                  $queryResults1=mysqli_num_rows($result1);

                  $sql2="SELECT * FROM likes WHERE likesBlog='$randomKey' AND likesType='like';";
                  $result2=mysqli_query($conn, $sql2);
                  $queryResults2=mysqli_num_rows($result2);

                  echo "<hr>";
                  if ($queryResults1>0)
                  {
                    if($queryResults2==1)
                    {
                      echo"<form action='..\blogincludes\likes.inc.php?blog=$blogId&type=unlike' method='post'>
                             <button id='likebutton' type='submit' name='submit'>
                               <img id='likeimg' src='..\images\ChargeOn.png'>
                             </button>
                           </form>
                           <p>1&nbspLike</p>";
                    }
                    else
                    {
                      echo "<form action='..\blogincludes\likes.inc.php?blog=$blogId&type=unlike' method='post'>
                             <button id='likebutton' type='submit' name='submit'>
                               <img id='likeimg' src='..\images\ChargeOn.png'>
                             </button>
                           </form>
                           <p>".$queryResults2."&nbspLikes</p>";
                    }
                  }
                  else
                  {
                    echo "<form action='..\blogincludes\likes.inc.php?blog=$blogId&type=like' method='post'>
                           <button id='likebutton' type='submit' name='submit'>
                             <img id='likeimg' src='..\images\Charge.png'>
                           </button>
                         </form>
                         <p>Like This Blog Post</p>";
                  }
                  echo"<hr>
                       <a href='javascript:report()' style='color:red; font-size:15px;'>REPORT BLOG</a>";
                }
                echo "</div>";
      }
    }
    else
    {
      header("location: blogs.php");
    }

    echo "</div>";
    include 'comment.php';
  ?>

<br><br><br><br><br><br>
<?php
  include 'footer.php';
?>