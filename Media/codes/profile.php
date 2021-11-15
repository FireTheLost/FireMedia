<?php
  $title="Profile Page";
  include 'header.php';
  include '..\postsincludes\dbh.inc.php';
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

echo "<div>
       <div class='profileinfo'>
         <div class='profile'>";

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
  
            $sql="SELECT * FROM files WHERE filesAuthor='".$username1."';";
            $result=mysqli_query($conn, $sql);
            $queryResults=mysqli_num_rows($result);
            echo "<h3 class='profilelements'>Total Posts:&nbsp".$queryResults."</h3>";
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
    echo "<div><br><br>";

      echo "<a class='profilebutton' href='profile.php?profile=".$username1."&type=vid'>Videos</a></button>";
      echo "<a class='profilebutton' href='profile.php?profile=".$username1."&type=img'>Photos</a></button>";
      echo "<div class='profilediv'>";

      if(isset($_GET['type']))
      {
        $type=$_GET['type'];

        $sql="SELECT * FROM files WHERE filesAuthor='".$username1."' AND filesType='".$type."';";
        $result=mysqli_query($conn, $sql);
        $queryResults=mysqli_num_rows($result);

        if($type=="img")
        {
          $type1="Photos";
        }
        elseif($type=="vid")
        {
          $type1="Videos";
        }
        elseif($type=="aud")
        {
          $type1="Audios";
        }
        else
        {
          header("location: profile.php?profile=".$username1."");
        }
        if($queryResults>0)
        {
          echo "<h1 align='center'>".$type1."&nbspFrom&nbsp".$username1.":</h1>";
          while($row=mysqli_fetch_assoc($result))
          {
            if($type=="img")
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
            elseif($type=="vid")
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
            elseif($type=="aud")
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
        }
        else
        {
          echo "<h1 align='center'>There Are No&nbsp".$type1."&nbspFrom&nbsp".$username1.".</h1>";
        }
        echo "</div>";
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
echo "</div>

<br><br><br><br><br><br><br><br>";

include 'footer.php';