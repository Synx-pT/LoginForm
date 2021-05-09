<?php
session_start();
if(!isset($_SESSION['username'])){
  header("Location: ./index.php");
  exit;
}
?>

<h1>EEY</h1><br><br>
<a href="./logout.php" class="stretched-link">abmelden</a>

