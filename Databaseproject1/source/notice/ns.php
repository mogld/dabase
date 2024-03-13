<?php
// MySQL 연결 설정
require_once '..\includes\db_connect.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '..\includes\PHPMailer\src\Exception.php';
require '..\includes\PHPMailer\src\PHPMailer.php';
require '..\includes\PHPMailer\src\SMTP.php';

// POST 데이터 가져오기
$title = $_POST["title"];
$description = $_POST["description"];
$date = $_POST["date"];
$projectID = $_POST["projectID"];
$memberID = $_POST["memberID"];
$email = $_POST['recipient_email'];

if ($email==1) {

    // 이메일 제목
    $subject = "공지사항";

    $mail = new PHPMailer(true);
    $mail->CharSet = 'UTF-8';

    $mail->Encoding = 'base64';
    $mail->addCustomHeader('Content-Type: text/plain; charset=UTF-8');

    // 이메일 내용
    $message = "제목: " . $_POST['title'] . "\n\n";
    $message .= "내용: " . $_POST['description'];

    try {
        // SMTP 설정
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 587;
        $mail->SMTPSecure = 'tls';
        $mail->SMTPAuth = true;
        $mail->Username = 'aksenkim777@gmail.com'; // 발신자 이메일 주소
        $mail->Password = 'oddjfaoepryogfok'; // 발신자 이메일 비밀번호

        // 발신자 설정
        $mail->setFrom('purnsol1001@gmail.com');

        // 수신자 추가
        $sql = "SELECT Email FROM memberstbl LEFT JOIN memberstbl_has_projecttbl ON memberstbl.MemberID = memberstbl_has_projecttbl.MembersTBL_MemberID WHERE memberstbl_has_projecttbl.ProjectTBL_projectID='".$projectID."';";
        $getEmail = $conn->query($sql);
        while ($row = $getEmail->fetch_assoc()) {
            $mail->addAddress(trim($row['Email']));
        }

        // 이메일 내용 설정
        $mail->Subject = $subject;
        $mail->Body = $message;

        // 이메일 전송
        $mail->send();

    } catch (Exception $e) {
        echo "<script>alert('이메일 전송에 실패했습니다. 오류 메시지: ". $mail->ErrorInfo . "');</script>";
    }
}

//공지사항 추가 쿼리
$sql = "INSERT INTO noticeTBL VALUES (NULL,'".$title."','".$description."','".$date."',".$email.",".$projectID.",'".$memberID."');";
  
if ($conn->query($sql) === TRUE) {
    $conn->close();
    echo "<script>alert('공지사항이 성공적으로 작성되었습니다.'); location.href='notices.php';</script>";
    exit;
  } else {
    echo "<script>alert('공지사항 작성 실패: " . $conn->error . "');</script>";
  }

// MySQL 연결 종료
$conn->close();
?>
