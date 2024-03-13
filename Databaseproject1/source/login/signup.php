<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> 회원가입 </title>
    <link rel="stylesheet" href="..\css\sign_up.css" type="text/css">
    <style>
        a {text-decoration: none}
    </style>
    <script src="signup.js"></script>
</head>

<body link="#0e3984" vlink="#0e3984" alink="#C0C5CD">
    <form action="signupProcess.php" method="POST" id="signup-form" onsubmit="return joinform_check()">
    <div class="container">
        <div class = "signup_session_box">
            <div class = "signup_box_header">
                <h1 class = "text_Gull">  <a href="../home.php" target="_parent"> <img src="../img\lo.png" width="50px" style="vertical-align:bottom;"> Gull Group <img src="../img\lo.png" width="50px" style="vertical-align:bottom;"> </a> </h1>
            </div>

        <div class = "input_row">
            <h4 class = "join_title">
                <label for = "memberID">아이디</label>
            </h4>
            <span class = "box">
                <input type="text" name="MemberID" class="int" id="memberID" placeholder="아이디 입력">
            </span>
        </div>
            
        <div class = "input_row">
            <h4 class = "join_title">
                <label for="password">비밀번호</label>
            </h4>
            <span class = "box">
                <input name="Password" type="password" class="int" id="password" placeholder="비밀번호 입력 (8자리 이상)">
            </span>
        </div>

        <div class = "input_row">
            <h4 class = "join_title">
                <label for="passwordCheck">비밀번호 재확인</label>
            </h4>
            <span class = "box">
                <input type="password" class="int" id="password_check" placeholder="비밀번호를 다시 입력해주세요.">
            </span>
        </div>

        <div class = "input_row">
            <h4 class = "join_title">
                <label for="name">이름</label>
            </h4>
            <span class = "box">
                <input type="text" name="Name" class="int" id="name" placeholder="이름 입력">
            </span>
        </div>

        <div class = "input_row">
            <h4 class = "join_title">
                <label for="email">이메일</label>
            </h4>
            <span class = "box">
                <input type="email" name="Email" class="int" id="email" placeholder="이메일 입력">
            </span>   
        </div><br><br>
        
        <div>
            <button type="submit" class="login" id="signup-button">가입하기</button>
        </div>
    </div>
    </form>
</body>

</html>