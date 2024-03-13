<!DOCTYPE html>
<html>
  <head>
    <title>홈페이지 메인화면</title>
    <style>

      @font-face {
        font-family: "ssangmundong";
        src: url("./css/Typo_SsangmunDongB.ttf") format("truetype");
        font-weight: normal;
      }
      body { 
        font-family: 'ssangmundong'; 
        margin:0; padding:0; 
        background-attachment: fixed 
      }
      #header {
        position: relative;
        background-color: #EBF2FF;
        padding: 20px;
      }
      ul li {list-style: none;}
      #header .inner {
          max-width: 1200px;
          margin: 0 auto;
      }
      #header .inner:after {
          content: "";
          clear: both;
          display: block;
          height: 0;
          visibility: hidden;
      }
      #header h1 {
          float: left;
          max-width: 500px;
          overflow: hidden;
          font-size:1.25em;
          line-height: 28px;
          letter-spacing: 0.5px;
          text-overflow:ellipsis;
          white-space:nowrap;
      }
      #header h1 a {
          display: inline-block;
          vertical-align: top;
          text-decoration: none;
          color: #000;
      }
      #header h1 img {
        width: 82px;
      }
      #header .mobile-menu {display: none;}
      #gnb  {
          position: relative;
          float: right;
      }
      #gnb ul li {
          float: left;
          padding:26px 16px;
          font-size: 2em;
      }
      #gnb ul li a {
          display: block;
          position: relative;
          padding:0 4px;
          text-decoration: none;
          line-height: 28px;
          color: #000;
      }
      #gnb ul li a:hover {
          color: #3E588F;
      }
      #gnb ul li a:hover:after {
          content: "";
          display: block;
          position: absolute;
          top: 100%;
          left: 0;
          width: 100%;
          height: 4px;
          margin-top: 22px;
          background-color: #3E588F;
      }
    </style>
  </head>
  <body link="#0e3984" vlink="#0e3984" alink="#C0C5CD">
    <header id="header">
      <div class="inner">
        <h1>
          <a href="home.php" target="_parent"><img src="img\lo.png" class="logo"></a>
        </h1>
        <nav id="gnb">
          <ul>
            <li>
              <a href="home.php" target="_parent">홈</a>
            </li>
            <li>
              <a href="main\project.php" target="_parent">프로젝트</a>
            </li>
            <li>
              <a href="schedule\Schedule_frame.php" target="_parent">일정</a>
            </li>
            <?php
              session_start();
              if(isset($_SESSION['MemberID'])) {
                echo '<li><a href="login\logoutProcess.php" target="_parent">로그아웃</a></li>';
              } else {
                echo '<li><a href="login\login.php" target="_parent">로그인</a></li>';
              }
            ?>
          </ul>
        </nav>
      </div>
      <hr size="2" width="93%">
    </header>
  </body>
</html>