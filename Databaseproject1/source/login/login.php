<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>로그인</title>
    <link rel="stylesheet" href="..\css\login.css">
    <style>
        a {text-decoration: none}
    </style>
</head>

<body link="#0e3984" vlink="#0e3984" alink="#C0C5CD">
    <form method="POST" action="loginProcess.php"> 
    <div class="container">
        <div class = "login_session_box">
            <div class = "login_box_header">
                <h1 class = "text_Gull">  <a href="../home.php" target="_parent"> <img src="../img\lo.png" width="50px" style="vertical-align:bottom;"> Gull Group <img src="../img\lo.png" width="50px" style="vertical-align:bottom;"> </a> </h1>
            </div>

            <div>
                <fieldset>
                    <div class = "panel_inner">
                        <div>
                            <div class="input_row">
                                <div class = "icon_id_p">
                                    <span class = "icon_id">
                                        <span class = "blind"> 아이디 </span>
                                    </span>
                                </div>
                                    <input type="text" name="MemberID" class="id_p_text" placeholder="아이디">
                            </div>
                        
                            <div class="input_row">
                                <div class = "icon_id_p">
                                    <span class = "icon_password">
                                        <span class = "blind"> 비밀번호 </span>
                                    </span>
                                </div>
                                    <input name="Password" type="password" class="id_p_text" placeholder="비밀번호">
                            </div>
                            <br>

                            <div>
                                <button type="submit" class="login">로그인</button>
                            </div>
                        </div>
                    </div>
                </fieldset>
            </div> <br>
            <div>
                <button type = "button" class = "sign" onclick = "location.href='signup.php'">회원가입</button>
            </div>
        </div>
    </div>
    </form>
</body>

</html>
