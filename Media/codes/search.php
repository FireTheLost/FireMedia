<?php
  include '../postsincludes/dbh.inc.php';
  $title="Search Results";
  if (isset($_GET['submit-search']))
  {
    $search=mysqli_real_escape_string($conn, $_GET['search']);
    $title=$title." (".$search.")";
  }

  include 'header.php';
?>

<div>
  <?php
    if (isset($_GET['submit-search']))
    {
      $search=mysqli_real_escape_string($conn, $_GET['search']);
      $sql="SELECT * FROM users WHERE usersUid='".$search."';";
      $result1=mysqli_query($conn, $sql);
      $queryResult1=mysqli_num_rows($result1);
      $row1=mysqli_fetch_assoc($result1);

      $search=mysqli_real_escape_string($conn, $_GET['search']);
      $sql="SELECT * FROM files WHERE filesVisibility='Visible' AND (filesTitle LIKE '%$search%' OR filesDescription LIKE '%$search%' 
            OR filesAuthor LIKE '$search' OR filesDate LIKE '%$search%');";
      $result=mysqli_query($conn, $sql);
      $queryResult=mysqli_num_rows($result);

      $results=$queryResult+$queryResult1;
      $search = filter_var($search, FILTER_SANITIZE_STRING);

      if (!(str_contains($search, '<')||str_contains($search, '>')))
      {
        if (!empty($search))
        {
          if ($results>0)
          {
            echo "<h1 align='center'>Search Results For '".$search."':</h1>";

	    if ($results==1)
 	    {
                echo "<h3 style='text-align: center;'>There is 1 result.</h3>";
  	    }
  	    if ($results!=1)
  	    {
              echo "<h3 style='text-align: center;'>There are ".$results." results.</h3>";
	    }
            if ($queryResult1>0)
            {
                 echo "<div style='border: 2px solid #0f0f0f' class='blogdiv1'><a class='openblog' target='_blank' href='profile.php?profile=".$row1['usersUid']."'>
                    <h2>User:&nbsp".$row1['usersUid']."</h2>
                    <h3>&nbspJoined On: ".$row1['usersJoined']."</h3>
                  </a></div><br>";
             }
            while ($row=mysqli_fetch_assoc($result))
            {
              $type1=$row['filesType'];
              if($type1=="img")
              {
                $type="image";
              }
              elseif($type1=="vid")
              {
                $type="video";
              }
              if($row['filesType']=="img")
              {
                $rk=$row['filesRandomKey'];
                $src=$row['filesName'];
                $srcActual=$rk.".".$src;
                echo "<div class='photo'>
                        <div><a class='openblog' href='image.php?img=".$rk."'>
                          <h2>".$row['filesTitle']."</h2>
                        </div>
                        <div>
                         <img class='upimg' src='../uploads/images/".$srcActual."' alt='¯\_(ツ)_/¯'>
                        </div>
                        <div>
                         <p>".$row['filesDescription']."</p>
                        </div>
                      </div><br>";
              }
              elseif($row['filesType']=="vid")
              {
                $rk=$row['filesRandomKey'];
                $src=$row['filesName'];
                $srcActual=$rk.".".$src;
                echo "<div class='photo'>
                        <div><a class='openblog' href='video.php?vid=".$rk."'>
                          <h2>".$row['filesTitle']."</h2>
                        </div>
                        <div>
                         <video class='upvid' src='../uploads/videos/".$srcActual."' alt='¯\_(ツ)_/¯'>
                        </div>
                        <div>
                         <p>".$row['filesDescription']."</p>
                        </div>
                      </div><br>";
              }
            }
          }
          else
          {
            echo "<h1 align='center'>There Are No Results For '".$search."'</h1>";
          }
        }
        else
        {
          echo "<h1 align='center'>Please Search For Something!</h1>";
        }
      }
      else
      {
        echo "<h1 align='center'>Your Search Was Illegal! Please Try Again.</h1>";
      }
    }  
  ?>
</div>
<br><br><br><br><br>

<?php
  include 'footer.php';
?>