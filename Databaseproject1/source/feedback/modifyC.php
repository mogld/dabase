<?php
require '..\includes\DB-PDO-connection.php';
session_start();
$mID = $_SESSION['MemberID'];
$pID = $_SESSION['projectID'];
$cNum = $_GET['comment'];

$sql = "SELECT commenttbl.*, memberstbl.Name AS Name FROM commenttbl LEFT JOIN memberstbl ON commenttbl.MembersTBL_MemberID = memberstbl.MemberID WHERE commentNum = ".$cNum.";";
$status = $con->query($sql);
$result = $status->fetch();

$sqlf = "SELECT feedbackTBL_feedbackNum FROM commenttbl WHERE commenttbl.commentNum=".$cNum.";";
$getf = ($con->query($sqlf))->fetch();
$fNum = $getf['feedbackTBL_feedbackNum'];
?>

<link rel="stylesheet" href="..\css\bootstrap.css">
<link rel="stylesheet" href="..\css\basic.css">
<link rel="stylesheet" href="..\css\content.css">

<!DOCTYPE html>
<HTML>
    <HEAD>
        <META http-equiv="content-type" content="text/html; charset=utf-8">
                <style>    
::-webkit-scrollbar {
        width: 8px;
        height: 8px;
    }
    ::-webkit-scrollbar-track {
        background: #E3E8F8;
    }
    ::-webkit-scrollbar-thumb {
        border-radius: 5px;
        background: #6b778b;
    }
    ::-webkit-scrollbar-thumb:hover {
        background: #668bcb;
    }
    ::selection { background:#e1e1e1; color: #9d4545; text-shadow: none; }
    ::-moz-selection { background:#e1e1e1; color: #9d4545; text-shadow: none; }
    ::-webkit-selection { background:#e1e1e1; color: #9d4545; text-shadow: none; }
        </style>
    </HEAD>
    <BODY link="#0e3984" vlink="#0e3984" alink="#C0C5CD">
        <div>
        <h1>댓글 수정</h1>
        <hr>
        <form action="upFeedback.php" method="post">
            <div class="form-floating mb-3">
                <textarea class="form-control" id="fd" rows="3" name="description" placeholder="댓글을 입력해주세요" required style="height:100px"><?=$result['description']?></textarea>
                <label for="fd">내용</label>
            </div>
                <INPUT TYPE="hidden" name="cNum" value=<?=$cNum?>>
                <INPUT TYPE="hidden" name="fNum" value=<?=$fNum?>>
                <INPUT TYPE="hidden" name="mode" value=3>
                <INPUT TYPE="hidden" name="mID" value=<?=$mID?>>
                <div class="btn-group" role="group" aria-label="Basic example">
                    <button id="push" type="submit" class="btn btn-secondary">수정</button>
                    <button id="push" type="button" class="btn btn-secondary" onclick="location.href='feedback-d.php?ID=<?=$mID?>&FB=<?=$fNum?>'">취소</button>
                </div>
                </form>
        </div>
        <br>
        <br>
        <br>
    </BODY>
</HTML>
        