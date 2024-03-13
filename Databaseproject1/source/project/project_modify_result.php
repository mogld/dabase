<?php

require '..\includes\DB-PDO-connection.php';
session_start();
    $projectID = $_POST["projectID"];
    $title = $_POST["Title"];
    $description = $_POST["description"];
    $enddate = $_POST["enddate"];

    $sql = "UPDATE projectTBL SET title='".$title."', description='".$description."', enddate ='".$enddate."' WHERE projectID=".$projectID."";

$status = $con->query($sql);
$result = $status->fetch();

echo "<script> alert('수정 되었습니다.'); location.href='project_checklist.php';</script>";

?>
