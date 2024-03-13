<?php
    $servername = "localhost";
    $username = "cookUser";
    $password = "1234";
    $dbname = "TeamDB";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("MySQL 연결 실패: " . $conn->connect_error);
    }
    date_default_timezone_set('Asia/Seoul');
?>