<?php
require '..\includes\DB-PDO-connection.php';

$mNum = $_GET['Meeting'];

$sql="DELETE FROM meetingtbl WHERE meetingtbl.meetingNum=".$mNum.";";
$status = $con->query($sql);
echo "<script> alert('삭제 되었습니다.');
        location.href='meeting.php';</script>";
?>