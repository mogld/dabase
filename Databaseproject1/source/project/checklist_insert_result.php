<?php

require '..\includes\DB-PDO-connection.php';
session_start();
$projectID = $_SESSION['projectID'];
    $title = $_POST["title"];
    $description = $_POST["description"];
    $enddate = $_POST['enddate'];
    $SubProjectID = $_POST["SubProjectID"];
    
    $sql = "INSERT INTO checklist VALUES (NULL, '".$title."', '".$description."', '".$enddate."', 0, ".$SubProjectID.", ".$projectID.")";


$status = $con->query($sql);
$result = $status->fetch();

echo "<script> alert('추가 되었습니다.'); location.href='project_checklist.php';</script>";

?>
