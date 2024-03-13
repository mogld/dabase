<!DOCTYPE html>
<html>
<head>
    <title>홈페이지 메인화면</title>
    <style>
            @font-face {
        font-family: "ssangmundong";
        src: url("css/Typo_SsangmunDongB.ttf") format("truetype");
        font-weight: normal;
    }
    
    @font-face {
        font-family: "DXKPMB";
        src: url("css/DXKPMB-KSCpc-EUC-H.ttf") format("truetype");
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

        .container {
            display: flex;
            flex-wrap: wrap;
            padding: 10px;

            justify-content: center;
            align-items: center;
        }

        .notice {
            font-family: "DXKPMB", "함초롬바탕";
            border: 1px solid #ddd;
            border-radius: 5px;
            background: linear-gradient(to left, #E3E8F8, #e0e5eb);
            padding: 20px;
            margin-bottom: 15px;
            flex-basis: calc(50% - 10px);
        }

        .notice h2 {
            font-family: "ssangmundong", "함초롬바탕";
            background-color: white;
            border-style: double;
            line-height: 40px;
            border-width: thick;
            border-color: #c0c5c0;
            text-align: center;
            margin-bottom: 0;
            margin-top: 0;
            margin-left: 20px;
        }

        .notice h2 a {
            color: inherit;
            text-decoration: none;
        }

        .notice ul {
            padding-left: 20px;
            margin: 0;
        }

        .notice li {
            margin-bottom: 10px;
        }
        p {
                font-family: "DXKPMB", "함초롬바탕";
        }
    </style>
</head>
<body link="#0e3984" vlink="#0e3984" alink="#C0C5CD">
    <div class="container">
        <?php
        // MySQL 연결 설정
        require_once 'includes\db_connect.php';
        session_start();
        $MemberID = $_SESSION['MemberID'] ?? "";

        // 공지사항 가져오기
        $sql = $sql = "SELECT * FROM noticetbl LEFT JOIN projecttbl ON noticetbl.ProjectTBL_projectID = projecttbl.projectID LEFT JOIN memberstbl_has_projecttbl ON projecttbl.projectID = memberstbl_has_projecttbl.ProjectTBL_projectID WHERE memberstbl_has_projecttbl.MembersTBL_MemberID='".$MemberID."';";
        $result = $conn->query($sql);

        // 공지사항 출력
        echo '<div class="notice">';
        echo '<h2>공 지 사 항</h2><br>';
        if (empty($_SESSION['MemberID'])) {
            echo '<p><center>로그인이 필요합니다.</center></p>';
        } else {
            if ($result->num_rows > 0) {
                echo '<ul>';
                while ($row = $result->fetch_assoc()) {
                    echo '<li>' . $row['Title'] . ' : '.$row['title'] . '</li>';
                }
                echo '</ul>';
            } else {
                echo '<p>공지사항이 없습니다.</p>';
            }
        }
        echo '</div>';

        // 프로젝트 가져오기
        $sql = "SELECT * FROM ProjectTBL LEFT JOIN memberstbl_has_projecttbl ON ProjectTBL.projectID=memberstbl_has_projecttbl.ProjectTBL_projectID WHERE memberstbl_has_projecttbl.MembersTBL_MemberID='"
            .$MemberID."' ORDER BY projectID ASC;";
        $result = $conn->query($sql);

        // 프로젝트 출력
        echo '<div class="notice">';
        echo '<h2><a href="main\project.php" target="_parent">참여 프로젝트</a></h2><br>';

        if (empty($_SESSION['MemberID'])) {
            echo '<p><center>로그인이 필요합니다.</center></p>';
        } else {
            if ($result->num_rows > 0) {
                echo '<ul>';
                while ($row = $result->fetch_assoc()) {
                    echo '<li>' . $row['Title'] . '</li>';
                }
                echo '</ul>';
            } else {
                echo '<p>프로젝트가 없습니다.</p>';
            }
        }
        echo '</div>';

        // MySQL 연결 종료
        $conn->close();
        ?>
    </div>
    <script>
        const container = document.querySelector(".container");
        const notice = document.querySelector(".notice");

        container.style.display = "flex";
        container.style.flexWrap = "wrap";
        notice.style.flexBasis = "calc(50% - 10px)";
    </script>
</body>
</html>
