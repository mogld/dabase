<!DOCTYPE html>
<html>
<head>
    <title>프로젝트 추가</title>
    <style>

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

        .project-add {
            font-family: "DXKPMB";
            max-width: 500px;
            margin: 0 auto;
            background-color: #fff;
            border-radius: 5px;
            padding: 30px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 15px;
        }


        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .form-group input[type="text"],
        .form-group textarea,
        .form-group input[type="date"],
        .form-group input[type="submit"] {
            width: 100%;
            padding: 8px;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-size: 16px;
                        font-family: "DXKPMB";
        }

        .form-group textarea {
            height: 100px;
        }
        
        .from-group input[type="date"] {
            font-family: "DXKPMB";
        }

        .form-group input[type="submit"] {
            font-family: "DXKPMB";
            background-color: #627390;
            color: #fff;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .form-group input[type="submit"]:hover {
            background-color: #3f434c;
        }

        .back-link {
            text-decoration: none;
            display: block;
            text-align: center;
            margin-top: 20px;
        }

        .project-list {
            font-family: "DXKPMB";
            line-height: 40px;
            max-width: 25%;
            margin: 0 auto;
            background-color: #fff;
            border-radius: 5px;
            padding: 0px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
                        transition: background-color 0.3s;
        }
        .project-list:hover {
            background-color: #e8eaf3;
        }

    </style>
</head>
<body link="#0e3984" vlink="#0e3984" alink="#C0C5CD">
    <h1>프로젝트 추가</h1>

    <?php
    // db_connect.php 파일을 포함하여 MySQL 연결
    require_once '..\includes\db_connect.php';
    session_start();
    // 새 프로젝트 추가 폼이 제출되었을 때
    if (isset($_POST['submit'])) {
        $project_title = $_POST['project_title'];
        $description = $_POST['description'];
        $start_date = $_POST['start_date'];
        $end_date = $_POST['end_date'];
        $memberID = $_SESSION['MemberID'];

        // 새 프로젝트를 데이터베이스에 삽입
        $sql = "INSERT INTO ProjectTBL VALUES (NULL,'$project_title', '$description', '$start_date', '$end_date')";
        if ($conn->query($sql) === TRUE) {
            $sql = "SELECT * FROM projecttbl WHERE Title='".$project_title."' AND description='".$description."' AND startdate='".$start_date."' AND enddate='".$end_date."' ORDER BY projectID DESC LIMIT 1;";
            $getPID = ($conn->query($sql))->fetch_assoc();
            $projectID = $getPID['projectID'];
            $sql2 = "INSERT INTO memberstbl_has_projecttbl VALUES ('$memberID','$projectID')";
            $conn->query($sql2);

        echo "<script>alert('새 프로젝트가 추가되었습니다.');</script>";
        header("Location: projectlist.php");
        } 
        else {
            echo "오류: " . $sql . "<br>" . $conn->error;
        }
    }
    ?>

    <form method="post" action="">
    <div class="project-add">
        <form method="post" action="">
            <div class="form-group">
                <label for="project_title">프로젝트 제목:</label>
                <input type="text" id="project_title" name="project_title" required>
            </div>

            <div class="form-group">
                <label for="description">설명:</label>
                <textarea id="description" name="description" required></textarea>
            </div>

            <div class="form-group">
                <label for="start_date">시작일:</label>
                <input type="date" id="start_date" name="start_date" required>
            </div>

            <div class="form-group">
                <label for="end_date">마감일:</label>
                <input type="date" id="end_date" name="end_date" required>
            </div>
            <div class="form-group">
                <input type="submit" name="submit" value="프로젝트 추가">
            </div>
        </form>
    </div>

    <div class="project-list"><a href="project.php" target="_parent" class="back-link">프로젝트 목록으로 돌아가기</a></div>
    </body>
</html>