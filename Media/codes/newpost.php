<?php
  $title="New Video/Photo";
  include 'header.php';
?>
<script>
  setInterval(function(){
    path=document.getElementById("upload").value;
    path=path.slice(12);
    document.getElementById("path").innerHTML=path;
  }, 100);
</script>
<br>
<div class="signup-form-form">
<section class="signup-form">
  <div>
  <h2 id="signuph2">New Video/Picture Post</h2>
  <form action="..\postsincludes\newpost.inc.php" method="post" enctype="multipart/form-data">
  <div class="signtextdiv">
    <input class="signtext" type="text" name="title" placeholder=" Title...">
    <br>
    <input class="signtext" type="text" name="desc" placeholder=" Write A Short, Catchy Description...">
    <br>
    <br>
    <label for="upload"><img id="uploadimg" src="../images/upload.png"></label>
    <input type="file" id="upload" name="file">
    <p height="12px" id="path"></p>
    <br>
    <button id="subbutton" type="submit" style="cursor: pointer;" name="submit">Upload</button>
  </div>
  </form>
  </div>
</section>
<?php
  if(isset($_GET["error"]))
  {
    if($_GET["error"]=="falselogin")
    {
      echo '<p style="color:red; font-size:20px; text-align: center">You Must Be Logged In To Submit A Post</p>';
    }
    elseif($_GET["error"]=="fileerror")
    {
      echo '<p style="color:red; font-size:20px; text-align: center">This File Type Is Not Supported (.'.$_GET['err'].')</p>';
    }
    elseif($_GET["error"]=="error")
    {
      echo '<p style="color:red; font-size:20px; text-align: center">There Was An Error. Please Try Again</p>';
    }
    elseif($_GET["error"]=="emptyinput")
    {
      echo '<p style="color:red; font-size:20px; text-align: center">Please Fill Up All The Fields</p>';
    }
    elseif($_GET["error"]=="largefile")
    {
      echo '<p style="color:red; font-size:20px; text-align: center">Sorry, The File Was Too Large For Us To Handle</p>';
    }
    elseif($_GET["error"]=="unknownerror")
    {
      echo '<p style="color:red; font-size:20px; text-align: center">Something Went Wrong?</p>';
    }
    else if($_GET["error"]=="imgnone")
    {
     echo '<p style="color:green; font-size:20px; text-align: center">Image Post Success!</p>';
     echo '<p style="font-size:20px; text-align: center;">Link To Image:&nbsp<a style="color: #4561F7;" href="image.php?img='.$_GET["url"].'">image.php?img='.$_GET["url"].'</a></p>';
    }
    else if($_GET["error"]=="vidnone")
    {
     echo '<p style="color:green; font-size:20px; text-align: center">Video Post Success!</p>';
     echo '<p style="font-size:20px; text-align: center;">Link To Video:&nbsp<a style="color: #4561F7;" href="video.php?vid='.$_GET["url"].'">video.php?vid='.$_GET["url"].'</a></p>';
    }
    else if($_GET["error"]=="audnone")
    {
     echo '<p style="color:green; font-size:20px; text-align: center">Audio Post Success!</p>';
     echo '<p style="font-size:20px; text-align: center;">Link To Audio File:&nbsp<a style="color: #4561F7;" href="audio.php?aud='.$_GET["url"].'">audio.php?aud='.$_GET["url"].'</a></p>';
    }
  }
?>
</div>

<?php
  include 'footer.php';
?>