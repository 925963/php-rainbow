<?php
  session_start();
  include("connection.php");
  $query="UPDATE users SET diary='".mysqli_real_escape_string($link, $_POST['diary'])."' 
  WHERE userid='".$_SESSION['id']."' LIMIT 1";
  mysqli_query($link, $query);
  print_r($_SESSION);
  print_r($_POST['diary']);
  

?>
