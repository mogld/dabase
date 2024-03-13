<?php
require '..\includes\DB-PDO-connection.php';
session_start();
$mID = $_SESSION['MemberID'];
$pID = $_SESSION['projectID'];

$sql = "SELECT feedbacktbl.*, memberstbl.Name AS Name FROM feedbacktbl LEFT JOIN memberstbl ON feedbacktbl.MembersTBL_MemberID = memberstbl.MemberID WHERE ProjectTBL_projectID=".$pID." ORDER BY feedbackNum DESC;";
$status = $con->query($sql);

?>
<link rel="stylesheet" href="..\css\bootstrap.css">
<link rel="stylesheet" href="..\css\basic.css">
<link rel="stylesheet" href="..\css\list.css">

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
    <div class='title'>
    <h1>피드백 게시판</h1>
    </div>
    <div class='addbtn'>
    <FORM  METHOD="post" ACTION="newFeedback.php">
    <INPUT TYPE="hidden" name="MemberID" value=<?=$mID?>>
    <INPUT TYPE="hidden" name="projectID" value=<?=$pID?>>
    <button type="submit" id="push" class="btn btn-outline-info">글쓰기</button>
    </FORM>
    </div>
    <hr>

    <?php
    if($result = $status->rowCount() == 0){ ?>
        
        <p style="font-family:'함초롬바탕';">작성된 게시글이 없습니다.</p>
    
    <?php 
    } 
    else {
    ?>
    <table>
        <thead>
        <tr>
            <th width="9%">번호</th>
            <th width="39%">제목</th>
            <th width="9%">댓글</th>
            <th width="19%">작성자</th>
            <th width="19%">작성날짜</th>
        </tr>
        </thead>
    </table>
    
    <?php
    
        $i=1;
        while ($result = $status->fetch()) { 
            $sqlCN = $con->query("SELECT commentNum FROM commentTBL WHERE feedbackTBL_feedbackNum =".$result['feedbackNum'].";");
            $comNum = $sqlCN->rowCount();
            ?>
        <table class="fback">
        <tr onClick="location.href='feedback-d.php?ID=<?=$mID?>&FB=<?=$result['feedbackNum']?>'">
            <td width="9%"><?=$i?></td>
            <td width="39%"><?=$result['title']?></td>
            <td width="9%"><?=$comNum?></td>
            <td width="19%"><?=$result['Name']?></td>
            <td width="19%"><?=$result['date']?></td>
            </tr></a>
        </table>
        <?php 
            $i++; }
        } ?>

        <br>
        <br>
        <br>
    </BODY>
</HTML>
