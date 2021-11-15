<?php
session_start();
date_default_timezone_set("America/New_York");
$date=date("F jS\, Y H:i:s");
$author=$_SESSION["useruid"];

$title=$_POST["title"];
$desc=$_POST["desc"];

function generateRandomKey()
{
  include 'dbh.inc.php';
  $randomList=array("A","H","I","P","Q","X","Y","f","g","n","o","v","w","3","4",")",
                  "B","G","J","O","R","W","Z","e","h","m","p","u","x","2","5","(",
                  "C","F","K","N","S","V","a","d","i","l","q","t","y","1","6","9",
                  "D","E","L","M","T","U","b","c","j","k","r","s","z","0","7","8",);
  for ($i=0; $i<=7; $i=$i+1)
  {
    $rand=mt_rand(0,63);
    $randomKey=$randomKey.$randomList[$rand];
  }
  $sql="SELECT * FROM files WHERE filesRandomKey='".$randomKey."';";
  $result=mysqli_query($conn, $sql);
  $queryResults=mysqli_num_rows($result);
  if ($queryResults>0)
  {
    $randomKey=generateRandomKey();
    return $randomKey;
  }
  else
  {
    $sql="SELECT * FROM blogs WHERE blogRandomKey='".$randomKey."';";
    $result=mysqli_query($conn, $sql);
    $queryResults=mysqli_num_rows($result);
    if($queryResults>0)
    {
      $randomKey=generateRandomKey();
      return $randomKey;
    }
    else
    {
      return $randomKey;
      exit();
    }
  }
}

function uploadFile($conn, $title, $desc, $author, $date, $views, $rk, $name, $type)
{
  include 'dbh.inc.php';
  $sql="INSERT INTO files (filesTitle, filesDescription, filesAuthor, filesDate, filesViews, filesRandomKey, filesName, filesType) VALUES (?, ?, ?, ?, ?, ?, ?, ?);";
  $stmt=mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql))
  {
    header("location: ../codes/newpost.php?error=submittionfailed");
    exit();
  }

  mysqli_stmt_bind_param($stmt, "ssssisss", $title, $desc, $author, $date, $views, $rk, $name, $type);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_close($stmt);

  $sql="INSERT INTO filesmeta (filesmetaRandomKey, filesmetaType) VALUES (?, ?);";
  $stmt=mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql))
  {
    header("location: ../codes/newpost.php?error=submittionfailed");
    exit();
  }

  mysqli_stmt_bind_param($stmt, "ss", $rk, $type);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_close($stmt);

  $sql="INSERT INTO fileslikes (fileslikesUser, fileslikesFile, fileslikesType) VALUES (?, ?, ?);";
  $stmt=mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql))
  {
    header("location: ../codes/newpost.php?error=submittionfailed");
    exit();
  }

  $type1="like";
  mysqli_stmt_bind_param($stmt, "sss", $author, $rk, $type1);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_close($stmt);
  header("location: ../codes/newpost.php?error=".$type."none&url=".$rk."");

  exit();
}

if (isset($_POST["submit"]))
{
  if(isset($_SESSION["useruid"]))
  {
    $file=$_FILES['file'];
    $fileName=$file['name'];
    $fileTmpName=$file['tmp_name'];
    $fileSize=$file['size'];
    $fileError=$file['error'];

    $fileExt=explode('.',$fileName);
    $fileActualExt=strtolower(end($fileExt));

    $allowedImg=array('jpg','jpeg','png','pdf','gif','tiff','jfif');
    $allowedVid=array('mp4','mov','webm');
    $allowedAud=array('mp3','m4a');

    include 'dbh.inc.php';
    if($fileError===0)
    {
      if(!(empty($title)||empty($desc)))
      {
		if($fileSize > 500000000)
		{
			header("location: ../codes/newpost.php?error=largefile");
		}
		else
		{	
			if(in_array($fileActualExt,$allowedImg))
			{
				$fileType="img";
				$rk=generateRandomKey();
				$fileNameNew=$rk.".".$fileName;
				$fileDestination="../uploads/images/".$fileNameNew;
				move_uploaded_file($fileTmpName,$fileDestination);
				uploadFile($conn,$title,$desc,$author,$date,0,$rk,$fileName,$fileType);
			}
			elseif(in_array($fileActualExt,$allowedVid))
			{
				$fileType="vid";
				$rk=generateRandomKey();
				$fileNameNew=$rk.".".$fileName;
				$fileDestination="../uploads/videos/".$fileNameNew;
				move_uploaded_file($fileTmpName,$fileDestination);
				uploadFile($conn,$title,$desc,$author,$date,0,$rk,$fileName,$fileType);
			}
			elseif(in_array($fileActualExt,$allowedAud))
			{
				$fileType="aud";
				$rk=generateRandomKey();
				$fileNameNew=$rk.".".$fileName;
				$fileDestination="../uploads/audios/".$fileNameNew;
				move_uploaded_file($fileTmpName,$fileDestination);
				uploadFile($conn,$title,$desc,$author,$date,0,$rk,$fileName,$fileType);
				}
				else
				{
					header("location: ../codes/newpost.php?error=fileerror&err=".$fileActualExt."");
				}
		}
      }
      else
      {
        header("location: ../codes/newpost.php?error=emptyinput");
      }
    }
    else
    {
      header("location: ../codes/newpost.php?error=error");
      exit(); 
    }
  }
  else
  {
    header("location: ../codes/newpost.php?error=falselogin");
    exit();
  }
}
else
{
  header("location: ../codes/newpost.php?error=unknownerror");
  exit();
}