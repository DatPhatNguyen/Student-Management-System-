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
    <?php include "../script.php    " ?>
    <style>
    #first {
        margin-bottom: 20px;
    }

    #two {
        margin: 0 0 20px 20%;
    }

    #three {
        margin: 0 0 20px 40%;
    }
    </style>
</head>

<body>
    <h1 class="text-capitalize mt-4 mb-5 fw-bold text-center" style="font-weight:900">bảng thống kê</h1>
    <!-- <div class="container mx-auto d-flex align-items-center mt-5" style="gap:30px; max-width:100%; padding:0;"> -->
    <div class=" p-4" style="width:23vw; height: 24vh;background:#f7d794; border-radius:24px;" id="first">
        <h6 class="text-capitalize fw-bold">Sinh viên</h6>
        <h1 class=" mb-3" style="color:#1e272e;font-weight:900"><?php
                                                                $selectStudents = sqlSelectAll('students');
                                                                $result = executeStatement($selectStudents);
                                                                $countStudent = $result->num_rows;
                                                                echo $countStudent; ?></h1>
        <a href="studentlist.php" class="text-decoration-none " style="font-size:17px;">Xem chi tiết</a>
    </div>
    <div class="p-4" style="width:23vw; height: 24vh;background:#ffcccc; border-radius:24px;" id="two">
        <h6 class="text-capitalize fw-bold ">phụ huynh
        </h6>
        <h1 class=" mb-3" style="color:#1e272e;font-weight:900"><?php
                                                                $selectParents = sqlSelectAll('parents');
                                                                $result = executeStatement($selectParents);
                                                                $countParent = $result->num_rows;
                                                                echo $countParent; ?></h1>
        <a href="parentlist.php" class="text-decoration-none " style="font-size:17px;">Xem chi tiết</a>
    </div>
    <div class=" p-4" style="width:23vw; height: 24vh;background:#00d2d3; border-radius:24px;" id="three">
        <h6 class="text-capitalize  fw-bold">admin
        </h6>
        <h1 class=" mb-3" style="color:#1e272e;font-weight:900"><?php
                                                                $selectAdmins = sqlSelectAll('admins');
                                                                $result = executeStatement($selectAdmins);
                                                                $countAdmin = $result->num_rows;
                                                                echo $countAdmin; ?></h1>
        <a href="adminlist.php" class="text-decoration-none " style="font-size:17px;">Xem chi tiết</a>
    </div>
    <!-- </div> -->
</body>

</html>