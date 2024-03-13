<?php 
    require_once '..\includes\db_connect.php';

    session_start();
    $projectID = $_SESSION['projectID'];
    
    $project_sql = "SELECT * FROM projectTBL WHERE projectID='".$projectID."'";
    $project_ret = mysqli_query($conn, $project_sql);
    $project_row = mysqli_fetch_array($project_ret);
    $title = $project_row["Title"];
    $description = $project_row["description"];
    $enddate = $project_row["enddate"];


    $member_sql = "SELECT * FROM membersTBL WHERE memberID IN (SELECT memberstbl_memberID FROM memberstbl_has_projecttbl WHERE ProjectTBL_projectID=".$projectID.")";
    $member_ret = mysqli_query($conn, $member_sql);
?>

<link rel="stylesheet" href="..\css\sjestyle.css">

<html>
    <head>
        <title> 프로젝트 수정 </title>
        <meta charset="UTF-8">
        <script language="JavaScript">
		    $(".hover").mouseleave(
                function () {
                    $(this).removeClass("hover");
                }
            );
	    </script>

    </head>
    <body link="#0e3984" vlink="#0e3984" alink="#C0C5CD">
        <section id="container">
            <div>
                <h1>프로젝트 수정</h1>
                <form action="project_delete_result.php" method="post" >
                    <br>
                    <input type="hidden" name="projectID" value= <?php echo $projectID ?>>
                    <div class="addbtn"><button type="submit" id="push" class="btn btn-outline-info">프로젝트 삭제</button></div>
                </form>
            </div>
            <div>
                <article align="center">
                    <form action="project_modify_result.php" method="post">
                    <div class="project-modify">
                        <font>프로젝트 이름</font>
                        <br><br>
                            <div class="form-floating mb-3">
                                <textarea class="form-control" id="ft" name="Title" placeholder="프로젝트 이름" required><?=$title ?></textarea>
                            </div>
                    </div>
                    <div class="project-modify">
                        <font>설명</font>
                        <br><br>
                            <div class="form-floating mb-3">
                                <textarea class="form-control" id="fd" rows="3" name="description" placeholder="설명" required style="height:200px"><?=$description?></textarea>
                            </div>
                    </div>
                    <div class="project-modify">
                        <font>마감 기한</font>
                        <br><br>
                            <input type="date" name="enddate" value="<?=$enddate?>"> 
                    </div>
                    <div class="project-modify">
                        <table align="center" class="project_modify_members_table">
                            <tr>
                                <th>팀원</th>
                            </tr>
                            <?php 
                                while($member_row = mysqli_fetch_array($member_ret)) {
                                    echo "<tr>";
                                        echo "<td>", $member_row['Name'], "</td>";
                                    echo "</tr>";
                                }
                            ?>
                        </table>
                        <?php echo "<div class='projectbtn'><button type='submit' id='push' class='btn btn-outline-info'><a href='member_modify.php?projectID=", $projectID, "'>팀원수정</a></button></div>"; ?>
                    </div>

                    <div id="push" class="btn-group" role="group">
                        <button type="submit" id="push" class="btn btn-secondary">프로젝트 수정</button>
                    </div>

                        <input type="hidden" name="projectID" value=<?php echo $projectID ?>>
                    </form>
                    
                </article>           
        </section>
    </body>
</html>