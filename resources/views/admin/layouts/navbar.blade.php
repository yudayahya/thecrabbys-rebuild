<aside class="main-sidebar sidebar-light-info elevation-4">
    <!-- Brand Logo -->
    <a href="/admin/dashboard" class="brand-link">
        <img src="{{ asset('assets/logo/logo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">The Crabbys</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('assets/admin/image_admin/' . auth()->user()->image) }}"
                    class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="/admin/my-profile" class="d-block">{{ auth()->user()->name }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column nav-flat" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item">
                    <a href="/admin/dashboard"
                        class="nav-link {{ request()->is('admin/dashboard') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                @if (auth()->user()->level == 'owner')
                    <li class="nav-item">
                        <a href="/admin/manage-admin"
                            class="nav-link {{ request()->is('admin/manage-admin') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-user-tie"></i>
                            <p>
                                List Admin
                            </p>
                        </a>
                    </li>
                @endif
                <li class="nav-item">
                    <a href="pages/calendar.html" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            List Member
                        </p>
                    </a>
                </li>
                <li class="nav-header">MASTER DATA</li>
                <li class="nav-item">
                    <a href="/admin/product" class="nav-link {{ request()->is('admin/product') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-utensils"></i>
                        <p>
                            Produk
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/admin/category" class="nav-link {{ request()->is('admin/category') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-layer-group"></i>
                        <p>
                            Kategori
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/admin/variant" class="nav-link {{ request()->is('admin/variant') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-wine-bottle"></i>
                        <p>
                            Varian Saos
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="pages/kanban.html" class="nav-link">
                        <i class="nav-icon fas fa-tags"></i>
                        <p>
                            Voucher
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="pages/kanban.html" class="nav-link">
                        <i class="nav-icon fas fa-image"></i>
                        <p>
                            Banner
                        </p>
                    </a>
                </li>
                <li class="nav-header">CUSTOMER SERVICE</li>
                <li class="nav-item">
                    <a href="iframe.html" class="nav-link">
                        <i class="nav-icon far fa-comments"></i>
                        <p>Live Chat</p>
                        <span class="badge badge-danger right">2</span>
                    </a>
                </li>
                <li class="nav-header">TRANSACTION DATA</li>
                <li class="nav-item menu-open">
                    <a href="#" class="nav-link active">
                        <i class="nav-icon fas fa-money-check-alt"></i>
                        <p>
                            Data Transaksi
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="./index.html" class="nav-link active">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Konfirmasi Dapur</p>
                                <span class="badge badge-danger right">2</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="./index2.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Pending Bayar</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="./index3.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Memasak</p>
                                <span class="badge badge-danger right">2</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="./index3.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Mengirim</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="./index3.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Selesai</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="./index3.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Expired</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="iframe.html" class="nav-link">
                        <i class="nav-icon fas fa-file-invoice-dollar"></i>
                        <p>Laporan Transaksi</p>
                    </a>
                </li>
                <li class="nav-header">SETTINGS</li>
                <li class="nav-item">
                    <a href="/admin/my-profile"
                        class="nav-link {{ request()->is('admin/my-profile') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-user-cog"></i>
                        <p class="text">My Profile</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.logout') }}" class="nav-link">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>Sign Out</p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
