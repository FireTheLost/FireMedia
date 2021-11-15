<?php

$serverName="localhost";
$dBUsername="root";
$dbPassword="";
$dbName="firemedia";

$conn=mysqli_connect($serverName, $dBUsername, $dbPassword, $dbName);

if (!$conn)
{
  die("Connection Failed: ".mysqli_connect_error());
}