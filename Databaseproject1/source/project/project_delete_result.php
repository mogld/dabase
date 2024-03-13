<?php

require '..\includes\DB-PDO-connection.php';
session_start();
$projectID = $_SESSION['projectID'];

$sql = "DELETE FROM projectTBL WHERE projectID='".$projectID."'";
$status = $con->query($sql);
$result = $status->fetch();

echo "<script> alert('삭제 되었습니다.'); top.location.href='../home.php';</script>";

?>
