<?php
require '..\includes\DB-PDO-connection.php';
session_start();
$mID = $_SESSION['MemberID'];
$pID = $_SESSION['projectID'];

$sql = "SELECT meetingtbl.*, memberstbl.Name AS Name FROM meetingtbl LEFT JOIN memberstbl ON meetingtbl.MembersTBL_MemberID = memberstbl.MemberID WHERE ProjectTBL_projectID=".$pID." ORDER BY meetingNum DESC;";
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
    <h1>회의록 게시판</h1>
    <div class='addbtn'>
    <FORM METHOD="post" ACTION="newMeeting.php">
    <INPUT TYPE="hidden" name="MemberID" value="<?=$mID?>">
    <INPUT TYPE="hidden" name="projectID" value="<?=$pID?>">
    <button type="submit" id='push' class="btn btn-outline-info">글쓰기</button>
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
    <div class='list'>
    <table border="0">
        <thead>
            <th width="18%">회의날짜</th>
            <th width="38%">제목</th>
            <th width="18%">작성자</th>
            <th width="18%">작성날짜</th>
            <td width="4%"></td>
        </thead>
        </table>
        
        <?php

        while ($result = $status->fetch()) { ?>
        <details><summary>
        <table border="0"><tr>
            <td width="18%"><?=$result['mdate']?></td>
            <td width="38%"><?=$result['title']?></td>
            <td width="18%"><?=$result['Name']?></td>
            <td width="18%"><?=$result['wdate']?></td>
            <td width="4%"><?php
            if($mID==$result['MembersTBL_MemberID']) { ?>  
                <a href="modifyM.php?Meeting=<?=$result['meetingNum']?>">
                <img src="..\img\pencil.png" width="20"></a>
        <?php } ?></td>
        </tr></table>
        </summary>
        <div class="det">
        <?php $print=nl2br($result['description'])?>
        <?=$print?><br>
        </div>
        </details>
        <?php } 
        }?>
    </div>
    <br>
    <br>
    <br>
    </BODY>
</HTML>

