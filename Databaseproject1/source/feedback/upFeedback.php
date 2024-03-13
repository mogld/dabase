<?php
require '..\includes\DB-PDO-connection.php';
session_start();
$mID = $_SESSION['MemberID'];
$pID = $_SESSION['projectID'];
$description = $_POST['description'];
$mode = $_POST['mode'];

if($mode==0){   //피드백 새 게시글 추가 모드 
    $title = $_POST['title'];
    $date = date('Y-m-d');
    $sql0="INSERT INTO feedbacktbl VALUES(NULL,'".$title."','".$description."','".$date."',".$pID.",'".$mID."')";
    $status = $con->query($sql0);
    echo "<script> alert('업로드 되었습니다.');
        location.href='feedback.php';</script>";
}
else if($mode==1){    //기존 게시글 수정 모드
    $title = $_POST['title'];
    $fNum = $_POST['FB'];
    $sql1="UPDATE feedbacktbl SET title='".$title."', description='".$description."' WHERE feedbacktbl.feedbackNum=".$fNum.";";
    $status = $con->query($sql1);
    echo "<script> alert('수정 되었습니다.');
        location.href='feedback.php';</script>";

}
else if($mode==2){    //새 댓글 추가 모드
    $fNum = $_POST['fNum'];
    $date = date('Y-m-d H:i');
    $sql2="INSERT INTO commenttbl VALUES(NULL,'".$description."','".$date."',".$fNum.",'".$mID."')";
    $status = $con->query($sql2);
    echo "<script> alert('업로드 되었습니다.');
        location.href='feedback-d.php?ID=".$mID."&FB=".$fNum."';</script>";
}
else if($mode==3){    //기존 댓글 수정 모드
    $cNum = $_POST['cNum'];
    $fNum = $_POST['fNum'];
    $sql3="UPDATE commenttbl SET description='".$description."' WHERE commenttbl.commentNum=".$cNum.";";
    $status = $con->query($sql3);

    echo "<script> alert('수정 되었습니다.');
        location.href='feedback-d.php?ID=".$mID."&FB=".$fNum."';</script>";
}
?>