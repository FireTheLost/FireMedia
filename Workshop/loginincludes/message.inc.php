<?php
session_start();

include 'dbh.inc.php';
$id = $_GET['id'];

$sql="UPDATE usersmessages SET usersmessagesStatus = 'Seen' WHERE usersmessagesId='".$id."';";
$result=mysqli_query($conn, $sql);


header("location: ../codes/index.php?user=".$_SESSION['useruid']."&page=messages");