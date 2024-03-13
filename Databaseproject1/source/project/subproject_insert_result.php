<?php

require '..\includes\DB-PDO-connection.php';
session_start();
    $SubProjectName = $_POST["SubProjectName"];
    $description = $_POST["description"];
    $enddate = $_POST['enddate'];
    $projectID = $_POST["projectID"];

    $sql = "INSERT INTO subprojecttbl VALUES (NULL, '".$SubProjectName."', '".$description."', '".$enddate."', ".$projectID.")";

$status = $con->query($sql);
$result = $status->fetch();

echo "<script> alert('추가 되었습니다.'); location.href='project_checklist.php';</script>";

?>
