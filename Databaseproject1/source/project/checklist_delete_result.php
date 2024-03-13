<?php

require '..\includes\DB-PDO-connection.php';
session_start();
    
        $sql = "DELETE FROM checklist WHERE checklistID=".$_GET['checklistID']."";

$status = $con->query($sql);
$result = $status->fetch();

echo "<script> alert('삭제 되었습니다.'); location.href='project_checklist.php';</script>";

?>
