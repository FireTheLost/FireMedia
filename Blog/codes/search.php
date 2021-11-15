<?php
  include '../blogincludes/dbh.inc.php';
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
      $sql="SELECT * FROM blogs WHERE blogsVisibility='Visible' AND (blogTitle LIKE '%$search%' OR blogDescription LIKE '%$search%' 
            OR blogAuthor LIKE '$search' OR blogDate LIKE '%$search%');";
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
                 echo "<div style='border: 2px solid #0f0f0f' class='blogdiv'><a class='openblog' target='_blank' href='profile.php?profile=".$row1['usersUid']."'>
                    <h2>User:&nbsp".$row1['usersUid']."</h2>
                    <h3 class='profilelements'>&nbspJoined On: ".$row1['usersJoined']."</h3>
                  </a></div><br>";
             }
            while ($row=mysqli_fetch_assoc($result))
            {
              if($row['blogViews']==1)
              {
                echo "<div class='blogdiv'><a class='openblog' target='_blank' href='blog.php?blog=".$row['blogRandomKey']."'>
                        <h2>".$row['blogTitle']."</h2>
                        <h3>By: ".$row['blogAuthor']."</h3>
                        <p>".$row['blogDate']."&nbsp|&nbsp1 View</p>
                        <p>".$row['blogDescription']."</p>
                      </a></div>
                      <br>";
              }
              elseif($row['blogViews']!=1)
              {
                echo "<div class='blogdiv'><a class='openblog' target='_blank' href='blog.php?blog=".$row['blogRandomKey']."'>
                        <h2>".$row['blogTitle']."</h2>
                        <h3>By: ".$row['blogAuthor']."</h3>
                        <p>".$row['blogDate']."&nbsp|&nbsp".$row['blogViews']." Views</p>
                        <p>".$row['blogDescription']."</p>
                      </a></div>
                     <br>";
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