<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include "../script.php"; ?>
    <style>
    .container-fluid {
        padding: 12px;
    }

    #active {
        color: #fff;
        background: #f1c40f;
        border-radius: 40px;
        transition: .4s ease-in-out;
    }

    #active:hover {
        color: #fff;
        background: #000;
    }
    </style>
</head>

<body>
    <header class="header">
        <div class="container-fluid shadow">
            <div class=" d-flex justify-content-between align-items-center mx-5">
                <div>
                    <a href="index.php" class="text-decoration-none">
                        <img src='../template/images/logo-agu.png' class=" d-inline-block"
                            alt="Logo trường đại học An Giang" style="width:100px; height:auto;">
                        <span class="text-capitalize d-inline-block p-3" id="active"
                            style="font-size:20px; font-weight:900;line-height:20px; ">
                            Trang Chủ</span>
                    </a>


                </div>
                <?php echo isset($_SESSION['admin'])
                    ?
                    '<div class="pt-1 mt-1">
                    <p class="me-3" style="font-weight:700; font-size:18px; display:inline-block">' . $_SESSION['admin'] . '</p>
                    <button type="submit" class=" border btn btn-danger py-2 px-4 text-center ">
                        <a href="../pages/logout.php" class="text-white text-decoration-none text-capitalize text-button">Đăng xuất</a>
                    </button>
                </div>'
                    : ' <div class="pt-1">
                <button type="submit" class=" border btn btn-danger py-2 px-4 text-center ms-3 ">
                    <a href="signin.php" class="text-white text-decoration-none text-capitalize text-button">Đăng
                        nhập</a>    
                </button>
            </div>';
                ?>
            </div>
        </div>
    </header>





</body>

</html>