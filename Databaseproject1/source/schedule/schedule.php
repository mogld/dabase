<!DOCTYPE html>
<html lang="ko">

<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>일정표</title>
    <title> 일정 </title>
    <link rel="stylesheet" href="..\css\schedule.css">
    <script src="schedule.js"></script>
    <script>
        window.addEventListener('DOMContentLoaded', (event) => {
            // Mini Calendar 호출
            MiniCalendar();
        });
    </script>
</head>

<body link="#0e3984" vlink="#0e3984" alink="#C0C5CD">

<?php
require_once '..\includes\db_connect.php';
session_start();
$mID = $_SESSION['MemberID'] ?? "";

// 사용자가 로그인되어 있는지 확인
    if (empty($mID)) {
        // 로그인되지 않은 상태이므로 로그인을 요청하는 메시지를 출력
        echo '<h1>일정</h1>';
        echo '<center><div class="project-list">';
        echo '<p>로그인이 필요합니다. 로그인을 먼저 해주세요.</p></div></center>';
        /*echo '<center><p>로그인이 필요합니다. 로그인을 먼저 해주세요.</p></center>';
        echo '<p><a href="..\login\login.php">로그인</a></p>';*/
    } else {
        $getsql="SELECT projectID, Title FROM ProjectTBL LEFT JOIN memberstbl_has_projecttbl ON ProjectTBL.projectID=memberstbl_has_projecttbl.ProjectTBL_projectID WHERE memberstbl_has_projecttbl.MembersTBL_MemberID='".$mID."';";
        $projTitle = $conn->query($getsql);
?>

<div class="container">
        <div class="left_area">
            <div>
                <div class="button">
                    <button onclick="toggleAddForm()" class="add_but">추가하기</button>
                </div>
            </div>

            <div id="mini_calender" class="mini_calender">
                <div class="calender_header">
                    <button type="button" id="prev-month-btn">&lt;</button>
                    <button type="button" id="next-month-btn">&gt;</button>
                    <div class="month-year">
                    </div>
                </div>

                <div class="calendar-body">
                    <table>
                        <thead>
                            <tr class="day">
                                <th>일</th>
                                <th>월</th>
                                <th>화</th>
                                <th>수</th>
                                <th>목</th>
                                <th>금</th>
                                <th>토</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
            <?php
                if($projTitle->num_rows == 0){ ?>                                
                    <p>참여중인 프로젝트가 없습니다.</p>
            <?php } else{ ?> 
            <div class="add-form" id="add-form">
                <form action="add_schedule.php" method="POST">
                    <label for="project">프로젝트</label>
                    <select id="project" name="projectID">
                        <?php
                            while(($row = $projTitle->fetch_assoc())){ ?>
                            <option value=<?=$row['projectID']?>><?=$row['Title']?></option>
                        <?php } ?>
                    </select>
                    <br><br>
                    <label for="scheduleName">일정 이름</label>
                    <input type="text" id="scheduleName" name="scheduleName" class="form_input" required><br><br>
                    <label for="startdatetime">시작일</label>
                    <input type="date" id="startdatetime" name="startdatetime" class="form_input" required><br><br>
                    <label for="enddatetime">종료일</label>
                    <input type="date" id="enddatetime" name="enddatetime" class="form_input" required><br><br>
                    <label for="place">장소</label>
                    <input type="text" id="place" name="place" class="form_input" required><br><br>
                    <input type="submit" value="일정 추가" class="add_schedule_but" onclick="toggleAddForm()">
                </form>
            </div>
            <?php } ?>
        </div>

        <div class="table">
            <table class="schedule_table">
            <tbody> 
            <tr class = "table_tr_first">
                <th width="10%">번호</th>
                <th width="15%">프로젝트</th>
                <th width="20%">일정</th>
                <th width="15%">시작일</th>
                <th width="15%">종료일</th>
                <th width="15%">장소</th>
                <th width="10%">삭제</th>
            </tr>

            <?php
                // 일정 목록 가져오기
                $sql = "SELECT * FROM scheduletbl LEFT JOIN projecttbl ON scheduletbl.ProjectTBL_projectID = projecttbl.projectID LEFT JOIN memberstbl_has_projecttbl ON projecttbl.projectID = memberstbl_has_projecttbl.ProjectTBL_projectID WHERE memberstbl_has_projecttbl.MembersTBL_MemberID='".$mID."';";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // 각 일정을 테이블에 표시
                    $i=1;
                    while ($row = $result->fetch_assoc()) {
                        echo "<td>" . $i . "</td>";
                        echo "<td>" . $row["Title"] . "</td>";
                        echo "<td>" . $row["scheduleName"] . "</td>";
                        echo "<td>" . $row["startdatetime"] . "</td>";
                        echo "<td>" . $row["enddatetime"] . "</td>";
                        echo "<td>" . $row["place"] . "</td>";
                        echo '<td><a href="add_schedule.php?delete=' . $row["ScheduleID"] . '">삭제</a></td>';
                        echo "</tr>";
                        $i++;
                    }
                } else {
                    $sql = "ALTER TABLE scheduletbl AUTO_INCREMENT = 1";
                    $result = $conn->query($sql);
                    echo "<tr><td colspan='7'>일정이 없습니다.</td></tr>";
                }
            ?>
        </div>

        
    </div>
<?php }?>
</body>