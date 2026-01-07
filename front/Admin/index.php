<?php
require("../../backend/utils/Utils.php");

session_start();

if (!$_SESSION["login"]) {
    header("Location:../login.php");
}

if (isset($_GET["menu"])) {
    $menu = $_GET["menu"];


    switch ($menu) {
        case "dashboard":
            $page = "../pages/dashboard.php";
            break;
        case "inventory":
            $page = "../pages/inventory.php";
            break;
        case "hargaBarangKeluarDalamKota":
            $page = "../pages/hargaBarangKeluarDalamKota.php";
            break;
        case "hargaBarangKeluarLuarKota":
            $page = "../pages/hargaBarangKeluarLuarKota.php";
            break;
        case "toko":
            $page = "../pages/toko.php";
            break;
        case "vendor":
            $page = "../pages/vendor.php";
            break;
        case "stokin":
            $page = "../pages/stokin.php";
            break;
        case "stokoutgeneral":
            $page = "../pages/stokOutGeneral.php";
            break;
        case "stokouttoko":
            $page = "../pages/stokOutToko.php";
            break;
        case "reportstockin":
            $page = "../pages/reportStockIn.php";
            break;
        case "reportstockout":
            $page = "../pages/reportStockOut.php";
            break;
        case "user":
            $page = "../pages/user.php";
            break;
        case "logout":
            $page = "../logout.php";
            break;
    }
}else{
    $page = "../pages/dashboard.php";
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ARA Store</title>
    <link rel="stylesheet" href="../css/main.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap"
        rel="stylesheet">

    <style>
    #pageContainer {
        opacity: 1;
        animation-name: fadeInOpacity;
        animation-iteration-count: 1;
        animation-timing-function: ease-in;
        animation-duration: 0.1s;
    }

    @keyframes fadeInOpacity {
        0% {
            opacity: 0;
        }

        100% {
            opacity: 1;
        }
    }

    .gradient-text {
        background: linear-gradient(to right, black, burlywood);

        /* Standard property */
        background-clip: text;

        /* Vendor prefixes */
        -webkit-background-clip: text;
        -moz-background-clip: text;

        /* Required to make text transparent */
        color: transparent;
        -webkit-text-fill-color: transparent;
    }
    </style>
</head>

<body>
    <?php include("../components/sidebar.php"); ?>

    <?php if (isset($menu)): ?>

    <div id="pageContainer" style="margin-left:22%;margin-top:2%;">
        <span>Hi, <span class="gradient-text"
                style="font-weight:bold"><?php echo $_SESSION["username"] . " " . $_SESSION["name"];?></span></span>
        <br></br>
        <?php include($page); ?>
    </div>

    <?php else:?>

    <div id="pageContainer" style="margin-left:22%;margin-top:2%;">
        <span>Hi, <span class="gradient-text"
                style="font-weight:bold"><?php echo $_SESSION["username"] . " " . $_SESSION["name"];?></span></span>
        <br></br>
        <?php include($page); ?>
    </div>

    <?php endif; ?>

    <!-- <div class="elfie">

    </div> -->

</body>

</html>