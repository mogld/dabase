<!DOCTYPE html>
<html>
<head>
    <title>프로젝트 목록</title>
    <style>
        @charset "UTF-8";

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
        @font-face {
        font-family: "galmat";
        src: url("../css/galmat.ttf") format("truetype");
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
            font-family: "galmat";
            text-align: center;
            margin-bottom: 18px;
        }

        .project-list {
            font-family: "DXKPMB";
            max-width: 80%;
            margin: 0 auto;
            background-color: #fff;
            border-radius: 5px;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 12px 14px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        tr:hover {
            background-color: #f9f9f9;
        }

        .add-button {
            font-family: "DXKPMB";
            display: block;
            width: 150px;
            margin: 15px auto;
            background-color: #627390;
            color: #fff;
            text-align: center;
            padding: 12px;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s;
        }

        .add-button:hover {
            background-color: #3f434c;
        }
        .btn-delete, .btn-edit {
            display: inline-block;
            padding: 5px 4px;
            background-color: #bbb;
            color: #fff;
            text-decoration: none;
            border-radius: 3px;
            font-size: 11px;
        }

        .btn-delete:hover {
            background-color: #999;
        }

        .btn-edit:hover {
            background-color: #999;
        }
        a {
            text-decoration: none;
        }
    </style>
    
</head>
<body link="#0e3984" vlink="#0e3984" alink="#C0C5CD">
    <h1>프로젝트 목록</h1>

    <div class="project-list">
    <?php
    // db_connect.php 파일을 포함하여 MySQL 연결
    require_once '..\includes\db_connect.php';

    // 로그인된 사용자의 ID 가져오기
    session_start();
    $MemberID = $_SESSION['MemberID'] ?? "";

    // 사용자가 로그인되어 있는지 확인
    if (empty($MemberID)) {
        // 로그인되지 않은 상태이므로 로그인을 요청하는 메시지를 출력
        echo '<center><p>로그인이 필요합니다. 로그인을 먼저 해주세요.</p></center>';
    } else {
        // 프로젝트 목록을 조회하여 테이블로 표시
        $sql = "SELECT * FROM ProjectTBL LEFT JOIN memberstbl_has_projecttbl ON ProjectTBL.projectID=memberstbl_has_projecttbl.ProjectTBL_projectID WHERE memberstbl_has_projecttbl.MembersTBL_MemberID='".$MemberID."' ORDER BY projectID ASC;";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo '<table>';
            echo '<tr><th>번호</th><th>프로젝트 제목</th><th>설명</th><th>시작일</th><th>마감일</th><th>회원 아이디</th><th>수정</th><th>삭제</th></tr>';
            $i=1;
            while ($row = $result->fetch_assoc()) {
                echo '<tr>';
                echo '<td>' . $i . '</td>';
                echo '<td><a href="..\notice\Notice.php?projectID='.$row['projectID'].'">' . $row['Title'] . '</td>';
                echo '<td>' . mb_strimwidth($row['description'], '0', '70', '..', 'utf-8') . '</td>';
                echo '<td>' . $row['startdate'] . '</td>';
                echo '<td>' . $row['enddate'] . '</td>';
                echo '<td>' . $row['MembersTBL_MemberID'] . '</td>';
                echo '<td><a href="..\notice\Notice.php?projectID='.$row['projectID'].'&mode=1" class="btn-edit">수정</a></td>';
                echo '<td><a href="deleteproject.php?projectID=' . $row['projectID'] . '" class="btn-delete">삭제</a></td>';
                echo '</tr>';
                $i++;
            }

            echo '</table>';
        } else {
            echo "<p>프로젝트가 없습니다.</p>";
        }
    }
    // MySQL 연결 종료
    $conn->close();
    ?>
    </div>

    <?php if (!empty($MemberID)) { ?>
        <a href="projectadd.php" class="add-button">프로젝트 추가</a>
    <?php } ?>
</body>
</html>
