<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('admin/') ?>">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Kimi Petshop</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="<?= base_url('dashboard.php') ?>">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Menu
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <!-- <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-image"></i>
                    <span>Twibbon</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Custom Components:</h6>
                        <a class="collapse-item" href="buttons.html">Buttons</a>
                        <a class="collapse-item" href="cards.html">Cards</a>
                    </div>
                </div>
            </li> -->

            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('admin/manage_barang.php') ?>">
                    <i class="fas fa-fw fa-cart-plus"></i>
                    <span>Manage Barang</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('admin/manage_gambar.php') ?>">
                    <i class="fas fa-fw fa-image"></i>
                    <span>Manage Gambar</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('admin/manage_kategori.php') ?>">
                    <i class="fas fa-fw fa-info"></i>
                    <span>Manage Kategori</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('admin/manage_pesanan.php') ?>">
                    <i class="fas fa-fw fa-book"></i>
                    <span>Manage Pesanan</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('admin/manage_user.php') ?>">
                    <i class="fas fa-fw fa-users"></i>
                    <span>Manage Users</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('admin/manage_web.php') ?>">
                    <i class="fas fa-fw fa-home"></i>
                    <span>Manage Website</span></a>
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
            <!-- <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Utilities</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Custom Utilities:</h6>
                        <a class="collapse-item" href="utilities-color.html">Colors</a>
                        <a class="collapse-item" href="utilities-border.html">Borders</a>
                        <a class="collapse-item" href="utilities-animation.html">Animations</a>
                        <a class="collapse-item" href="utilities-other.html">Other</a>
                    </div>
                </div>
            </li> -->

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

            <!-- Sidebar Message -->
            <!-- <div class="sidebar-card">
                <img class="sidebar-card-illustration mb-2" src="img/undraw_rocket.svg" alt="">
                <p class="text-center mb-2"><strong>SB Admin Pro</strong> is packed with premium features, components, and more!</p>
                <a class="btn btn-success btn-sm" href="https://startbootstrap.com/theme/sb-admin-pro">Upgrade to Pro!</a>
            </div>
 -->
        </ul>