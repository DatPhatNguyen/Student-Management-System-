<!DOCTYPE html>
<html lang="en">

</html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include "../script.php"; ?>
</head>

<body>
    <header class="header" id="header" style="background:#fff;">
        <div class="container-fluid mx-auto shadow header-container" id="top">
            <div class=" d-flex justify-content-between  align-items-center mx-5">
                <!-- index logo -->
                <div>
                    <a href='index.php'><img src='../template/images/logo-ctu.png' class='d-inline-block'
                            style='width:60px; height:auto;'></a>
                </div>
                <!-- header / navigate   -->
                <a href="index.php" class="text-capitalize text-success text-decoration-none active ms-3">Trang
                    chủ</a>
                <a href="#about" class="text-decoration-none text-capitalize header-link">Giới thiệu</a>
                <a href="#menu" class="text-decoration-none text-capitalize header-link">Tra Cứu Sinh Viên</a>
                <a href="#contact" class="text-decoration-none text-capitalize header-link">Liên
                    hệ</a>
                <!-- Signin / signup -->
                <?php echo isset($_SESSION['parent'])
                    ?
                    '<div class="pt-1 mt-1">
                    <p class="me-3" style="font-weight:700; font-size:18px; display:inline-block">' . $_SESSION['parent'] . '</p>
                    <button type="submit" class=" border btn btn-danger py-2 px-4 text-center ">
                        <a href="../pages/logout.php?action="logout"" class="text-white text-decoration-none text-capitalize text-button">Đăng xuất</a>
                    </button>
                </div>'
                    : ' <div class="pt-1">
                        <button type="submit" class=" border btn btn-primary py-2 px-4 text-center ">
                            <a href="signup.php" class="text-white text-decoration-none text-capitalize text-button">Đăng
                                ký</a>
                        </button>
                        <button type="submit" class=" border btn btn-danger py-2 px-4 text-center ms-3 ">
                            <a href="signin.php" class="text-white text-decoration-none text-capitalize text-button">Đăng
                                nhập</a>    
                        </button>
                    </div>';
                ?>
                <?php
                include_once "receiveMessage.php"
                ?>
            </div>
        </div>
    </header>
</body>

</html>