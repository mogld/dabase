<!DOCTYPE html>
<html>
<head>
  <title>글쓰기</title>
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

    .container {
      width: 500px;
      margin: 0 auto;
      
    }
    .form-group {
      font-family: "DXKPMB", "kyuri", "함초롬바탕";
      margin-bottom: 20px;
    }

    .form-group label {
      display: block;
      font-weight: bold;
    }

    .form-group input[type="text"],
    .form-group textarea {
      width: 100%;
      padding: 5px;
      font-size: 16px;
    }

    .form-group textarea {
      height: 150px;
    }

    .form-group .btn {
      display: inline-block;
      padding: 10px 20px;
      background-color: #627390;
      color: #fff;
      text-decoration: none;
      border-radius: 5px;
      transition: background-color 0.3s;
    }

    .form-group .btn:hover {
      background-color: #3f434c;
    }
  </style>
</head>
<?php
  session_start();
  $MemberID = $_SESSION['MemberID'];
  $projectID = $_SESSION['projectID'];
  $date = date('Y-m-d');
?>
<body link="#0e3984" vlink="#0e3984" alink="#C0C5CD">
  <div class="container">
    <h1>공지사항 작성</h1>
    <form action="ns.php" method="POST">

    <input type="hidden" name="memberID" value="<?=$MemberID?>">
    <input type="hidden" name="projectID" value="<?=$projectID?>">
    <input type="hidden" name="date" value="<?=$date?>">
    
    <div class="form-group">
      <label for="title">제목</label>
      <input type="text" id="title" name="title" required>
    </div>

    <div class="form-group">
      <label for="description">내용</label>
      <textarea id="description" name="description" required></textarea>
    </div>

    <div class="form-group">
        <select name="recipient_email">              
          <option value="1">이메일 알림보내기</option>
          <option value="0">알림 보내지 않음</option>
        </select>
    </div>
    <div class="form-group">
      <input type="submit" value="등록" class="btn">
    </div>
  </form>
</div>
</body>
</html>

