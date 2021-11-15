<?php

  session_start();
  session_unset();
  session_destroy();

  header("location: ../codes/videos.php");
  exit();