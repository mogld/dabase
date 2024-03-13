<?php

require '..\includes\DB-PDO-connection.php';
session_start();
    $projectID = $_SESSION['projectID'];
    $sql = "DELETE FROM memberstbl_has_projecttbl WHERE membersTBL_memberID='".$_GET['memberID']."' AND ProjectTBL_projectID='". $projectID."';";

$status = $con->query($sql);
$result = $status->fetch();

echo "<script> alert('삭제 되었습니다.'); location.href='member_modify.php';</script>";
?>