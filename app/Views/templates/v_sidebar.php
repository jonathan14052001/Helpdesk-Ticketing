       <!-- Sidebar -->
       <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url(); ?>">
    <div class="sidebar-brand-text mx-3">
        <img src="/assets/img/profile/logo.png" width="37.2 px" height="23.8 px">
    </div>
</a>


<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Nav Item - Dashboard -->
<li class="nav-item">
    <a class="nav-link" href="<?= base_url(); ?>">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
</li>

<?php if( in_groups('admin')) : ?>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
    User Management
</div>

<!-- Nav Item - User List -->
<li class="nav-item">
    <a class="nav-link " href="<?= base_url('admin');?>">
        <i class="fas fa-users"></i>
        <span>User List</span>
    </a>
</li>

<li class="nav-item">
    <a class="nav-link " href="<?= base_url('company');?>">
        <i class="fas fa-building"></i>
        <span>Company</span>
    </a>
</li>

<li class="nav-item">
    <a class="nav-link " href="<?= base_url('pic');?>">
        <i class="fas fa-user"></i>
        <span>PIC</span>
    </a>
</li>

<?php endif; ?>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
    List
</div>

<!-- Nav Item - Pages Ticketing (List) -->
<li class="nav-item">
    <a class="nav-link collapsed" href="<?= base_url('ticket');?>">
        <i class="fas fa-fw fa-address-card"></i>
        <span>Ticketing</span>
    </a>
</li>

<li class="nav-item">
    <a class="nav-link collapsed" href="<?= base_url('progress');?>">
        <i class="fas fa-fw fa-battery-half"></i>
        <span>Progress</span>
    </a>
</li>

<!-- Divider -->
<hr class="sidebar-divider d-none d-md-block">

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>

</ul>
<!-- End of Sidebar -->