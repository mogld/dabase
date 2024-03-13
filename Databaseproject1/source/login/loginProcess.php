<?php
require '..\includes\db_connect.php';

$memberID = $_POST['MemberID'];
$password = $_POST['Password'];

$sql = "SELECT * FROM memberstbl WHERE MemberID ='{$memberID}'";
$result = mysqli_query($conn, $sql);

$row = mysqli_fetch_array($result);
$hashedPassword = $row['Password'];
$row['MemberID'];


$passwordResult = password_verify($password, $hashedPassword);
if ($passwordResult === true) {
    // 로그인 성공
    // 세션에 id 저장
    session_start();
    $_SESSION['MemberID'] = $row['MemberID'];
?>
    <script>
        alert("<?php echo $row['Name'];; ?>님 환영합니다.");
        window.top.location.href = "..\\home.php";
    </script>
<?php
} else {
    // 로그인 실패 
?>
    <script>
        alert("로그인에 실패하였습니다");
        window.top.location.href = "login.php";
    </script>
<?php
}
?>
