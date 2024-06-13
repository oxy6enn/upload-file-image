<!-- Active Menu -->
<?php $page = substr($_SERVER['SCRIPT_NAME'], strrpos($_SERVER['SCRIPT_NAME'],"/")+1); ?>

<!-- Layout container -->
<div class="layout-page">

    <!-- Navbar -->
    <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
        id="layout-navbar">

        <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0   d-xl-none ">
            <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                <i class="bx bx-menu bx-sm"></i>
            </a>
        </div>

        <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">


            <!-- Search -->
            <div class="navbar-nav align-items-center">
                <div class="nav-item d-flex align-items-center">
                    <i class="bx bx-search fs-4 lh-0"></i>
                    <input type="text" class="form-control border-0 shadow-none ps-1 ps-sm-2" placeholder="Search..."
                        aria-label="Search...">
                </div>
            </div>
            <!-- /Search -->

            <!-- notifications -->
            <ul class="navbar-nav flex-row align-items-center ms-auto">

                <li class="nav-item dropdown-notifications navbar-dropdown dropdown me-3 me-xl-1">
                    <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown"
                        data-bs-auto-close="outside" aria-expanded="false">
                        <i class="bx bx-bell bx-sm"></i>
                        <span class="badge bg-danger rounded-pill badge-notifications">1</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end py-0">
                        <li class="dropdown-menu-header border-bottom">
                            <div class="dropdown-header d-flex align-items-center py-3">
                                <h5 class="text-body mb-0 me-auto">Notification</h5>
                                <a href="javascript:void(0)" class="dropdown-notifications-all text-body"
                                    data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Mark all as read"
                                    data-bs-original-title="Mark all as read"><i
                                        class="bx fs-4 bx-envelope-open"></i></a>
                            </div>
                        </li>
                        <li class="dropdown-notifications-list scrollable-container ps">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item list-group-item-action dropdown-notifications-item">
                                    <div class="d-flex">
                                        <div class="flex-shrink-0 me-3">
                                            <div class="avatar">
                                                <img src="../assets/img/avatars/1.png" alt=""
                                                    class="w-px-40 h-auto rounded-circle">
                                            </div>
                                        </div>
                                        <div class="flex-grow-1">
                                            <h6 class="mb-1">Congratulation Lettie 🎉</h6>
                                            <p class="mb-">Won the monthly best seller gold badge</p>
                                            <small class="text-muted">1h ago</small>
                                        </div>
                                        <div class="flex-shrink-0 dropdown-notifications-actions">
                                            <!-- <a href="javascript:void(0)" class="dropdown-notifications-read"><span class="badge badge-dot"></span></a> -->
                                            <!-- <a href="javascript:void(0)" class="dropdown-notifications-archive"><span class="bx bx-x"></span></a> -->
                                        </div>
                                    </div>
                            </ul>
                            <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
                                <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
                            </div>
                            <div class="ps__rail-y" style="top: 0px; right: 0px;">
                                <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div>
                            </div>
                        </li>
                        <li class="dropdown-menu-footer border-top p-3">
                        </li>
                    </ul>
                </li>
                <!--/ notifications -->





               


                <!-- User -->
                <li class="nav-item navbar-dropdown dropdown-user dropdown mx-2">
                    <a class="dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                        <div class="avatar avatar-online">
                            <span
                                class="avatar-initial rounded-circle bg-label-primary">US</span>
                        </div>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a class="dropdown-item" href="#">
                                    <div class="d-flex">
                                        <div class="flex-shrink-0 me-3">
                                            <div class="avatar avatar-online">
                                                <span
                                                    class="avatar-initial rounded-circle bg-label-primary"><span class="fw-medium d-block">US</span></span>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1">
                                            <span class="fw-medium d-block">User</span>
                                            <small class="text-muted">Admin</small>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <div class="dropdown-divider"></div>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                    data-bs-target="#largeModal_profile">
                                    <i class="bx bx-user me-2"></i>
                                    <span class="align-middle">โปรไฟล์</span>
                                </a>

                            </li>
                            <li>
                                <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                    data-bs-target="#largeModal_charge_password">
                                    <i class="bx bx-lock-open-alt me-2"></i>
                                    <span class="align-middle">เปลี่ยนรหัสผ่าน</span>
                                </a>
                            </li>
                            <div class="dropdown-divider"></div>

                            <li>
                                <a class="dropdown-item" href="#" id="log_out" data-id="#">
                                    <i class="bx bx-power-off me-2"></i>
                                    <span class="align-middle">ออกจากระบบ</span>
                                </a>
                            </li>
                        </ul>
                </li>
                <!--/ User -->


            </ul>
        </div>
    </nav>
    <!-- / Navbar -->




    <!-- Menu -->

    <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">


        <div class="app-brand demo ">
            <a href="index.php" class="app-brand-link">
                <span class="app-brand-logo demo">

                    <!-- <i class="fa-solid fa-network-wired " style="color: #696cff; font-size: 40px;"></i> -->

                </span>
                <span class="text-body fw-bold fs-4 ms-2">Upload File Image</span>
            </a>

            <a href="../staff/index.php" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
                <i class="bx bx-chevron-left bx-sm align-middle"></i>
            </a>
        </div>

        <div class="menu-inner-shadow"></div>



        <ul class="menu-inner py-1">

            <!-- Dashboard -->
            <li class="menu-item <?= $page == "index.php" || $page == "index_edit.php" ? 'active':''; ?>">
                <a href="index.php" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-home-circle"></i>
                    <div data-i18n="Analytics">แดชบอร์ด</div>
                </a>
            </li>

            <li class="menu-header small text-uppercase">
                <span class="menu-header-text">Main</span>
            </li>
       
            <!-- News -->
            <li class="menu-item <?= $page == "news.php" || $page == "news_edit.php" ? 'active':''; ?>">
                <a href="news.php" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-news"></i>
                    <div data-i18n="Analytics">ข่าว/ประกาศ</div>
                </a>
            </li>
  

            <li class="menu-header small text-uppercase">
                <span class="menu-header-text">Seting</span>
            </li>

    
    </aside>
    <!-- / Menu -->