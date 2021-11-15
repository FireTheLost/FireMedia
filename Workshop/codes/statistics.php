<script>
window.addEventListener('load', (event) => {
  document.getElementsByClassName("tabscontainer")[0].style.width="238px";
});
</script>

<?php

include "..\loginincludes\dbh.inc.php";

  $sql="SELECT * FROM users";
  $result=mysqli_query($conn, $sql);
  $queryUsers=mysqli_num_rows($result);

  $sql="SELECT * FROM likes WHERE likesType='like'";
  $result=mysqli_query($conn, $sql);
  $sql1="SELECT * FROM fileslikes WHERE fileslikesType='like'";
  $result1=mysqli_query($conn, $sql1);
  
  $queryLikes=(mysqli_num_rows($result))+(mysqli_num_rows($result1));

  $sql="SELECT * FROM reports";
  $result=mysqli_query($conn, $sql);
  $sql1="SELECT * FROM filesreports";
  $result1=mysqli_query($conn, $sql1);
  
  $queryReports=(mysqli_num_rows($result))+(mysqli_num_rows($result1));

  $sql="SELECT * FROM blogs";
  $result=mysqli_query($conn, $sql);
  $queryBlog=mysqli_num_rows($result);

  $sql="SELECT * FROM files WHERE filesType='vid'";
  $result=mysqli_query($conn, $sql);
  $queryVid=mysqli_num_rows($result);

  $sql="SELECT * FROM files WHERE filesType='img'";
  $result=mysqli_query($conn, $sql);
  $queryImg=mysqli_num_rows($result);

  $sql="SELECT * FROM files WHERE filesType='aud'";
  $result=mysqli_query($conn, $sql);
  $queryAud=mysqli_num_rows($result);
  
  $sql="SELECT * FROM viewscounter";
  $result=mysqli_query($conn, $sql);
  $sql1="SELECT * FROM filesviewscounter";
  $result1=mysqli_query($conn, $sql1);
  
  $queryViews=(mysqli_num_rows($result))+(mysqli_num_rows($result1));

  $sql="SELECT * FROM comments";
  $result=mysqli_query($conn, $sql);
  $sql1="SELECT * FROM filescomments";
  $result1=mysqli_query($conn, $sql1);
  
  $queryComments=(mysqli_num_rows($result))+(mysqli_num_rows($result1));

  
echo "<br><span style='margin-left: 150px'>
	    <div id='stats'>
		  <h1>
		    Total Users
		  </h1>
		  <h2 align='center'>
		    ".$queryUsers."
		  </h2>
		</div>
		<div id='stats'>
		  <h1>
		    Total Views
		  </h1>
		  <h2 align='center'>
		    ".$queryViews."
		  </h2>
		</div>
	    <div id='stats'>
		  <h1>
		    Total Likes
		  </h1>
		  <h2 align='center'>
		    ".$queryLikes."
		  </h2>
		</div>
			    <div id='stats'>
		  <h1>
		    Total Comments
		  </h1>
		  <h2 align='center'>
		    ".$queryComments."
		  </h2>
		</div>
		<div id='stats'>
		  <h1>
		    Total Reports
		  </h1>
		  <h2 align='center'>
		    ".$queryReports."
		  </h2>
		</div>
		<div id='stats'>
		  <h1>
		    Total Blogs
		  </h1>
		  <h2 align='center'>
		    ".$queryBlog."
		  </h2>
		</div>
		<div id='stats'>
		  <h1>
		    Total Videos
		  </h1>
		  <h2 align='center'>
		    ".$queryVid."
		  </h2>
		</div>
		<div id='stats'>
		  <h1>
		    Total Images
		  </h1>
		  <h2 align='center'>
		    ".$queryImg."
		  </h2>
		</div>
		<div id='stats'>
		  <h1>
		    Total Audios
		  </h1>
		  <h2 align='center'>
		    ".$queryAud."
		  </h2>
		</div>
	  </span>";