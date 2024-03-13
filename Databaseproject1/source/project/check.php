<?php
require '..\includes\DB-PDO-connection.php';

$checklistID = $_GET['checklistID'];

$sqls="SELECT * FROM checklist WHERE checklistID=".$checklistID.";";
$status = ($con->query($sqls))->fetch();

if($status['proiority'] == 0 ){
        $checkStatus = 1;
} else{
        $checkStatus = 0;
}

$sql="UPDATE checklist SET proiority=".$checkStatus." WHERE checklist.checklistID=".$checklistID.";";

if(($upCheck = $con->query($sql)) == true ){
echo "<script> alert('업데이트 되었습니다.');
        location.href='project_checklist.php';</script>";
} else {
    echo "<script> alert('다시 시도하세요.');
        location.href='project_checklist.php';</script>";
}
?>