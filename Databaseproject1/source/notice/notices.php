<!DOCTYPE html>
<html>
<head>
  <title>공지사항</title>
  <style>
    @font-face {
    font-family: "galmat";
    src: url("../css/galmat.ttf") format("truetype");
    font-weight: normal;
    }

    @font-face {
    font-family: "kyuri";
    src: url("kyuri.ttf") format("truetype");
    font-weight: normal;
    }

    @font-face {
        font-family: "ssangmundong";
        src: url("../css/Typo_SsangmunDongB.ttf") format("truetype");
        font-weight: normal;
    }

    @font-face {
        font-family: "DXKPMB";
        src: url("../css/DXKPMB-KSCpc-EUC-H.ttf") format("truetype");
        font-weight: normal;
    }  

::-webkit-scrollbar {
        width: 8px;
        height: 8px;
    }
    ::-webkit-scrollbar-track {
        background: #E3E8F8;
    }
    ::-webkit-scrollbar-thumb {
        border-radius: 5px;
        background: #6b778b;
    }
    ::-webkit-scrollbar-thumb:hover {
        background: #668bcb;
    }
    ::selection { background:#e1e1e1; color: #9d4545; text-shadow: none; }
    ::-moz-selection { background:#e1e1e1; color: #9d4545; text-shadow: none; }
    ::-webkit-selection { background:#e1e1e1; color: #9d4545; text-shadow: none; }

    body {
      margin: 5%;
      padding: auto;
      background-color: #fff;
      background-image: url("../img/back.png");
      background-size: 300px;
      background-repeat: repeat-x;
      background-attachment: fixed;
      background-position: bottom;
    }

    h1 {
      font-family: "galmat", "kyuri", "함초롬바탕";
    }

    .notice {
      border: 1px solid grey;
      border-radius: 5px;
      background: white;
      padding: 20px;
      margin-bottom: 20px;
    }

    .notice h2 {
      margin: 0;
    }

    .notice .notice-number {
      color: #888;
    }

    .notice .date {
      color: #888;
    }

    .notice .description {
      margin-top: 10px;
    }

    .btn {
      display: inline-block;
      padding: 10px 20px;
      background-color: #627390;
      color: #fff;
      text-decoration: none;
      border-radius: 5px;
      transition: background-color 0.3s;
    }

    .btn:hover {
      background-color: #3f434c;
    }

    .btn-delete {
      display: inline-block;
      padding: 5px 10px;
      background-color: #bbb;
      color: #fff;
      text-decoration: none;
      border-radius: 3px;
      font-size: 12px;
      top: 10px;
      right: 10px;
    }

    .btn-delete:hover {
      background-color: #999;
    }

    div {
      font-family: "DXKPMB", "함초롱바탕";
      line-height: 20px;
    }
  </style>
</head>
<body link="#0e3984" vlink="#0e3984" alink="#C0C5CD">
  <h1>공 지 사 항</h1>

  <div>
  <?php
  // MySQL 연결 설정
  require_once '..\includes\db_connect.php';

  // 세션 시작
  session_start();
  $pID = $_SESSION['projectID'];
  // 로그인 여부 확인
  if (isset($_SESSION['MemberID'])) {
    $MemberID = $_SESSION['MemberID'];

    // 공지사항 가져오기
    $sql = "SELECT * FROM noticeTBL WHERE ProjectTBL_projectID = '$pID'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        echo "<div class='notice'>";
        echo "<h2>" . $row["title"] . "</h2>";
        echo "<div class='description'>" . $row["description"] . "</div>";
        echo "<div class='date'>작성일: " . $row["date"] . "</div>";

        // 삭제 버튼 추가
        echo "<a href='deletenotice.php?index=" . $row["title"] . "' class='btn-delete'>삭제</a>";
        echo "</div>";
      }
    } else {
      echo "<div class='notice'>등록된 공지사항이 없습니다.</div>";
    }

    // MySQL 연결 종료
    $conn->close();
  } else {
    // 로그인 안된 경우 메시지 표시
    echo "<div class='notice'>로그인이 필요합니다.</div>";
  }

  // 로그인된 경우에만 등록 버튼 표시
  if (isset($_SESSION['MemberID'])) {
    echo "<a href='noticeswrite.php' class='btn'>등록</a>";
  }
  ?>
  </div>
</body>
</html>
