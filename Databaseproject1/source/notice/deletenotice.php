<?php
// noticeTBL과 연결
require_once '..\includes\db_connect.php';

$id = $_GET["index"];

// noticeTBL에서 해당 id를 가진 공지사항 삭제
$sql = "DELETE FROM noticeTBL WHERE title = ?";

// Prepared statement를 생성
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $id);

if ($stmt->execute() === TRUE) {
    $stmt->close();
    $conn->close();
    echo "<script>alert('공지사항이 삭제되었습니다.'); location.href='notices.php';</script>";
    exit;
} else {
    echo "<script>alert('삭제 실패: " . $stmt->error . "');</script>";
}

// Statement와 연결 닫기
$stmt->close();

// 연결 닫기
$conn->close();
?>
