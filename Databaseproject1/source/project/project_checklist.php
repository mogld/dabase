<?php 
    require_once '..\includes\db_connect.php';
    
    session_start();
    $projectID = $_SESSION["projectID"];
    $today = date('Y-m-d');

    $project_sql = "SELECT * FROM projectTBL WHERE projectID='".$projectID."'";
    $project_ret = mysqli_query($conn, $project_sql);
    $project_row = mysqli_fetch_array($project_ret);
    $project_total_rows = mysqli_num_rows($project_ret);

    $title = $project_row["Title"];
    $description = $project_row["description"];
    $startdate = $project_row["startdate"];
    $enddate = $project_row["enddate"];

    $project_checklist_sql = "SELECT * FROM checklist WHERE ProjectTBL_projectID='".$projectID."'";
    $project_checklist_ret = mysqli_query($conn, $project_checklist_sql);
    $project_checklist_row_num = mysqli_num_rows($project_checklist_ret);
    
    $project_checked_sql = "SELECT * FROM checklist WHERE ProjectTBL_projectID='".$projectID."'AND proiority=1";
    $project_checked_ret = mysqli_query($conn, $project_checked_sql);
    $project_checked_row_num = mysqli_num_rows($project_checked_ret);

    $subproject_sql = "SELECT * FROM subprojectTBL WHERE projectTBL_projectID='".$projectID."'";
    $subproject_ret = mysqli_query($conn, $subproject_sql);
    $subproject_total_rows = mysqli_num_rows($subproject_ret);
    
    $subproject_row = mysqli_fetch_array($subproject_ret);
    
?>

<link rel="stylesheet" href="..\css\sjestyle.css">

