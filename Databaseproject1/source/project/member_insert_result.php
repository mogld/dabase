

<?php

require '..\includes\DB-PDO-connection.php';
session_start();
    $projectID = $_POST["projectID"];
    $memberID = $_POST["memberID"];
    
    $sql = "INSERT INTO memberstbl_has_projecttbl VALUES ('" . $memberID . "', " . $projectID . ")";

$status = $con->query($sql);
$result = $status->fetch();

echo "<script> alert('추가 되었습니다.'); location.href='member_modify.php';</script>";

?>
