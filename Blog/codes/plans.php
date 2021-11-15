<?php
  include 'header.php';
  include '..\blogincludes\dbh.inc.php';
?>

<div class="planscontainer">

  <div class="plans">
    <h1 class="planh">Free Plan</h1>
    <ul>
      <li class="planli">Annoying Ads</li>
    </ul>
    <h2 class="planh">$0/month</h1>
  </div>

  <div class="plans">
    <h1 class="planh">Personal Plan</h1>
    <ul>
      <li class="planli">No Ads</li>
      <li class="planli">Access To Communities</li>
      <li class="planli">With The Added Benefit Of Helping Us!</li>
    </ul>
    <h2 class="planh">$1/month</h1>
  </div>

  <div class="plans">
    <h1 class="planh">Business Plan</h1>
    <ul>
      <li class="planli">No Ads</li>
      <li class="planli">Your Posts Will Be Shown Under The Sponsored Blogs Section (A User Based Recommended Post Will Be Shown)</li>
      <li class="planli">With The Added Benefit Of Helping Us!</li>
    </ul>
    <h2 class="planh">$10/month</h1>
  </div>

</div>

<?php
  if(isset($_SESSION["useruid"]))
  {
    $sql="SELECT * FROM users WHERE usersUid='".$username."';";
    $result=mysqli_query($conn, $sql);
    $row=mysqli_fetch_assoc($result);
    echo "<div id='currentplan'><h2 class='profilelements'>Current Plan:&nbsp".$row['usersPlan']."</h2></div>";
  }
  else
  {
    echo "<div id='currentplan'><h2 class='profilelements'>Current Plan: Guest Plan</h2></div>";
  }
  include 'footer.php';
?>