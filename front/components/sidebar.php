<link rel="stylesheet" href="../css/sidebar.css">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link
    href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap"
    rel="stylesheet">

<div class="sidebar" id="sidebar">
    <i style="font-size:16px" id="logo" alt="">Yuki Makmur</i>

    <a id="dashboard" href="?menu=dashboard">
        <i class="gambar" data-feather="home"></i>
        <span>Dashboard</span>
    </a>

    <a href="?menu=inventory" id="inventory">
        <i class="gambar" data-feather="database"></i>
        <span>Inventory</span>
    </a>

    <a href="?menu=hargaBarangKeluarDalamKota" id="hargaBarangKeluarDalamKota">
        <i class="gambar" data-feather="package"></i>
        <span>Product Price (Inside)</span>
    </a>
    <a href="?menu=hargaBarangKeluarLuarKota" id="hargaBarangKeluarLuarKota">
        <i class="gambar" data-feather="package"></i>
        <span>Product Price (Outside)</span>
    </a>

    <a href="?menu=toko" id="toko">
        <img src="../assets/store.png" width="30px" alt="">
        <span>Store</span>
    </a>

    <a href="?menu=vendor" id="vendor">
        <img src="../assets/vendor.png" width="30px" alt="">
        <span>Vendor</span>
    </a>

    <a id="stokin" href="?menu=stokin">
        <i class="gambar" data-feather="shopping-cart"></i>
        <span>Stock In</span>
    </a>

    <!-- <div id="stokout" href="?menu=stokout">
        <span style="color:white">Stok Out</span>
    </div> -->

    <a id="stokoutgeneral" href="?menu=stokoutgeneral">
        <img src="../assets/stokout.png" width="30px" alt="">
        <span style="text-align:center">Stock Out General</span>
    </a>

    <a id="stokouttoko" href="?menu=stokouttoko">
        <img src="../assets/stokout.png" width="30px" alt="">
        <span style="text-align:center">Stock Out Store</span>
    </a>

    <a id="reportstockin" href="?menu=reportstockin">
        <img src="../assets/report.png" width="30px" alt="">
        <span>Stock In Report</span>
    </a>

    <a id="reportstockout" href="?menu=reportstockout">
        <img src="../assets/report.png" width="30px" alt="">
        <span>Stock Out Report</span>
    </a>

    <a id="user" href="?menu=user">
        <i class="gambar" data-feather="user"></i>
        <span>User</span>
    </a>

    <a id="logout" href="?menu=logout">
        <i class="gambar" data-feather="log-out"></i>
        <span>Logout</span>
    </a>
</div>

<script>
const menus = document.querySelectorAll(".sidebar > a");

const params = new URLSearchParams(window.location.search);
const currentMenu = params.get('menu') || 'dashboard';

menus.forEach(link => {
    const hrefMenu = link.getAttribute('href').split('menu=')[1];

    if (hrefMenu === currentMenu) {
        link.classList.add('active');
    }

    link.addEventListener("click", (e) => {
        menus.forEach(menu => menu.classList.remove('active'));
        e.currentTarget.classList.add('active');
    });
});
</script>

<script src="https://unpkg.com/feather-icons">
</script>

<script>
feather.replace();
</script>
</script>