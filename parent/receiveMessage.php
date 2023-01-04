<?php
include_once "../config/connect.php";
include_once "../config/functionStatement.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    include_once '../script.php'; ?>
    <style>
    #notification {
        font-size: 30px;
        padding: 12px;
        border-radius: 50%;
        background: #999;
        transition: .2s linear;
        position: relative;
        color: #fff;
    }

    #notification:hover {
        color: blue;
        cursor: pointer;
        background: #f5f5f6;
    }

    #message {
        min-width: 300px;
        border-radius: 6px;
        background-color: #fff;
        display: none;
        position: absolute;
        top: 10%;
        right: 85px;
    }

    .list-unstyled>* {
        margin-left: 8px;
    }

    .toast-body {
        font-size: 15px;
    }
    </style>
    <?php
    include '../script.php';
    ?>
</head>

<body>
    <div>
        <i class="fa-sharp fa-solid fa-bell" id="notification"></i>
        <div class="toast mt-2" id="message" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <strong class="me-auto">Thông báo điểm</strong>
                <small>Gần đây</small>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                <?php
                $parentID = $_SESSION['parent_id'];
                $sql = "SELECT st.name
                FROM `students` AS st
                JOIN `parents` AS p 
                ON st.id = p.student_id 
                WHERE $parentID= st.id";
                $messages = executeStatement($sql);
                $row = $messages->fetch_assoc();
                if (empty($row)) {
                    error_reporting(0);
                    ini_set('display_errors', 0);
                }
                echo '
                <p>Gửi đến phụ huynh em : <span class="fw-bold">' . $row['name'] . '</span></p>
                <p>Kết quả học tập :</p>';
                ?>
                <?php
                $query = "SELECT s.training_score,s.learning_score
                FROM `scores` AS s
                JOIN `students` AS st ON s.student_id = st.id
                JOIN `parents`  AS p ON s.student_id = p.student_id
                WHERE s.student_id = st.id  AND $parentID = st.id
                ";
                $scores = executeStatement($query);
                $row = $scores->fetch_assoc();
                $training_score = $row['training_score'];
                $learning_score = $row['learning_score'];
                if (empty($students)) {
                    error_reporting(0);
                    ini_set('display_errors', 0);
                }
                echo
                '<ul class="list-unstyled"
                    <li class="lh-lg list-item"><span>Điểm rèn luyện : <span class="fw-bold">' . $training_score . '</span></span></li>
                    <li class="lh-lg list-item"><span>Điểm học tập : <span class="fw-bold"> ' . $learning_score . '</span></span></li>
                 </ul>';
                ?>
            </div>
        </div>
    </div>
</body>
<script type="text/javascript">
$(document).ready(function() {
    const message = $("#message");
    $("#notification").click(function(e) {
        e.preventDefault();
        $("#message").css("display", "block");
    });

    $('.btn-close').click(function() {
        message.css('display', 'none');
    })
    document.addEventListener('mouseup', function(e) {
        e.preventDefault();
        if (!$(e.target).is(message)) {
            message.css("display", "none");
        }
    });
    // })
})
</script>

</html>