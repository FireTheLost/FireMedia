<?php
include "..\loginincludes\dbh.inc.php";

echo "<br><div class='admin'><div class='tabscontainer'>";

if (isset($_GET['page']))
{
    if ($_GET['page'] == 'reports')
    {
        echo "<div class='tabs'>
							  <a id='namelink' href='index.php?user=admin&page=stats'>
							  <h3>Statistics</h3>
							  </a>
							  </div>";

        echo "<div class='tabs'>
							  <a id='namelink' href='index.php?user=admin&page=profile'>
							  <h3>Profile</h3>
							  </a>
							  </div>";

        echo "<div class='subtabs'>
							  <a id='namelink' href='index.php?user=admin&page=reports&subpage=blogs'>
							  <h3>Blogs</h3>
							  </a>
							  </div>
							  
							  <div class='subtabs'>
							  <a id='namelink' href='index.php?user=admin&page=reports&subpage=videos'>
							  <h3>Videos</h3>
							  </a>
							  </div>
							  
							  <div class='subtabs'>
							  <a id='namelink' href='index.php?user=admin&page=reports&subpage=photos'>
							  <h3>Photos</h3>
							  </a>
							  </div>
							  
							  <div class='subtabs'>
							  <a id='namelink' href='index.php?user=admin&page=reports&subpage=audios'>
							  <h3>Audios</h3>
							  </a>
							  </div>";

        echo "<div class='tabs'>
							  <a id='namelink' href='index.php?user=admin&page=posts&subpage=blogs'>
							  <h3>Posts From " . $_SESSION['useruid'] . "</h3>
							  </a>
							  </div>";

                              
        echo "<div class='tabs'>
                            <a id='namelink' href='index.php?user=admin&page=messages&subpage=view'>
                            <h3>Messages</h3>
                            </a>
                            </div>";

        if (isset($_GET['subpage']))
        {
			echo "</div></div>";

            if ($_GET['subpage'] == 'blogs')
            {
                $sql = "SELECT * FROM blogmeta WHERE blogmetaReported>0 ORDER BY blogmetaReported desc";
                $result = mysqli_query($conn, $sql);
                $queryResults = mysqli_num_rows($result);

                if ($queryResults > 0)
                {
                    while ($row = mysqli_fetch_assoc($result))
                    {
                        $rk = $row['blogmetaRandomKey'];
                        $sql1 = "SELECT * FROM blogs WHERE blogRandomKey='" . $rk . "';";
                        $result1 = mysqli_query($conn, $sql1);
                        $queryResults1 = mysqli_num_rows($result1);

                        while ($row1 = mysqli_fetch_assoc($result1))
                        {
                            echo "<div class='blogdiv1'><a class='openblog' target='_blank' href='blogreported.php?blog=" . $row1['blogRandomKey'] . "'>
												  <h2>" . $row1['blogTitle'] . "</h2>
                								  <h3>By: " . $row1['blogAuthor'] . "</h3>
             								      <p>Reported&nbsp" . $row['blogmetaReported'] . "&nbspTimes</p>
             								      </a></div>
             								      <br>";
                        }
                    }
                }
            }
            elseif ($_GET['subpage'] == "videos")
            {
                $sql = "SELECT * FROM filesmeta WHERE filesmetaType='vid' AND filesmetaReported>=1 ORDER BY filesmetaReported desc";
                $result = mysqli_query($conn, $sql);
                $queryResults = mysqli_num_rows($result);

                if ($queryResults > 0)
                {
                    while ($row = mysqli_fetch_assoc($result))
                    {
                        $rk = $row['filesmetaRandomKey'];
                        $sql1 = "SELECT * FROM files WHERE filesRandomKey='" . $rk . "';";
                        $result1 = mysqli_query($conn, $sql1);
                        $queryResults1 = mysqli_num_rows($result1);

                        while ($row1 = mysqli_fetch_assoc($result1))
                        {
                            echo "<div class='blogdiv1'><a class='openblog' target='_blank' href='videoreported.php?video=" . $row1['filesRandomKey'] . "'>
                  <h2>" . $row1['filesTitle'] . "</h2>
                  <h3>By: " . $row1['filesAuthor'] . "</h3>
                  <p>Reported&nbsp" . $row['filesmetaReported'] . "&nbspTimes</p>
                </a></div>
                <br>";
                        }
                    }
                }
            }
            elseif ($_GET['subpage'] == "photos")
            {
                $sql = "SELECT * FROM filesmeta WHERE filesmetaType='img' AND filesmetaReported>=1 ORDER BY filesmetaReported desc";
                $result = mysqli_query($conn, $sql);
                $queryResults = mysqli_num_rows($result);

                if ($queryResults > 0)
                {
                    while ($row = mysqli_fetch_assoc($result))
                    {
                        $rk = $row['filesmetaRandomKey'];
                        $sql1 = "SELECT * FROM files WHERE filesRandomKey='" . $rk . "';";
                        $result1 = mysqli_query($conn, $sql1);
                        $queryResults1 = mysqli_num_rows($result1);

                        while ($row1 = mysqli_fetch_assoc($result1))
                        {
                            echo "<div class='blogdiv1'><a class='openblog' target='_blank' href='imagereported.php?image=" . $row1['filesRandomKey'] . "'>
                  <h2>" . $row1['filesTitle'] . "</h2>
                  <h3>By: " . $row1['filesAuthor'] . "</h3>
                  <p>Reported&nbsp" . $row['filesmetaReported'] . "&nbspTimes</p>
                </a></div>
                <br>";
                        }
                    }
                }
            }

            elseif ($_GET['subpage'] == "audios")
            {
                $sql = "SELECT * FROM filesmeta WHERE filesmetaType='aud' AND filesmetaReported>=1 ORDER BY filesmetaReported desc";
                $result = mysqli_query($conn, $sql);
                $queryResults = mysqli_num_rows($result);

                if ($queryResults > 0)
                {
                    while ($row = mysqli_fetch_assoc($result))
                    {
                        $rk = $row['filesmetaRandomKey'];
                        $sql1 = "SELECT * FROM files WHERE filesRandomKey='" . $rk . "';";
                        $result1 = mysqli_query($conn, $sql1);
                        $queryResults1 = mysqli_num_rows($result1);

                        while ($row1 = mysqli_fetch_assoc($result1))
                        {
                            echo "<div class='blogdiv1'><a class='openblog' target='_blank' href='audioreported.php?audio=" . $row1['filesRandomKey'] . "'>
                  <h2>" . $row1['filesTitle'] . "</h2>
                  <h3>By: " . $row1['filesAuthor'] . "</h3>
                  <p>Reported&nbsp" . $row['filesmetaReported'] . "&nbspTimes</p>
                </a></div>
                <br>";
                        }
                    }
                }
            }
        }

        echo "</div><br><br><br><br><br>";
    }
    else if ($_GET['page'] == 'stats')
    {
        echo "<div class='subtabs'>
							  <a id='namelink' href='index.php?user=admin&page=stats'>
							  <h3>Statistics</h3>
							  </a>
							  </div>";

        echo "<div class='tabs'>
							  <a id='namelink' href='index.php?user=admin&page=profile'>
							  <h3>Profile</h3>
							  </a>
							  </div>";

        echo "<div class='tabs'>
							  <a id='namelink' href='index.php?user=admin&page=reports&subpage=blogs'>
							  <h3>Reports</h3>
							  </a>
							  </div>";

        echo "<div class='tabs'>
							  <a id='namelink' href='index.php?user=admin&page=posts&subpage=blogs'>
							  <h3>Posts From " . $_SESSION['useruid'] . "</h3>
							  </a>
							  </div>";
                            
      echo "<div class='tabs'>
                          <a id='namelink' href='index.php?user=admin&page=messages&subpage=view'>
                          <h3>Messages</h3>
                          </a>
                          </div>";

        echo "</div>";

        include "statistics.php";

        echo "</div><br><br><br><br><br>";
    }

    else if ($_GET['page'] == 'profile')
    {
        echo "<div class='tabs'>
							  <a id='namelink' href='index.php?user=admin&page=stats'>
							  <h3>Statistics</h3>
							  </a>
							  </div>";

        echo "<div class='subtabs'>
							  <a id='namelink' href='index.php?user=admin&page=profile'>
							  <h3>Profile</h3>
							  </a>
							  </div>";

        echo "<div class='tabs'>
							  <a id='namelink' href='index.php?user=admin&page=reports&subpage=blogs'>
							  <h3>Reports</h3>
							  </a>
							  </div>";

        echo "<div class='tabs'>
							  <a id='namelink' href='index.php?user=admin&page=posts&subpage=blogs'>
							  <h3>Posts From " . $_SESSION['useruid'] . "</h3>
							  </a>
							  </div>";

                              
        echo "<div class='tabs'>
                            <a id='namelink' href='index.php?user=admin&page=messages&subpage=view'>
                            <h3>Messages</h3>
                            </a>
                            </div>";

        echo "</div>";
		include "profile.php";
		
		echo "<br><br><br><br><br>";
    }

    else if ($_GET['page'] == 'posts')
    {
        echo "<div class='tabs'>
							  <a id='namelink' href='index.php?user=admin&page=stats'>
							  <h3>Statistics</h3>
							  </a>
							  </div>";

        echo "<div class='tabs'>
							  <a id='namelink' href='index.php?user=admin&page=profile'>
							  <h3>Profile</h3>
							  </a>
							  </div>";

        echo "<div class='tabs'>
							  <a id='namelink' href='index.php?user=admin&page=reports&subpage=blogs'>
							  <h3>Reports</h3>
							  </a>
							  </div>";

        echo "<div class='subtabs'>
							  <a id='namelink' href='index.php?user=admin&page=posts&subpage=blogs'>
							  <h3>Blogs</h3>
							  </a>
							  </div>
							  
							  <div class='subtabs'>
							  <a id='namelink' href='index.php?user=admin&page=posts&subpage=videos'>
							  <h3>Videos</h3>
							  </a>
							  </div>
							  
							  <div class='subtabs'>
							  <a id='namelink' href='index.php?user=admin&page=posts&subpage=photos'>
							  <h3>Photos</h3>
							  </a>
							  </div>
							  
							  <div class='subtabs'>
							  <a id='namelink' href='index.php?user=admin&page=posts&subpage=audios'>
							  <h3>Audios</h3>
							  </a>
							  </div>";

                              
        echo "<div class='tabs'>
                            <a id='namelink' href='index.php?user=admin&page=messages&subpage=view'>
                            <h3>Messages</h3>
                            </a>
                            </div>";
							  
		if (isset($_GET['subpage']))
        {
            if ($_GET['subpage'] == 'blogs')
            {
				echo "</div></div>";
                
                $sql="SELECT * FROM blogs WHERE blogsVisibility='Visible' AND blogAuthor='".$_SESSION['useruid']."'";
                $result=mysqli_query($conn, $sql);
                $queryResults=mysqli_num_rows($result);
            
                if ($queryResults>0)
                {
                  while ($row=mysqli_fetch_assoc($result))
                  {
                    if($row['blogViews']==1)
                    {
                      echo "<div class='blogdiv1'><a class='openblog' target='_blank' href='update.php?user=".$_SESSION['useruid']."&what=blog&id=".$row['blogRandomKey']."' target='_blank'>
                              <h2>".$row['blogTitle']."</h2>
                              <h3>By: ".$row['blogAuthor']."</h3>
                              <p>".$row['blogDate']."&nbsp|&nbsp1 View</p>
                              <p>".$row['blogDescription']."</p>
                            </a></div>
                            <br>";
                    }
                    elseif($row['blogViews']!=1)
                    {
                      echo "<div class='blogdiv1'><a class='openblog' target='_blank' href='update.php?user=".$_SESSION['useruid']."&what=blog&id=".$row['blogRandomKey']."' target='_blank'>
                              <h2>".$row['blogTitle']."</h2>
                              <h3>By: ".$row['blogAuthor']."</h3>
                              <p>".$row['blogDate']."&nbsp|&nbsp".$row['blogViews']." Views</p>
                              <p>".$row['blogDescription']."</p>
                            </a></div>
                            <br>";
                    }
                  }
                }
            }

            elseif ($_GET['subpage'] == "videos")
            {
				echo "</div></div>";

				$sql="SELECT * FROM files WHERE filesType='vid' AND filesAuthor='".$_SESSION['useruid']."' AND filesVisibility='Visible';";
				$result=mysqli_query($conn, $sql);
				$queryResults=mysqli_num_rows($result);

    			if ($queryResults>0)
    			{
					while ($row=mysqli_fetch_assoc($result))
					{
                        $rk=$row['filesRandomKey'];
                        $src=$row['filesName'];
                        $srcActual=$rk.".".$src;
                        echo "<div class='photo'>
                                <div><a class='openblog' href='update.php?user=".$_SESSION['useruid']."&what=video&id=".$row['filesRandomKey']."' target='_blank'>
                                  <h2>".$row['filesTitle']."</h2>
                                </div>
                                <div>
                                 <video class='upvid' src='../../Media/uploads/videos/".$srcActual."' alt='".$row['filesTitle']."&nbsp¯\_(ツ)_/¯'>
                                </div>
                                <div>
                                  <p>".$row['filesDescription']."</p>
                                </div>
                              </div><br>";
					}
                }
            }

            elseif ($_GET['subpage'] == "photos")
            {
				echo "</div></div>";

				$sql="SELECT * FROM files WHERE filesType='img' AND filesAuthor='".$_SESSION['useruid']."' AND filesVisibility='Visible';";
				$result=mysqli_query($conn, $sql);
				$queryResults=mysqli_num_rows($result);

    			if ($queryResults>0)
    			{
					while ($row=mysqli_fetch_assoc($result))
					{
                        $rk=$row['filesRandomKey'];
                        $src=$row['filesName'];
                        $srcActual=$rk.".".$src;
                        echo "<div class='photo'>
                                <div><a class='openblog' href='update.php?user=".$_SESSION['useruid']."&what=photo&id=".$row['filesRandomKey']."' target='_blank'>
                                  <h2>".$row['filesTitle']."</h2>
                                </div>
                                <div>
                                 <img class='upimg' src='../../Media/uploads/images/".$srcActual."' alt='".$row['filesTitle']."&nbsp¯\_(ツ)_/¯'>
                                </div>
                                <div>
                                  <p>".$row['filesDescription']."</p>
                                </div>
                              </div><br>";
					}
                }
            }

            elseif ($_GET['subpage'] == "audios")
            {
				echo "</div></div>";

				$sql="SELECT * FROM files WHERE filesType='aud' AND filesAuthor='".$_SESSION['useruid']."' AND filesVisibility='Visible';";
				$result=mysqli_query($conn, $sql);
				$queryResults=mysqli_num_rows($result);

    			if ($queryResults>0)
    			{
					while ($row=mysqli_fetch_assoc($result))
					{
						$rk=$row['filesRandomKey'];
						$src=$row['filesName'];
						$srcActual=$rk.".".$src;
						echo "<div class='photo'>
								<a class='openblog' href='update.php?user=".$_SESSION['useruid']."&what=audio&id=".$row['filesRandomKey']."' target='_blank'>
								<h2>".$row['filesTitle']."</h2>
								<h3>By: ".$row['filesAuthor']."</h3>
								<p>".$row['filesDescription']."</p>
								<p>".$row['filesDate']."&nbsp|&nbsp1 View</p>
							</div><br>";
					}
    			}
            }
		}

        echo "</div></div><br><br><br><br><br>";
    }
    else if ($_GET['page'] == 'messages')
    {
        echo "<div class='tabs'>
							  <a id='namelink' href='index.php?user=admin&page=stats'>
							  <h3>Statistics</h3>
							  </a>
							  </div>";

        echo "<div class='tabs'>
							  <a id='namelink' href='index.php?user=admin&page=profile'>
							  <h3>Profile</h3>
							  </a>
							  </div>";

        echo "<div class='tabs'>
							  <a id='namelink' href='index.php?user=admin&page=reports&subpage=blogs'>
							  <h3>Reports</h3>
							  </a>
							  </div>";

        echo "<div class='tabs'>
							  <a id='namelink' href='index.php?user=admin&page=posts&subpage=blogs'>
							  <h3>Posts From " . $_SESSION['useruid'] . "</h3>
							  </a>
							  </div>";
                            
      echo "<div class='subtabs'>
                          <a id='namelink' href='index.php?user=admin&page=messages&subpage=view'>
                          <h3>View Messages</h3>
                          </a>
                          </div>";

        echo "</div></div>";

        include "messages.php";

        echo "</div><br><br><br><br><br>";
    }
}
else
{
    echo "<div class='tabs'>
							  <a id='namelink' href='index.php?user=admin&page=stats'>
							  <h3>Statistics</h3>
							  </a>
							  </div>";

    echo "<div class='tabs'>
							  <a id='namelink' href='index.php?user=admin&page=profile'>
							  <h3>Profile</h3>
							  </a>
							  </div>";

    echo "<div class='tabs'>
							  <a id='namelink' href='index.php?user=admin&page=reports'>
							  <h3>Reports</h3>
							  </a>
							  </div>";

    echo "<div class='tabs'>
							  <a id='namelink' href='index.php?user=admin&page=posts&subpage=blogs'>
							  <h3>Posts From " . $_SESSION['useruid'] . "</h3>
							  </a>
							  </div>";

                              
        echo "<div class='tabs'>
                            <a id='namelink' href='index.php?user=admin&page=messages&subpage=view'>
                            <h3>Messages</h3>
                            </a>
                            </div>";
}