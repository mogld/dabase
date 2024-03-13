<?php
require '..\includes\DB-PDO-connection.php';
session_start();
$mID = $_SESSION['MemberID'];
$pID = $_SESSION['projectID'];
$mode = $_GET['mode'];


        if($mode==0){   //게시글 삭제
        $fNum = $_GET['FB'];
        $sql1="DELETE FROM commentTBL WHERE feedbackTBL_feedbackNum=".$fNum.";";
        $status1 = $con->query($sql2);
        $sql2="DELETE FROM feedbacktbl WHERE feedbacktbl.feedbackNum=".$fNum.";";
        $status2 = $con->query($sql2);
        echo "<script> alert('삭제 되었습니다.'); location.href='feedback.php';</script>";
        }

        else if($mode==1){    //댓글 삭제
        $mID = $_GET['ID'];
        $cNum = $_GET['comment'];
        $sqlf = "SELECT feedbackTBL_feedbackNum FROM commenttbl WHERE commenttbl.commentNum=".$cNum.";";
        $getf = ($con->query($sqlf))->fetch();
        $fNum = $getf['feedbackTBL_feedbackNum'];

        $sql1="DELETE FROM commenttbl WHERE commenttbl.commentNum=".$cNum.";";
        $status = $con->query($sql1);

        echo "<script> alert('삭제 되었습니다.');
                location.href='feedback-d.php?ID=".$mID."&FB=".$fNum."';</script>";
        }

?>
