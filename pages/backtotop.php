<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    include  "../script.php";
    ?>
</head>

<body>
    <div id="backtoTop">
        <a href="#top"><i class="fa-solid fa-arrow-up backtoTop"></i></a>
    </div>
</body>
<script type="text/javascript">
$(document).ready(function() {
    $("a[href='#top']").click(function() {
        $("html,body").animate({
            scrollTop: 0
        }, "slow");
        return false;
    })
})
</script>

</html>