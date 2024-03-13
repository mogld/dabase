<?php
// 데이터베이스 연결
require '..\includes\db_connect.php';

// POST 데이터 처리
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $scheduleName = $_POST["scheduleName"];
    $startdatetime = $_POST["startdatetime"];
    $enddatetime = $_POST["enddatetime"];
    $place = $_POST["place"];
    $pID = $_POST['projectID'];

    $maxIDQuery = "SELECT MAX(ScheduleID) as maxID FROM scheduletbl";
    $maxIDResult = $conn->query($maxIDQuery);
    $maxID = $maxIDResult->fetch_assoc()["maxID"];

    $newID = $maxID + 1; // 삭제한 일정의 다음 순번으로 할당

    // 일정 추가 쿼리 실행
    $sql = "INSERT INTO scheduletbl (scheduleName, startdatetime, enddatetime, place, ProjectTBL_projectID) 
        VALUES ('$scheduleName', '$startdatetime', '$enddatetime', '$place', '$pID')";
    if ($conn->query($sql) === TRUE) {
        echo '<script>alert("일정이 추가되었습니다.");
        window.location = "schedule.php";</script>';
        
    } else {
        echo '<script>alert("일정 추가 실패: " '. $conn->error.'");
        window.location = "schedule.php";</script>';
    }
}

if (isset($_GET["delete"])) {
    $deleteID = $_GET["delete"];
    // 삭제할 일정의 scheduleID 값 가져오기
    $getScheduleID = "SELECT ScheduleID FROM scheduletbl WHERE scheduleID = $deleteID";
    $scheduleIDResult = $conn->query($getScheduleID);
    if ($scheduleIDResult->num_rows > 0) {
        $deletedScheduleID = $scheduleIDResult->fetch_assoc()["ScheduleID"];
        
        // 일정 삭제 쿼리 실행
        $deleteSQL = "DELETE FROM scheduletbl WHERE ScheduleID = $deleteID";
        if ($conn->query($deleteSQL) === TRUE) {
            // 삭제된 일정 이후의 scheduleID 값 조정
            $updateSQL = "UPDATE Scheduletbl SET ScheduleID = ScheduleID - 1 WHERE ScheduleID > $deletedScheduleID";
            $conn->query($updateSQL);

            echo '<script>alert("일정이 삭제되었습니다."); window.location = "schedule.php";</script>';
        } else {
            echo '<script>alert("일정 삭제 실패: ' . $conn->error . '"); window.location = "schedule.php";</script>';
        }
    } else {
        echo '<script>alert("일정을 찾을 수 없습니다."); window.location = "schedule.php";</script>';
    }
}

// 일정 목록 가져오기
$sql = "SELECT ScheduleID, scheduleName, startdatetime, enddatetime, place FROM scheduletbl";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // 각 일정을 테이블에 표시
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["ScheduleID"] . "</td>";
        echo "<td>" . $row["scheduleName"] . "</td>";
        echo "<td>" . $row["startdatetime"] . "</td>";
        echo "<td>" . $row["enddatetime"] . "</td>";
        echo "<td>" . $row["place"] . "</td>";
        echo '<td><a href="test.php?delete=' . $row["ScheduleID"] . '">삭제</a></td>';
        echo "</tr>";
    }
} else {
    echo "일정이 없습니다.";
}

$conn->close();
?>