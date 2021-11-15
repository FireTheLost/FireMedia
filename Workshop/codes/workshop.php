<?php
include "..\loginincludes\dbh.inc.php";

echo "<br><div class='admin'><div class='tabscontainer'>";

if (isset($_GET['page']))
{
    if ($_GET['page'] == 'profile')
    {
        echo "<script>
        window.addEventListener('load', (event) => {
          document.getElementsByClassName('tabscontainer')[0].style.height='418px';
        });
        </script>";

        echo "<div class='subtabs'>
							  <a id='namelink' href='index.php?user=".$_SESSION['useruid']."&page=profile'>
							  <h3>Profile</h3>
							  </a>
							  </div>";

        echo "<div class='tabs'>
							  <a id='namelink' href='index.php?user=".$_SESSION['useruid']."&page=posts&subpage=blogs'>
							  <h3>Posts From " . $_SESSION['useruid'] . "</h3>
							  </a>
							  </div>";
                              
        echo "<div class='tabs'>
                            <a id='namelink' href='index.php?user=".$_SESSION['useruid']."&page=messages&subpage=view'>
                            <h3>Messages</h3>
                            </a>
                            </div>";

        echo "</div>";
		include "profile.php";
		
		echo "<br><br><br><br><br>";
    }

    else if ($_GET['page'] == 'posts')
    {
        echo "<script>
        window.addEventListener('load', (event) => {
          document.getElementsByClassName('tabscontainer')[0].style.height='600px';
        });
        </script>";

        echo "<div class='tabs'>
							  <a id='namelink' href='index.php?user=".$_SESSION['useruid']."&page=profile'>
							  <h3>Profile</h3>
							  </a>
							  </div>";

        echo "<div class='subtabs'>
							  <a id='namelink' href='index.php?user=".$_SESSION['useruid']."&page=posts&subpage=blogs'>
							  <h3>Blogs</h3>
							  </a>
							  </div>
							  
							  <div class='subtabs'>
							  <a id='namelink' href='index.php?user=".$_SESSION['useruid']."&page=posts&subpage=videos'>
							  <h3>Videos</h3>
							  </a>
							  </div>
							  
							  <div class='subtabs'>
							  <a id='namelink' href='index.php?user=".$_SESSION['useruid']."&page=posts&subpage=photos'>
							  <h3>Photos</h3>
							  </a>
							  </div>
							  
							  <div class='subtabs'>
							  <a id='namelink' href='index.php?user=".$_SESSION['useruid']."&page=posts&subpage=audios'>
							  <h3>Audios</h3>
							  </a>
							  </div>";

                              
        echo "<div class='tabs'>
                            <a id='namelink' href='index.php?user=".$_SESSION['useruid']."&page=messages&subpage=view'>
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
        echo "<script>
        window.addEventListener('load', (event) => {
          document.getElementsByClassName('tabscontainer')[0].style.height='418px';
        });
        </script>";

        echo "<div class='tabs'>
							  <a id='namelink' href='index.php?user=".$_SESSION['useruid']."&page=profile'>
							  <h3>Profile</h3>
							  </a>
							  </div>";

        echo "<div class='tabs'>
							  <a id='namelink' href='index.php?user=".$_SESSION['useruid']."&page=posts&subpage=blogs'>
							  <h3>Posts From " . $_SESSION['useruid'] . "</h3>
							  </a>
							  </div>";
                            
      echo "<div class='subtabs'>
                          <a id='namelink' href='index.php?user=".$_SESSION['useruid']."&page=messages&subpage=view'>
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
							  <a id='namelink' href='index.php?user=".$_SESSION['useruid']."&page=profile'>
							  <h3>Profile</h3>
							  </a>
							  </div>";

    echo "<div class='tabs'>
							  <a id='namelink' href='index.php?user=".$_SESSION['useruid']."&page=posts&subpage=blogs'>
							  <h3>Posts From " . $_SESSION['useruid'] . "</h3>
							  </a>
							  </div>";

                              
        echo "<div class='tabs'>
                            <a id='namelink' href='index.php?user=".$_SESSION['useruid']."&page=messages&subpage=view'>
                            <h3>Messages</h3>
                            </a>
                            </div>";
}