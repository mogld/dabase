<?php

require '..\includes\DB-PDO-connection.php';
session_start();

    $SubProjectID = $_GET["SubProjectID"];
    
    $sql = "DELETE FROM subprojecttbl WHERE SubProjectID=".$_GET['SubProjectID']."";

$status = $con->query($sql);
$result = $status->fetch();

echo "<script> alert('삭제 되었습니다.'); location.href='project_checklist.php';</script>";

?>
