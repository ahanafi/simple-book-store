<?php
$index = "";
$book = "";
$category = "";
$user = "";

if($page == "") {
    $index = "active";
} elseif($page == "book") {
    $book = "active";
} elseif($page == "category") {
    $category = "active";
} elseif($page == "user-management" || $page == "user") {
    $user = "active";
}

?>
<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar" style="position: fixed;">
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('dashboard'); ?>">
        <!-- <div class="sidebar-brand-icon rotate-n-15">
        </div> -->
        <div class="sidebar-brand-icon" style="text-align: left;">
            <img src="<?= base_url('assets/img/books.svg') ?>" alt="Logo" style="width: 60%;">
        </div>
        <div class="sidebar-brand-text mx-3" style="font-size: 18px;">Book Store</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item <?= $index; ?>">
        <a class="nav-link" href="<?php echo base_url("dashboard") ?>">
            <i class="fas fa-fw fa-home"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">
    <!-- Heading -->
    <div class="sidebar-heading">
        Data
    </div>
    
    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item <?php echo $book; ?>">
        <a class="nav-link" href="<?php echo base_url("book") ?>">
            <i class="fas fa-fw fa-book"></i>
            <span>Book List</span>
        </a>
    </li>
    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item <?php echo $category; ?>">
        <a class="nav-link" href="<?php echo base_url("category") ?>">
            <i class="fas fa-fw fa-list"></i>
            <span>Category</span>
        </a>
    </li>
    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item <?php echo $user; ?>">
        <a class="nav-link" href="<?php echo base_url("user-management") ?>">
            <i class="fas fa-fw fa-users"></i>
            <span>User Management</span>
        </a>
    </li>
    <hr class="sidebar-divider">
    <li class="nav-item">
        <a class="nav-link" href="#" onclick="askForLogout()">
            <i class="fas fa-fw fa-power-off"></i>
            <span>Logout</span>
        </a>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
    <form id="logout-form" action="<?= base_url("sign-out") ?>" method="POST">
        <input type="hidden" name="logout" value="true">
    </form>
</ul>
<!-- End of Sidebar -->