<?php 
    require_once '..\includes\db_connect.php';

    session_start();
    $projectID = $_SESSION['projectID'];

    $sql = "SELECT memberstbl_memberID FROM memberstbl_has_projecttbl where projecttbl_projectID ='".$projectID."'";
    $ret = mysqli_query($conn, $sql);
?>
<link rel="stylesheet" href="..\css\sjestyle.css">

<html>
    <head>
        <title> 팀원 수정 </title>
        <meta charset="UTF-8">
    </head>
    <body link="#0e3984" vlink="#0e3984" alink="#C0C5CD">
        <center> <section id="container">
            <div class="content">
                <article>
                    <table>
                        <?php
                            while($row = mysqli_fetch_array($ret)) {
                                echo "<tr>";
                                    echo "<td>", $row['memberstbl_memberID'], "</td>";
                                    echo "<td><a href='member_delete_result.php?memberID=", $row['memberstbl_memberID'], "'>삭제</a></td>";
                                echo "</tr>";
                            }
                        ?>
                        
                        <form method="post" action="member_insert_result.php" onsubmit="return memberInsert_check()" >
                        <tr>
                            <td>
                                <input type="hidden" name="projectID" value=<?php echo $projectID; ?>>
                                <input type="text" name="memberID" placeholder="아이디">
                            </td>
                            <td>  
                                <div id="push" class="btn-group" role="group">
                                    <button type="submit" id="push" class="btn btn-secondary">팀원 추가</button>
                                </div>
                            </td>
                        </from>
                    </table>
                </article>           
            </div>
            <br><Br><Br>
            <div id="push" class="btn-group" role="group">
                <button type="submit" id="push" class="btn btn-secondary"><a href='project_modify.php'>목록으로</a></button>
            </div>
        </section> </center>
    </body>
</html>