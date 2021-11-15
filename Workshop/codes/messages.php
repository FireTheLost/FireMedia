<?php

include "..\loginincludes\dbh.inc.php";

$sql="SELECT * FROM usersmessages WHERE usersmessagesTo = '".$_SESSION['useruid']."' AND usersmessagesStatus = 'Not Seen' ORDER BY usersmessagesId desc;";
$result=mysqli_query($conn, $sql);
$queryResults=mysqli_num_rows($result);

if ($queryResults>0)
{
    echo "<div id='message-div'>";

    while ($row=mysqli_fetch_assoc($result))
    {
        echo "<div class='message'>
                <div>
                  <p id='message-p'><b>From:</b>&nbsp".$row['usersmessagesFrom']."</p>
                  <p id='message-p'><b>Message:</b> ".$row['usersmessagesMessage']."</p>
                </div>
                <form action='..\loginincludes\message.inc.php?id=".$row['usersmessagesId']."' method='post'>
                    <button id='seen' type='submit' name='submit'>I've Seen This</button>
                </form>
              </div><br><br>";
    }

    echo "</div>";
}