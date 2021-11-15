<!--
                ___     _                    __  __              _      _            
    o O O      | __|   (_)      _ _    ___  |  \/  |   ___    __| |    (_)    __ _   
   o           | _|    | |     | '_|  / -_) | |\/| |  / -_)  / _` |    | |   / _` |  
  c.l()_[O]  __|_|_   _|_|_   _|_|_   \___| |_|__|_|  \___|  \__,_|   _|_|_  \__,_|  
 {======|_|_| """" |_|"""""|_|"""""|_|"""""|_|"""""|_|"""""|_|"""""|_|"""""|_|"""""| 
./o--000'"` ' -0-0-'"`-0-0-'"`-0-0-'"`-0-0-'"`-0-0-'"`-0-0-'"`-0-0-'"`-0-0-'"`-0-0-' 


-->

<?php
  session_start();
  if(isset($_SESSION["useruid"]))
  {
    $username=$_SESSION["useruid"];
  }
?>

<!doctype html>
<html lang="en">
  <head>
    <link rel="shortcut icon" type="image/jpg" href="fire_logo"/>
    <meta charset="utf-8">
    <title><?php echo $title." | FireMedia"; ?></title>
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="../images/LogoFireICO.ico" type="image/x-icon">
  </head>
  <body>
    <div class=wrapper">
    <h1 id="name"><a href="clicker.php" id="namelink" >&nbsp;FireMedia</a></h1>
    <div class="header">
      <div class="nav-bar">
        <ol class="headerul">
          <li><img id="header-image" src="../images/LogoFire.png" alt="Logo"></li>
          <li><a href="../../Blog/codes/blogs.php">Blogs</a></li>
          <li><a href="../../Media/codes/videos.php">Videos</a></li>
          <li><a href="../../Media/codes/photos.php">Photos</a></li>
        </ol>
        <ol>

          <?php
	    if(isset($_SESSION["useruid"]))
	    {
              echo "<li><a href='../loginincludes/logout.inc.php'>Logout</a></li>";
	    }
	    else
	    {
	      echo '<li><a href="login.php">Login</a></li>';
	    }
	  ?>
        </ol>
      </div>
    </div>
    <br>