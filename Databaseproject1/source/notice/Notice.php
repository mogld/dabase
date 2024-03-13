<?php
  session_start();
  if(empty($_GET['projectID']) == false){
    $_SESSION['projectID'] = $_GET['projectID'];
  }
?>

<!DOCTYPE html>
<html>
<head>
  <title>공지사항</title>
</head>

  <frameset cols="20%, 80%" frameborder="0">
    <frame src="..\smenu.php">
  <?php 
  if(empty($_GET['mode']) == true){ ?>
    <frame src="notices.php">
  <?php } else if($_GET['mode'] == 1){ ?>
    <frame src="..\project\project_modify.php?projectID=<?=$_GET['projectID']?>">
  <?php } ?>  
  </frameset>
</html>