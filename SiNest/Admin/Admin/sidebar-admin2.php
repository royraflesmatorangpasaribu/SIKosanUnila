<?php
$sql = mysqli_query($mysqli, "SELECT * FROM profiladmin");
$result = mysqli_fetch_assoc($sql);
?>

<style>
    .image-sidebar {
        background-color: #0081C5;
        width: 300px;
        height: 200px;
        margin-top: -20px;
        margin-left: -20px;
        padding: 10px;
    }

    .image-sidebar .nama-email .nama {
        text-transform: uppercase;
        color: white;
        font-weight: bold;
    }

    .image-sidebar .nama-email .email {
        color: white;
        opacity: 50%;
    }

    .hover-item {
        background-color: #7ECBFF;
    }

    /* CSS untuk layar desktop */
    @media (min-width: 768px) {
        .toggle-sidebar-btn {
            display: none;
            /* Menyembunyikan toggle-sidebar-btn di layar desktop */
        }
    }
</style>

<!-- ======= Header ======= -->
<header id="header" class="header fixed-top d-flex align-items-center" style="background-color: #7ECBFF;">

    <div class="d-flex align-items-center justify-content-between">
        <a href="index.html" class="logo d-flex align-items-center">
            <img src="../img/logosinest.png" alt="">
        </a>
        <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

</header><!-- End Header -->

<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <div class="image-sidebar">
        <img class="rounded-circle" src="../Pemilik/uploadimg/<?php echo $result['foto']; ?>" alt="" style="width: 100px;"><br><br>

        <div class="nama-email">
            <span class="nama"><?php echo $result['nama_admin']; ?></span><br>
            <span class="email"><?php echo $result['email']; ?></span>
        </div>
    </div>

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-heading"><strong>MENU ADMINISTRATOR</strong></li><br>

        <li class="nav-item">
            <a class="nav-link " href="home-admin.php">
                <img src="../iconsinest/dashboardicon.svg" alt="" style="padding-right: 10px;">
                <span>Dashboard</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link " href="data-transaksi.php">
                <img src="../iconsinest/datatransactionicon.svg" alt="" style="padding-right: 10px;">
                <span>Mengambil Data Transaksi</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link " href="../SESSION-Login/logout.php">
                <img src="../iconsinest/logouticon.svg" alt="" style="padding-right: 10px;">
                <span style="color: #FF0000">Logout</span>
            </a>
        </li>



    </ul>
</aside><!-- End Sidebar-->