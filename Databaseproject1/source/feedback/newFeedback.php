<?php
require '..\includes\DB-PDO-connection.php';
session_start();
$mID = $_SESSION['MemberID'];
$pID = $_SESSION['projectID'];

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
        <h1>피드백 게시판</h1>
        <hr>
        <form action="upFeedback.php" method="post">
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="ft" name="title" placeholder="제목" required></textarea>
                <label for="ft">제목</label>
            </div>
            <div class="form-floating mb-3">
                <textarea class="form-control" id="fd" name="description" placeholder="내용" required style="height:200px"></textarea>
                <label for="fd">내용</label>
            </div>
                <INPUT TYPE="hidden" name="MemberID" value=<?=$mID?>>
                <INPUT TYPE="hidden" name="projectID" value=<?=$pID?>>
                <INPUT TYPE="hidden" name="mode" value=0>
                <div class="btn-group" role="group" aria-label="Basic example">
                    <button id="push" type="submit" class="btn btn-secondary">업로드</button>
                    <button id="push" type="button" class="btn btn-secondary" onclick="location.href='feedback.php'">취소</button>
                </div>
                </form>

    </BODY>
</HTML>