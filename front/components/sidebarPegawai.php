<link rel="stylesheet" href="../css/sidebar.css">

<link rel="stylesheet" href="../css/sidebar.css">


<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link
    href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap"
    rel="stylesheet">

<div class="sidebar" id="sidebar">
    <i style="font-size:16px" id="logo" alt="">Yuki Makmur</i>
    <!-- <a id="dashboard" href="?menu=dashboard">
        <span>Dashboard</span>
    </a>

    <a href="?menu=inventory" id="inventory">
        <span>Inventory</span>
    </a>

    <a href="?menu=vendor" id="vendor">
        <span>Vendor</span>
    </a>

    <a id="stokin" href="?menu=stokin">
        <span>Stok In</span>
    </a> -->

    <a id="stokoutgeneral" href="?menu=stokoutgeneral">
        <img src="../assets/stokout.png" width="30px" alt="">
        <span style="text-align:center">Stock Out General</span>
    </a>

    <a id="stokouttoko" href="?menu=stokouttoko">
        <img src="../assets/stokout.png" width="30px" alt="">
        <span style="text-align:center">Stock Out Toko</span>
    </a>

    <!-- <a id="reports" href="?menu=reports">
        <span>Reports</span>
    </a>

    <a id="user" href="?menu=user">
        <span>User</span>
    </a> -->

    <a id="logout" href="?menu=logout">
        <i data-feather="log-out"></i>
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