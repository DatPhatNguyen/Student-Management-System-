<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include "../script.php"; ?>
</head>

<body>
    <div class=" col-lg-2 col-sm-2 col-md-2 d-flex flex-column control-bar"
        style="background:#f5f6fa;border-top-left-radius:30px;border-bottom-left-radius:30px;">
        <h4 class="my-5 text-uppercase text-center" style="font-weight:700;color:#e84118">quản lý
        </h4>
        <div class="flex-column d-flex justify-content-between mt-3" style="height:99%;">
            <div class="d-flex flex-column justify-content-around ms-2">
                <!-- manage parent -->
                <a href="index.php" class=" text-decoration-none p-3  fw-bold left-sidebar text-capitalize"
                    style="font-size:13px">
                    <i class="fa-solid fa-home me-4"></i>Về trang chủ
                </a>
                <hr>
                <p class="d-flex flex-column justify-content-around  fw-bold my-4 management-title text-capitalize"
                    style="font-size:14px;">
                    Quản lý phụ huynh
                    <a href="parentlist.php" class=" text-decoration-none p-3  fw-bold mt-4 left-sidebar"
                        style="font-size:13px" data-bs-toggle="tooltip" data-bs-placement="right"
                        title="Quản lý sinh viên"> <i class="fa-solid fa-eye me-4"></i>Xem danh sách
                    </a>
                </p>
                <hr>
                <!--  student's score manage -->
                <p class="d-flex flex-column justify-content-around  fw-bold my-4 management-title text-capitalize"
                    style="font-size:14px;">
                    Quản lý điểm
                    <a href="scoreList.php" class=" text-decoration-none p-3 mt-4 fw-bold left-sidebar"
                        style="font-size:13px" data-bs-toggle="tooltip" data-bs-placement="right"
                        title="Quản lý sinh viên"> <i class="fa-solid fa-eye me-4">
                        </i>Xem điểm sinh viên</a>
                </p>
                <hr>
                <!--  student manage -->
                <p class="d-flex flex-column justify-content-around  fw-bold my-4 management-title text-capitalize"
                    style="font-size:14px;">
                    Quản lý sinh viên
                    <a href="studentlist.php" class=" text-decoration-none p-3 mt-4 fw-bold left-sidebar"
                        style="font-size:13px" data-bs-toggle="tooltip" data-bs-placement="right"
                        title="Quản lý sinh viên"> <i class="fa-solid fa-eye me-4">
                        </i>Xem danh sách</a>
                    <a href="adduser.php" style="font-size:13px;"
                        class="text-decoration-none   fw-bold  mt-3 p-3 left-sidebar" data-bs-toggle="tooltip"
                        data-bs-placement="right" title="Thêm mới vào sinh viên"><i
                            class="fa-solid fa-plus me-4"></i>Thêm sinh viên
                    </a>
                </p>
                <hr>
                <!--  admin management -->
                <p class="d-flex flex-column justify-content-around  fw-bold my-4 management-title text-capitalize"
                    style="font-size:14px;">
                    Quản
                    lý
                    cán
                    bộ
                    <a href="adminlist.php" style="font-size:13px;"
                        class="text-decoration-none mt-4 fw-bold p-3 left-sidebar " data-bs-toggle="tooltip"
                        data-bs-placement="right" title="Xem danh sách cán bộ"><i
                            class="fa-solid fa-eye me-4"></i>Xem
                        danh
                        sách</a>
                    <a href="addadmin.php" style="font-size:13px;"
                        class="text-decoration-none   fw-bold  mt-3 p-3 left-sidebar" data-bs-toggle="tooltip"
                        data-bs-placement="right" title="Thêm cán bộ mới vào ban quản lý"><i
                            class="fa-solid fa-plus me-4"></i>Thêm cán
                        bộ</a>
                </p>
            </div>

        </div>
    </div>
</body>

</html>