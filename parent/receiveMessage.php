<?php
include "../admin/config/connect.php";
include "../admin/config/functionStatement.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    include '../script.php' ?>
    <style>
    #notification {
        font-size: 30px;
        padding: 8px;
        border-radius: 50%;
        background: #999;
        transition: .2s linear;
        position: relative;
        color: #fff;
    }

    #notification:after {
        content: "1";
        position: absolute;
        top: -15%;
        right: -15px;
        font-size: 14px;
        color: #fff;
        font-weight: bold;
        background: red;
        border-radius: 6px;
        padding: 8px 10px;
        text-align: center;
    }

    #notification:hover {
        color: blue;
        cursor: pointer;
        background: #f5f5f6;
    }

    .toast {
        position: absolute;
        top: 10%;
        right: 10px;
    }
    </style>
</head>

<body>
    <div>
        <i class="fa-sharp fa-solid fa-bell" id="notification"></i>
        <div class="toast mt-2" role="alert" aria-live="assertive" aria-atomic="true" data-bs-autohide=false>
            <div class="toast-header">
                <strong class="me-auto">Thông báo điểm</strong>
                <small>Gần đây</small>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                <?php
                $sql = "SELECT name FROM `students`  WHERE id= 2";
                $messagesToParents = executeResult($sql);
                foreach ($messagesToParents as $mg) {
                    echo '
                <p>Gửi đến phụ huynh em : <span class="fw-bold">' . $mg['name'] . '</span></p>
                <p>Kết quả học tập :</p>
            ';
                }
                ?>
                <?php
                $sql = "SELECT * FROM `scores` WHERE student_id = 2";
                $messages = executeResult($sql);
                foreach ($messages as $message) {
                    echo '
                    <li class="lh-lg"><span>Điểm rèn luyện :  <span class="fw-bold">' . $message['training_score'] . '</span></span></li>
                    <li class="lh-lg"><span>Điểm học tập : <span class="fw-bold"> ' . $message['learning_score'] . '</span></span> </li>
                ';
                }
                ?>
            </div>
        </div>
    </div>
</body>
<script type="text/javascript">
$(document).ready(function() {
    var toast = $(".toast").toast();
    $("#notification").click(function(e) {
        e.preventDefault();
        toast.show();
        console.log("Hello");
    })
    $(".btn-close").click(function(e) {
        e.preventDefault();
        toast.remove();
    })
    // document.addEventListener('mouseup', function(e) {
    //     e.preventDefault();
    //     if (e.target !== toast) {
    //         toast.hide(600);
    //     }
    // })
})
</script>

</html>