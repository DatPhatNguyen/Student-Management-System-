<?php
function createCategory($imageName, $typeofUser, $path)
{
    echo '  
        <div class="col-sm-4 col-lg-4">
                <div class="card">
                    <img src="./template/images/' . $imageName . '" alt="" class="card-img-top"
                        style="width:100%;height:220px; object-fit:cover; ">
                    <div class="card-body">
                        <h5 class="card-title mt-2 mb-3 text-capitalize fw-bold">' . $typeofUser . '</h5>
                        <a href=' . $path . ' class="card-text">
                            <button class="btn btn-primary w-50  text-uppercase" style="font-weight:600;">Chọn</button>
                        </a>
                    </div>
                </div>
            </div>
        ';
}
function menuScore($learningScore, $trainingScore, $parentPath, $studentPath)
{
    echo '
    <h2 class="text-center row-space text-capitalize" style="font-weight:900;" id="menu">Tra cứu sinh viên</h2>
    <div class="container p-5 my-4 mx-auto"
    style="max-width:1200px;border-radius:40px; box-shadow: 30px 15px 2px #6c5ce7;background:#fff;">
    <h4 class="fw-bold" style="color:#000054; ; font-weight:900">Lựa chọn của bạn là gì ?</h4>
    <div class="row p-5">
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="card text-capitalize">
                <div class="card-header text-center" style="font-size:20px;color:#000054;font-weight:600">
                    ' . $learningScore . '
                </div>
                <div class="card-footer text-center">
                    <a href=' . $parentPath . ' class="text-decoration-none" style="font-size:18px">Xem thêm</a>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="card text-capitalize">
                <div class="card-header text-center" style="font-size:20px;color:#000054;font-weight:600">
                    ' . $trainingScore . '
                </div>
                <div class="card-footer text-center">
                    <a href=' . $studentPath . ' class="text-decoration-none" style="font-size:18px">Xem thêm</a>
                </div>
            </div>
        </div>
    </div>
</div>
    ';
}
function createSupportPage($studentImgPath, $parentImgPath, $studentPage, $parentPage, $studentPageDesc, $parentPageDesc)
{
    echo '
        <nav>
            <h2 class="text-center row-space text-capitalize" style="letter-spacing:2px;; font-weight:900" id="support">hỗ
                trợ
            </h2>
            <div class="container mt-4 mb-3 p-5"
                style="max-width:1200px; border-radius:40px;box-shadow:30px 15px 2px #00cec9;background:#fff;">
                <h4 style="color:#000054; font-weight:900;letter-spacing:1.5px; line-height:1.6;" class="mb-3">
                    Hệ thống hỗ
                    trợ của Đoàn khoa
                    Công Nghệ
                    Thông Tin - Trường
                    đại học Cần Thơ
                </h4>
                <h6 style="color:#000054;line-height:1.6; font-weight:600;">Đoàn khoa Công Nghệ Thông Tin luôn hỗ trợ
                    các bạn sinh
                    viên, quý phụ huynh
                    hết mình mọi thắc
                    mắc cũng như liên quan đến việc học. </h6>
                <div class="row p-4" style="max-width:1200px; margin: 0 auto;">
                    <div class="col-md-4 col-lg-4">
                        <div class="card">
                            <img src=' . $studentImgPath . ' alt="" class="card-img-top"
                                style="height:300px; width:100%;">
                            <div class="card-body p-2">
                                <h5 class="card-title text-capitalize mt-3 ms-2" style="color:#000054">Thông tin cho sinh
                                    viên
                                </h5>
                                <p class="card-text">
                                <ul class="list-group list-group-flush list-unstyled">
                                    <li class="list-group-item ">
                                        <a href="../student/signin.php" class="text-decoration-none"
                                            style="font-size:16px">Trang sinh viên</a>
                                    </li>
                                </ul>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-lg-4">
                        <div class="card">
                            <img src="../template/images/parent.jpg" alt="" class="card-img-top"
                                style="height:300px; width:100%;">
                            <div class="card-body p-2">
                                <h5 class="card-title text-capitalize mt-3 ms-2" style="color:#000054">Thông tin cho phụ
                                    huynh
                                </h5>
                                <p class="card-text">
                                <ul class="list-group list-group-flush list-unstyled">
                                    <li class="list-group-item "><a href="../parent/signin.php" class="text-decoration-none"
                                            style="font-size:16px">Trang phụ huynh</a></li>
                                </ul>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    ';
}
function createContactPage($websitePath, $facebookPath)
{
    echo '
    <h2 class="text-center row-space" style="letter-spacing:2px; ; font-weight:900 " id="contact">Liên Hệ</h2>
    <div class="container my-5 p-5"
        style="max-width:1200px;border-radius:40px; box-shadow: 30px 15px 2px #f39c12;background:#fff;">
        <h4 class="mb-4" style="color:#000054; ; font-weight:900">Liên hệ với chúng tôi:</h4>
        <div class="my-3 ms-3">
            <i class="fa-solid fa-earth-americas " style="color:#000054;font-size:20px;"></i>
            <a href="' . $websitePath . '" target="_blank" class="text-decoration-none ms-2"
                style="font-size:18px;color:#000; font-weight:900">
                Website </a>
        </div>
        <div class="ms-3">
            <i class="fa-brands fa-facebook" style="color:#000054;font-size:20px;"></i>
            <a href="' . $facebookPath . '" target="_blank" class="text-decoration-none ms-2"
                style="font-size:18px;color:#000;font-weight:900">Facebook</a>
        </div>
    </div>
    ';
}
function createBackGround($imagePath)
{
    echo '
    <div id="background" class="mt-5">
        <img src="' . $imagePath . '">
    </div>
    ';
}
function logOut()
{
    session_start();
    session_unset();
    session_destroy();
    header('location: ../category.php');
    exit();
}