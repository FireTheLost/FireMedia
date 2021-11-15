<?php

include '..\loginincludes\dbh.inc.php';

$what = $_GET['what'];

if($what == "description")
{
	$username1 = $_GET['user'];
	$info=$_POST["info"];
	$info = addslashes($info);
	
	$sql="UPDATE users SET usersAbout = '".$info."' WHERE usersUid='".$username1."';";
    $result=mysqli_query($conn, $sql);
	
	if($result)
	{
		header("location: ../codes/update.php?user=".$username1."&what=description&error=none");
		exit();
	}
	else
	{
		header("location: ../codes/update.php?user=".$username1."&what=description&error=one");
		exit();
	}
}
if ($what == "blog")
{
	$title = $_POST['title'];
	$title = addslashes($title);
	$desc = $_POST['desc'];
	$desc = addslashes($desc);
	$content = $_POST['content'];
	$content = addslashes($content);
	
	if (empty($title) || empty($desc) || empty($content))
	{
		header("location: ../codes/update.php?user=".$_SESSION['useruid']."&what=blog&id=".$_GET['id']."&error=empty");
		exit();
	}

	$sql="UPDATE blogs SET blogTitle = '".$title."' WHERE blogRandomKey='".$_GET['id']."';";
    $result=mysqli_query($conn, $sql);

	if(!$result)
	{
		header("location: ../codes/update.php?user=".$_SESSION['useruid']."&what=blog&id=".$_GET['id']."&error=title");
		exit();
	}

	$sql="UPDATE blogs SET blogDescription = '".$desc."' WHERE blogRandomKey='".$_GET['id']."';";
    $result=mysqli_query($conn, $sql);
	
	if(!$result)
	{
		header("location: ../codes/update.php?user=".$_SESSION['useruid']."&what=blog&id=".$_GET['id']."&error=description");
		exit();
	}	

	$sql="UPDATE blogs SET blogBody = '".$content."' WHERE blogRandomKey='".$_GET['id']."';";
    $result=mysqli_query($conn, $sql);
	
	if(!$result)
	{
		header("location: ../codes/update.php?user=".$_SESSION['useruid']."&what=blog&id=".$_GET['id']."&error=body");
		exit();
	}
	else
	{
		header("location: ../codes/update.php?user=".$_SESSION['useruid']."&what=blog&id=".$_GET['id']."&error=none");
		exit();
	}
}
if ($what == "video")
{
	$title = $_POST['title'];
	$title = addslashes($title);
	$desc = $_POST['desc'];
	$desc = addslashes($desc);
	
	if (empty($title) || empty($desc))
	{
		header("location: ../codes/update.php?user=".$_SESSION['useruid']."&what=video&id=".$_GET['id']."&error=empty");
		exit();
	}

	$sql="UPDATE files SET filesTitle = '".$title."' WHERE filesRandomKey='".$_GET['id']."';";
    $result=mysqli_query($conn, $sql);
	
	if(!$result)
	{
		header("location: ../codes/update.php?user=".$_SESSION['useruid']."&what=video&id=".$_GET['id']."&error=title");
		exit();
	}

	$sql="UPDATE files SET filesDescription = '".$desc."' WHERE filesRandomKey='".$_GET['id']."';";
    $result=mysqli_query($conn, $sql);
	
	if(!$result)
	{
		header("location: ../codes/update.php?user=".$_SESSION['useruid']."&what=video&id=".$_GET['id']."&error=body");
		exit();
	}
	else
	{
		header("location: ../codes/update.php?user=".$_SESSION['useruid']."&what=video&id=".$_GET['id']."&error=none");
		exit();
	}
}
if ($what == "photo")
{
	$title = $_POST['title'];
	$title = addslashes($title);
	$desc = $_POST['desc'];
	$desc = addslashes($desc);
	
	if (empty($title) || empty($desc))
	{
		header("location: ../codes/update.php?user=".$_SESSION['useruid']."&what=photo&id=".$_GET['id']."&error=empty");
		exit();
	}

	$sql="UPDATE files SET filesTitle = '".$title."' WHERE filesRandomKey='".$_GET['id']."';";
    $result=mysqli_query($conn, $sql);
	
	if(!$result)
	{
		header("location: ../codes/update.php?user=".$_SESSION['useruid']."&what=photo&id=".$_GET['id']."&error=title");
		exit();
	}

	$sql="UPDATE files SET filesDescription = '".$desc."' WHERE filesRandomKey='".$_GET['id']."';";
    $result=mysqli_query($conn, $sql);
	
	if(!$result)
	{
		header("location: ../codes/update.php?user=".$_SESSION['useruid']."&what=photo&id=".$_GET['id']."&error=body");
		exit();
	}
	else
	{
		header("location: ../codes/update.php?user=".$_SESSION['useruid']."&what=photo&id=".$_GET['id']."&error=none");
		exit();
	}
}
if ($what == "audio")
{
	$title = $_POST['title'];
	$title = addslashes($title);
	$desc = $_POST['desc'];
	$desc = addslashes($desc);
	
	if (empty($title) || empty($desc))
	{
		header("location: ../codes/update.php?user=".$_SESSION['useruid']."&what=audio&id=".$_GET['id']."&error=empty");
		exit();
	}

	$sql="UPDATE files SET filesTitle = '".$title."' WHERE filesRandomKey='".$_GET['id']."';";
    $result=mysqli_query($conn, $sql);
	
	if(!$result)
	{
		header("location: ../codes/update.php?user=".$_SESSION['useruid']."&what=audio&id=".$_GET['id']."&error=title");
		exit();
	}

	$sql="UPDATE files SET filesDescription = '".$desc."' WHERE filesRandomKey='".$_GET['id']."';";
    $result=mysqli_query($conn, $sql);
	
	if(!$result)
	{
		header("location: ../codes/update.php?user=".$_SESSION['useruid']."&what=audio&id=".$_GET['id']."&error=body");
		exit();
	}
	else
	{
		header("location: ../codes/update.php?user=".$_SESSION['useruid']."&what=audio&id=".$_GET['id']."&error=none");
		exit();
	}
}