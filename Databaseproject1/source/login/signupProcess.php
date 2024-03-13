<?php
require '..\includes\db_connect.php';
$hashedPassword = password_hash($_POST['Password'], PASSWORD_DEFAULT);

$check_sql= "SELECT MemberID FROM memberstbl WHERE MemberID='".$_POST['MemberID']."';";
$checkID = mysqli_query($conn, $check_sql);

if(mysqli_num_rows($checkID)!=0){ ?>
    <script>
        alert("중복된 아이디가 존재합니다. 다른 아이디를 사용해주세요.");
        location.href = "signup.php";
    </script>
<?php
}
else {
$sql = "
    INSERT INTO membersTBL
    (MemberID, Password, Name, Email)
    VALUES('{$_POST['MemberID']}', '{$hashedPassword}', 
    '{$_POST['Name']}', '{$_POST['Email']}'
    )";
$result = mysqli_query($conn, $sql);

if ($result === false) {
    echo "저장에 문제가 생겼습니다. 관리자에게 문의해주세요.";
    echo mysqli_error($conn);
} else {
?>
    <script>
        alert("회원가입이 완료되었습니다");
        location.href = "..\\home.php";
    </script>
<?php
}
}
?>