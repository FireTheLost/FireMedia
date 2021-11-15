<?php
  include '..\blogincludes\dbh.inc.php';

  $file=$_GET['blog'];
  $fileType='blog';
  echo "<br><br><div class='comment'>";

  if(isset($_SESSION["useruid"]))
  {
    echo "<div style='text-align: center;'>
            <form method='POST' action='..\blogincludes\commentimage.inc.php'>
              <input type='hidden' name='file' value='$file'>
                <textarea name='message' class='textcomment'></textarea>
              <button type='submit' name='submit' class='buttoncomment'>Comment</button>
            </form>
          </div>
        <br><br>";
  }

  $sql="SELECT * FROM comments WHERE commentsFile='".$file."' ORDER BY commentsLikes desc";
  $result=mysqli_query($conn, $sql);
  echo "<br><h1 style='margin-left: 9%; align: justify;'>Comments (".mysqli_num_rows($result)."):</h1>";

  $i=0;
  while ($row=$result->fetch_assoc())
  {
    $author=$row['commentsAuthor'];
    echo "<div class='comments'>";
    echo "<div>";
    echo "<a href='profile.php?profile=".$author."' target='_blank' class='linknone'><h3 style='display: inline'>".$author."</h3></a>";
    echo "&nbsp|&nbsp";
    echo "<h4 style='display: inline'>".$row['commentsDate']."</h4>";
    echo "<br><br>";
    echo nl2br($row['commentsMessage']);
    echo "</div>";
    echo "<div>";
    if(isset($_SESSION["useruid"]))
    {
      $rk=$row['commentsRandomKey'];
      $author=$_SESSION["useruid"];
      $sql1="SELECT * FROM commentslikes WHERE commentslikesUser='$author' AND commentslikesFile='$file' AND commentslikesRandomKey='$rk';";
      $result1=mysqli_query($conn, $sql1);
      $queryResults1=mysqli_num_rows($result1);

      if($queryResults1>0)
      {
        echo "<img class='upvotecomment' src='../images/Upvoted.png' alt='upvote'><br>";
        echo "<p align='center'>".$row['commentsLikes']."</p>";
      }
      else
      {
        echo "<form action='..\blogincludes\commentslikes.inc.php?file=$file&filetype=$fileType&rk=$rk' method='post'>";
        echo "<button style='border: none; background-color: #e2e2e2;'>";
        echo "<img class='upvotecomment' src='../images/Upvote.png' alt='upvote'><br>";
        echo "</button>";
        echo "</form>";
      }
    }
    echo "</div>";
    echo "</div><br>";
  }

echo "</div><br><br><br>";
