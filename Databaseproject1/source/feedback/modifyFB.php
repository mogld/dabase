<?php
require '..\includes\DB-PDO-connection.php';
session_start();
$mID = $_SESSION['MemberID'];
$pID = $_SESSION['projectID'];
$fNum = $_GET["FB"];

$sql = "SELECT feedbacktbl.*, memberstbl.Name AS Name FROM feedbacktbl LEFT JOIN memberstbl ON feedbacktbl.MembersTBL_MemberID = memberstbl.MemberID WHERE feedbackNum='".$fNum."';";
$status = $con->query($sql);
$result = $status->fetch();
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

        <form action="upFeedback.php" method="post">
        
        <div class="form-group">
            <h3>피드백 게시판</h3><hr>
            <div class="form-floating mb-3">
                <textarea class="form-control" id="ft" name="title" placeholder="제목" required><?=$result['title'] ?></textarea>
                <label for="ft">제목</label>
            </div>
            <div class="form-floating mb-3">
                <textarea class="form-control" id="fd" rows="3" name="description" placeholder="내용" required style="height:200px"><?=$result['description']?></textarea>
                <label for="fd">내용</label>
            </div>
                <INPUT TYPE="hidden" name="FB" value=<?=$fNum?>>
                <INPUT TYPE="hidden" name="mode" value=1>
                <div class="btn-group" role="group" aria-label="Basic example">
                    <button id="push" type="submit" class="btn btn-secondary">수정</button>
                    <button id="push" type="button" class="btn btn-secondary" onclick="location.href='feedback.php'">취소</button>
                    <button id="push" type="button" class="btn btn-secondary" onclick="location.href='deleteFB.php?mode=0&FB=<?=$fNum?>'">삭제</button>
                </div>
        </div>
        </form>
        <br>
        <br>
        <br>
    </BODY>
</HTML>
        