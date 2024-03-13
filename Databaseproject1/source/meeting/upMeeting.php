<?php
require '..\includes\DB-PDO-connection.php';
session_start();
$mID = $_SESSION['MemberID'];
$pID = $_SESSION['projectID'];
$title = $_POST['title'];
$description = $_POST['description'];
$mdate = $_POST['mdate'];
$mode = $_POST['mode'];

if($mode==0){
    $wdate = date('Y-m-d');
    $sql0="INSERT INTO meetingtbl VALUES(NULL, '".$title."','".$description."','".$mdate."','".$wdate."',".$pID.",'".$mID."')";
    $status = $con->query($sql0);
    echo "<script> alert('업로드 되었습니다.');
        location.href='meeting.php';</script>";
}
else if($mode==1){
    $mNum = $_POST['meetingNum'];
    $sql1="UPDATE meetingtbl SET title='".$title."', description='".$description."',mdate='".$mdate."' WHERE meetingtbl.meetingNum='".$mNum."';";
    $status = $con->query($sql1);
    echo "<script> alert('수정 되었습니다.');
        location.href='meeting.php';</script>";

}
?>