<html>
    <head>
        <title> 프로젝트 진행상황 </title>
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
                <article>
                    <h1> <?php echo $title ?></h1>
                    <div class="per">
                        <?php 
                            if($project_checked_row_num == 0) {
                                echo "0.00 % <br>";
                            }
                            else {
                                if($project_checked_row_num/$project_checklist_row_num*100 > 99.8) {
                                    echo "100 % 달성 <br>";
                                }
                                else {
                                    echo round($project_checked_row_num/$project_checklist_row_num*100, 2), " % 달성 <br>";
                                }
                            }
                        ?>
                    </div>

                        <div class='notice'>
                             <div class='description'> <h2><?=$description?><h2></div>
                            <div class='date'> <Br> <?=$startdate?> ~ <?=$enddate?></div>
                            <h3> 
                            <?php 
                            $member_sql = "SELECT * FROM membersTBL WHERE memberID IN (SELECT memberstbl_memberID FROM memberstbl_has_projecttbl WHERE ProjectTBL_projectID=".$projectID.")";
                            $member_ret = mysqli_query($conn, $member_sql);
                                while($member_row = mysqli_fetch_array($member_ret)) {
                                                echo "<tr>";
                                                    echo "<td> | ", $member_row['Name'], "    |    </td>";
                                                echo "</tr>";
                                }
                            ?></h3>
                        </div>
                        
                        <div class="addbtn">
                            <button type="submit" id="push" class="btn btn-outline-info"><?php echo "<a href='project_modify.php?projectID=", $projectID, "'>프로젝트 수정</a>"; ?></button><br><br><br>
                        </div>
                    
                    <div class="check-check">
                        <table width="80%">
                            <colgroup>
                                <col style="width: 80px;">
                                <col>
                            </colgroup>
                            <tr align='left'>
                                <th></th>
                                <th>제목</th>
                                <th>설명</th>
                                <th>마감기한</th>
                                <th>삭제</th>
                            </tr>
                            
                            <?php
                                $subproject_ret = mysqli_query($conn, $subproject_sql);
                                $index = 1;
                                while($subproject_row = mysqli_fetch_array($subproject_ret)) {

                                    $SubProjectID = $subproject_row["SubProjectID"];
                                    $checklist_sql = "SELECT * FROM checklist WHERE subprojectTBL_subprojectID='$SubProjectID'";
                                    $checklist_ret = mysqli_query($conn, $checklist_sql);
                                    $checklist_row_num = mysqli_num_rows($checklist_ret);

                                    $checked_sql = "SELECT * FROM checklist WHERE subprojectTBL_subprojectID='$SubProjectID' and proiority=1";
                                    $checked_ret = mysqli_query($conn, $checked_sql);
                                    $checked_row_num = mysqli_num_rows($checked_ret);

                                    echo "<tr  class='subtr'>";
                                        if($checked_row_num == 0) {
                                            echo "<td><b>0.00%</b></td>";
                                        }
                                        else {
                                            if ($checked_row_num/$checklist_row_num * 100 > 99.8) {
                                                echo "<td><b>100%</b></td>";
                                            }
                                            else {
                                                echo "<td><b>", round($checked_row_num/$checklist_row_num * 100,2), "%</b></td>";
                                            }
                                        }
                                        echo "<td>", $subproject_row['SubProjectName'], "</td>";
                                        echo "<td>", $subproject_row['description'], "</td>";
                                        echo "<td>", $subproject_row['enddate'], "</td>";
                                        echo "<td><div class='projectbtn'><button type='submit' id='push' class='btn btn-outline-info'><a href='subproject_delete_result.php?SubProjectID=", $subproject_row['SubProjectID'], "'>삭제</a></button></div></td>";
                                    echo "</tr>";
                                    
                                    while ($checklist_row = mysqli_fetch_array($checklist_ret)) {
                                        echo "<tr>";
                                        ?>
                                        <td>
                                            <input type="checkbox" id="cb<?=$index?>" onClick="location.href='check.php?checklistID=<?=$checklist_row['checklistID']?>'" <?=$checklist_row['proiority'] == 1 ? 'checked' : ''?>>
                                            <label for="cb<?=$index?>"></label>
                                        </td>
                                        <?php
                                        echo "<td>", $checklist_row['title'], "</td>";
                                        echo "<td>", mb_strimwidth($checklist_row['description'], '0', '70', '..', 'utf-8'), "</td>";
                                        echo "<td>", $checklist_row['enddate'], "</td>";
                                        echo "<td><div class='projectbtn'><button type='submit' id='push' class='btn btn-outline-info'><a href='checklist_delete_result.php?checklistID=", $checklist_row['checklistID'], "'>삭제</a></button></div></td>";
                                        echo "</tr>";
                                        $index++;
                                    }

                                    echo '<form action="checklist_insert_result.php" method="post">';
                                        echo "<tr>";
                                                echo "<td></td>";
                                                echo '<td><input type="text" name="title"></td>';
                                                echo '<td><input type="text" name="description"></td>';
                                                echo '<td><input type="date" name="enddate" value="'.$today.'"></td>';
                                                echo '<td><div class="projectbtn"><button type="submit" id="push" class="btn btn-outline-info">체크리스트 추가</button></div>';
                                                echo '<input type="hidden" name="projectID" value=', $projectID, '>';
                                                echo '<input type="hidden" name="SubProjectID" value=', $SubProjectID, '></td>';
                                        echo "</tr>";
                                    echo "</form>";
                                }
                                echo '<form action="subproject_insert_result.php" method="post">';
                                    echo '<tr>';
                                        echo "<td>%</td>";
                                        echo '<td><input type="text" name="SubProjectName"></td>';
                                        echo '<td><input type="text" name="description"></td>';
                                        echo '<td><input type="date" name="enddate" value="'.$today.'"></td>';
                                        echo '<td><div class="projectbtn"><button type="submit" id="push" class="btn btn-outline-info">서브프로젝트 추가</button></div>';
                                        echo '<input type="hidden" name="projectID" value=', $projectID, '></td>';
                                    echo "</tr>";
                                echo "</form>";
                            ?>
                        </table>
                    </div>
                </article>           
            </div>
        </section>
    </body>
</html>