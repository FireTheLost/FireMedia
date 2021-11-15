<?php
  $title="Profile Page";
  include 'header.php';
  include '..\blogincludes\dbh.inc.php';
  $username1=$_GET['profile'];

  $sqlun="SELECT * FROM users WHERE usersUid='".$username1."';";
  $resultun=mysqli_query($conn, $sqlun);
  $rowun=mysqli_fetch_assoc($resultun);

  if(!isset($_SESSION["useruid"]))
  {
    $username="Guest";
  }
  if (!isset($username1))
  {
    $location="profile.php?profile=".$username;
    header("location: $location");
  }
?>

<div>
  <div class="profileinfo">
    <div class="profile">
      <?php
        $sql="SELECT * FROM users WHERE usersUid='".$username1."';";
        $result=mysqli_query($conn, $sql);
        $queryResults=mysqli_num_rows($result);
        if($queryResults>0)
        {
          $sql="SELECT * FROM users WHERE usersUid='".$username1."';";
          $result=mysqli_query($conn, $sql);
          $row=mysqli_fetch_assoc($result);
  
          echo "<h1 class='profilelements'>User:&nbsp".$username1."</h1>";
          echo "<h3 class='profilelements'>Joined On: ".$rowun['usersJoined']."</h3>";
  
          $sql="SELECT * FROM blogs WHERE blogAuthor='".$username1."' AND blogsVisibility='Visible';";
          $result=mysqli_query($conn, $sql);
          $queryResults=mysqli_num_rows($result);
          echo "<h3 class='profilelements'>Total Blog Posts:&nbsp".$queryResults."</h3>";
          /*
          if($username==$username1)
          {
            echo "<h3 class='profilelements'><a href='plans.php' style='color: #4561F7;'>Current Plan:&nbsp</a>".$row['userPlan']."</h3>";
          }*/
    echo "</div>";

    if($username==$username1)
    {
      echo "<textarea class='profileabout' name='about' maxlength='320'>".$rowun['usersAbout']."</textarea>";
    }
    elseif($username!=$username1)
    {
      echo "<textarea class='profileabout' name='about' readonly>".$rowun['usersAbout']."</textarea>";
    }
  
  echo "</div>";
  echo "<div>";
  
  if($queryResults>0)
  {
    echo "<h1 align='center'>Blog Posts From&nbsp".$username1.":</h1>";
    while($row=mysqli_fetch_assoc($result))
    {
      if($row['blogViews']==1)
      {
        echo "<div class='blogdiv'><a class='openblog' target='_blank' href='blog.php?blog=" . $row['blogRandomKey'] . "'>
                  <h2>" .$row['blogTitle']."</h2>
                  <h3>By: ".$row['blogAuthor']."</h3>
                  <p>".$row['blogDate']."&nbsp|&nbsp1 View</p>
                  <p>".$row['blogDescription']."</p>
                </a></div>
                <br>";
      }
      elseif($row['blogViews']!=1)
      {
        echo "<div class='blogdiv'><a class='openblog' target='_blank' href='blog.php?blog=" . $row['blogRandomKey'] . "'>
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
    echo "<h1 align='center'>There Are No Blog Posts From&nbsp".$username1.".</h1>";
  }
}
else
{
  echo "<h1 class='profilelements'>User:&nbsp".$username1."</h1>";
  echo "<h3 class='profilelements'>Joined On: January 1, 1970</h3>";
  echo "<h3 class='profilelements'>Total Blog Posts: -1</h3>";
  echo "</div>";
  echo "<textarea class='profileabout' name='about' readonly>Hello, my name is&nbsp ".$username1.". This account doesn't exist, unfortunately. If you don't have an account already, you can claim this account, obviously.</textarea>";
  echo "</div><div>";
}
?>
</div>

<br><br><br><br><br>

<?php
include 'footer.php';
?>