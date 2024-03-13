<?php
require '..\includes\DB-PDO-connection.php';

session_start();
$mID = $_SESSION['MemberID'];
$pID = $_SESSION['projectID'];

$fNum = $_GET["FB"];
$sql = "SELECT feedbacktbl.*, memberstbl.Name AS Name FROM feedbacktbl LEFT JOIN memberstbl ON feedbacktbl.MembersTBL_MemberID = memberstbl.MemberID WHERE feedbackNum='".$fNum."';";
$status = $con->query($sql);
$result = $status->fetch();
$print = nl2br($result['description']);

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
        <div style="display: inline-block; width: 90%">
        <H1><?=$result['title']?></H1></div>
        <div style="display: inline-block; text-align: right; vertical-align: bottom; font-family: '함초롬바탕'"><?=$result['date']?></div>
        <hr>
        <div style="text-align: right; font-family: '함초롬바탕'"><p>by. <?=$result['Name']?></p></div>
        <div class='content'>
            <p><?=$print?></p>
        </div>
        
        <div style="text-align:right; vertical-align: bottom">
        <div id="push" class="btn-group" role="group" >
        <?php
            if($mID==$result['MembersTBL_MemberID']) { ?>  
            
                <button type="button" id='push' class="btn btn-secondary" onclick="location.href='modifyFB.php?FB=<?=$fNum?>'">수정/삭제</button>
            <?php } ?>
                <button type="button" id='push' class="btn btn-secondary" onclick="location.href='feedback.php'">목록으로</button>
        </div>
        </div>
       <hr>
        
        <FORM METHOD="post" ACTION="upFeedback.php">
            <div class='borderC'>
            <div class="form-floating mb-3" style="display: inline-block; width: 92%;">
                <textarea class="form-control" id="comment" rows="1" name="description" placeholder="댓글을 입력해주세요" required></textarea>
                <label for="comment">댓글을 입력해주세요</label>
            </div>
            <INPUT TYPE="hidden" NAME="mode" VALUE="2">
            <INPUT TYPE="hidden" NAME="mID" VALUE=<?=$mID?>>
            <INPUT TYPE="hidden" NAME="fNum" VALUE=<?=$fNum?>>
            <div style="display: inline-block; vertical-align: top;">
            <button type="submit" id='push' class="btn btn-outline-info">댓글쓰기</button>
            </div>
            </div>
        </FORM>
       
        <?php 
        $sqlCom = "SELECT commenttbl.*, memberstbl.Name AS Name FROM commenttbl LEFT JOIN memberstbl ON commenttbl.MembersTBL_MemberID = memberstbl.MemberID WHERE feedbackTBL_feedbackNum=".$fNum." ORDER BY commentNum ASC;";
        $staC = $con->query($sqlCom);
        while ($comment = $staC->fetch()) { 
            list($one, $two, $th) = explode(":",$comment['date']);
            ?>
        <div class='COMT'>
        <div  style="display: inline-block; width: 94%;">
        <table>
                <tr>
                <td width="15%" class="commT"><B><?=$comment['Name']?></B></td>
                <td width="70%" style="vertical-align:bottom;font-size:small; font-family:'함초롬바탕'"><?=$one?>:<?=$two?></td>
                </tr>
            </table>
        </div>
        <div style="display: inline-block; vertical-align:top;">
            <?php if($mID==$comment['MembersTBL_MemberID']) { ?>
                <td style="text-align:end">
                <a href="modifyC.php?ID=<?=$mID?>&comment=<?=$comment['commentNum']?>"><img src="..\img\pencil.png" width="20"></a>
                <a href="deleteFB.php?ID=<?=$mID?>&mode=1&comment=<?=$comment['commentNum']?>"><img src="..\img\X.png" width="20"></a>
                </td>
            <?php } ?>
        </div>
            <div class='fill'>
                <?=nl2br($comment['description'])?>
            </div>
        </div>
        <?php } ?>
        <br>
        <br>
        <br>
    </BODY>
</HTML>