<?php
// db_connect.php 파일을 포함하여 MySQL 연결
require_once '..\includes\db_connect.php';

// 삭제할 프로젝트의 projectID를 가져옴
$projectID = $_GET["projectID"];

// ProjectTBL에서 해당 projectID를 가진 프로젝트 삭제
$sql = "DELETE FROM ProjectTBL WHERE projectID = ?";

// Prepared statement를 생성
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $projectID);

if ($stmt->execute() === TRUE) {
    $stmt->close();
    $conn->close();
    echo "<script>alert('프로젝트가 삭제되었습니다.'); location.href='projectlist.php';</script>";
    exit;
} else {
    echo "삭제 실패: " . $stmt->error;
}

// Statement와 연결 닫기
$stmt->close();

// MySQL 연결 종료
$conn->close();
?>
