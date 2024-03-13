<?php
require '..\includes\DB-PDO-connection.php';

$mNum = $_GET["Meeting"];

$sql = "SELECT meetingtbl.*, memberstbl.Name AS Name FROM meetingtbl LEFT JOIN memberstbl ON meetingtbl.MembersTBL_MemberID = memberstbl.MemberID WHERE meetingNum = ".$mNum.";";
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
        </style>
    </HEAD>
    <BODY link="#0e3984" vlink="#0e3984" alink="#C0C5CD">
        <h1>회의록 게시판</h1>
        <hr>
        <form action="upMeeting.php" method="post">
            <div>
                <label for="d">회의 날짜&nbsp;</label>
                <input type="date" id="d" name="mdate" value=<?=$result['mdate']?> required>
            </div>
            <br>
            <div class="form-floating mb-3">
                <textarea class="form-control" id="ft" name="title" placeholder="제목" required><?=$result['title'] ?></textarea>
                <label for="ft">제목</label>
            </div>    
            <div class="form-floating mb-3">
                <textarea class="form-control" id="fd" rows="3" name="description" placeholder="내용" required style="height:200px"><?=$result['description']?></textarea>
                <label for="fd">내용</label>
            </div>
                <INPUT TYPE="hidden" name="meetingNum" value=<?=$mNum?>>
                <INPUT TYPE="hidden" name="mode" value=1>
                <div class="btn-group" role="group" aria-label="Basic example">
                    <button id="push" type="submit" class="btn btn-secondary">수정</button>
                    <button id="push" type="button" class="btn btn-secondary" onclick="location.href='meeting.php'">취소</button>
                    <button id="push" type="button" class="btn btn-secondary" onclick="location.href='deleteM.php?Meeting=<?=$mNum?>'">삭제</button>
                </div>
                </form>
        <br>
        <br>
        <br>
    </BODY>
</HTML>
        