<html>
  <head>
	  <title> smenu </title>
    <style>

      @font-face {
          font-family: "ssangmundong";
          src: url("css/Typo_SsangmunDongB.ttf") format("truetype");
          font-weight: normal;
      }

      body {
        margin:0; padding:0; 
        background-color: #fff;
      }

      a {
        text-decoration: none;
      }

      div {
        font-family: "ssangmundong";
        font-size: 40px;
        text-shadow: 2px 2px 2px gray;

        margin:0; padding:0; 
        height:25%;

        display: flex;
        justify-content: center;
        align-items: center;

        transition: all 0.3s;
      }

      .side-notice {
        background-color: rgba(62, 88, 143, 0.2);
      }
      .side-notice:hover {
        cursor: pointer;
        font-size: 45px;
        text-shadow: 2px 2px 2px #222;
        background-color: rgba(62, 88, 143, 0.3);
      }

      .side-checklist {
        background-color: rgba(62, 88, 143, 0.4);
      }
      .side-checklist:hover {
        cursor: pointer;
        font-size: 45px;
        text-shadow: 2px 2px 2px #222;
        background-color: rgba(62, 88, 143, 0.5);
      }

      .side-meeting {
        background-color: rgba(62, 88, 143, 0.6);
      }
      .side-meeting:hover {
        cursor: pointer;
        font-size: 45px;
        text-shadow: 2px 2px 2px #222;
        background-color: rgba(62, 88, 143, 0.7);
      }

      .side-feedback {
        background-color: rgba(62, 88, 143, 0.8);
      }
      .side-feedback:hover {
        cursor: pointer;
        font-size: 45px;
        text-shadow: 2px 2px 2px #222;
        background-color: rgba(62, 88, 143, 0.9);
      }

	  </style>
  </head>
  <body link="#f9f9f9" vlink="#f9f9f9" alink="#C0C5CD">
    <a  href="notice\Notice.php" target="_parent">
      <div class="side-notice">
        공지사항
      </div>
    </a>
    <a href="project\Checklist.php" target="_parent">
      <div class="side-checklist">
        프로젝트
      </div>
    </a>
    <a a href="meeting\Meetings.php" target="_parent">
      <div class="side-meeting">
        회의록
      </div>
    </a>
    <a href="feedback\Feedbacks.php"target="_parent">
      <div class="side-feedback">
        피드백
      </div>
    </a>
  </body>
</html>