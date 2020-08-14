<?php
  // or port 3306
  $dbhost = 'localhost:3308';
  $dbuser = 'root';
  $dbpass = '';
  $db     = 'thecomics';

  $conn  = mysqli_connect($dbhost,$dbuser,'',$db);

  if(! $conn){
    die('Could not connect connect: ' . mysqli_connect_error()) ;
  }
?>
