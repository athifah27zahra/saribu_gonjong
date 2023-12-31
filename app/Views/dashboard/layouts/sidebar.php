<?php
$uri = service('uri')->getSegments();
$uri1 = $uri[1] ?? 'index';
$uri2 = $uri[2] ?? '';
$uri3 = $uri[3] ?? '';
?>

<div id="sidebar" class="active">
    <div class="sidebar-wrapper active">
        <!-- Sidebar Header -->
        <?= $this->include('web/layouts/sidebar_header'); ?>
        
        <!-- Sidebar -->
        <div class="sidebar-menu">
            <div class="d-flex flex-column">
                <div class="d-flex justify-content-center avatar avatar-xl me-3" id="avatar-sidebar">
                    <img src="<?= base_url('media/photos/sarugo.png'); ?>" alt="" srcset="">
                </div>
                <?php if (logged_in()): ?>
                    <div class="p-2 text-center">
                        <?php if (!empty(user()->first_name)): ?>
                            Hello, <span class="fw-bold"><?= user()->first_name; ?><?= (!empty(user()->last_name)) ? ' ' . user()->last_name : ''; ?></span> <br> <span class="text-muted mb-0">@<?= user()->username; ?></span>
                        <?php else: ?>
                            Hello, <span class="fw-bold">@<?= user()->username; ?></span>
                        <?php endif; ?>
                    </div>
                <?php else: ?>
                    <div class="p-2 d-flex justify-content-center">Hello, Visitor</div>
                <?php endif; ?>
                <ul class="menu">
                    <li class="sidebar-item">
                        <a href="<?= base_url('web'); ?>" class="sidebar-link">
                            <i class="fa-solid fa-house"></i><span> Home</span>
                        </a>
                    </li>

                    <!-- Manage RG -->
                    <?php if (in_groups(['admin'])): ?>
                    <li class="sidebar-item <?= ($uri1 == 'rumahGadang') ? 'active' : '' ?>">
                        <a href="<?= base_url('dashboard/rumahGadang'); ?>" class="sidebar-link">
                            <i class="fa-solid fa-campground"></i><span> Rumah Gadang</span>
                        </a>
                    </li>
                    <?php endif; ?>

                    <!-- Manage TP -->
                    <?php if (in_groups(['admin'])): ?>
                    <li class="sidebar-item <?= ($uri1 == 'tourismPackage') ? 'active' : '' ?>">
                        <a href="<?= base_url('dashboard/tourismPackage'); ?>" class="sidebar-link">
                            <i class="fa-solid fa-box"></i><span> Tourism Package</span>
                        </a>
                    </li>
                    <?php endif; ?>

                    <!-- Manage TP -->
                    <?php if (in_groups(['admin'])): ?>
                    <li class="sidebar-item <?= ($uri1 == 'myBooking') ? 'active' : '' ?>">
                        <a href="<?= base_url('dashboard/myBooking'); ?>" class="sidebar-link">
                            <i class="fa-solid fa-receipt"></i><span>  Booking Package</span>
                        </a>
                    </li>
                    <?php endif; ?>

                    <!-- Manage Facility -->
                    <?php if (in_groups(['admin'])): ?>
                    <li class="sidebar-item <?= ($uri1 == 'facilityRumahGadang') ? 'active' : '' ?>">
                        <a href="<?= base_url('dashboard/facilityRumahGadang'); ?>" class="sidebar-link">
                            <i class="fa-solid fa-house-circle-check"></i><span> Facility Rumah Gadang</span>
                        </a>
                    </li>
                    <?php endif; ?>

                    

                    <!-- Manage Facility -->
                    <?php if (in_groups(['admin'])): ?>
                    <li class="sidebar-item <?= ($uri1 == 'facilityTourismPackage') ? 'active' : '' ?>">
                        <a href="<?= base_url('dashboard/facilityTourismPackage'); ?>" class="sidebar-link">
                            <i class="fa-solid fa-bell-concierge"></i><span> Service Tourism Package</span>
                        </a>
                    </li>
                    <?php endif; ?>

                    <!-- Manage Recommendation -->
                    <?php if (in_groups(['admin'])): ?>
                    <li class="sidebar-item <?= ($uri1 == 'recommendation') ? 'active' : '' ?>">
                        <a href="<?= base_url('dashboard/recommendation'); ?>" class="sidebar-link">
                            <i class="fa-solid fa-star"></i><span> Recommendation</span>
                        </a>
                    </li>
                    <?php endif; ?>
                    
                    <?php if (in_groups(['admin'])): ?>
                    <li class="sidebar-item <?= ($uri1 == '') ? 'active' : '' ?> has-sub">
                        <a href="" class="sidebar-link">
                            <i class="fa-solid fa-grip"></i><span>Supporting Objects</span>
                        </a>

                        <ul class="submenu <?= ($uri1 == '') ? 'active' : '' ?>">

                        <ul class="submenu-item <?= ($uri1 == 'worshipPlace') ? 'active' : '' ?>">
                            <a href="<?= base_url('dashboard/worshipPlace'); ?>" >
                                <i class="fa-solid fa-place-of-worship"></i><span> Worship Place</span>
                            </a>
                        </ul>
                    
                        <ul class="submenu-item <?= ($uri1 == 'umkmPlace') ? 'active' : '' ?>">
                            <a href="<?= base_url('dashboard/umkmPlace'); ?>">
                                <i class="fa-solid fa-shop"></i><span> UMKM Place</span>
                            </a>
                        </ul>

                        <ul class="submenu-item <?= ($uri1 == 'souvenirPlace') ? 'active' : '' ?>">
                            <a href="<?= base_url('dashboard/souvenirPlace'); ?>">
                                <i class="fa-solid fa-gift"></i><span> Souvenir Place</span>
                            </a>
                        </ul>

                        <ul class="submenu-item <?= ($uri1 == 'historyPlace') ? 'active' : '' ?>">
                            <a href="<?= base_url('dashboard/historyPlace'); ?>">
                                <i class="fa-solid fa-monument"></i><span> History Place</span>
                            </a>
                        </ul>

                        <ul class="submenu-item <?= ($uri1 == 'tourismObject') ? 'active' : '' ?>">
                            <a href="<?= base_url('dashboard/tourismObject'); ?>">
                                <i class="fa-solid fa-map-location-dot"></i><span> Tourism Object</span>
                            </a>
                        </ul>

                        <ul class="submenu-item <?= ($uri1 == 'packageActivities') ? 'active' : '' ?>">
                            <a href="<?= base_url('dashboard/packageActivities'); ?>">
                                <i class="fa-solid fa-street-view"></i><span> Tourism Activity</span>
                            </a>
                        </ul>

                        <ul class="submenu-item <?= ($uri1 == 'study') ? 'active' : '' ?>">
                            <a href="<?= base_url('dashboard/study'); ?>">
                                <i class="fa-brands fa-leanpub"></i><span> Study Place</span>
                            </a>
                        </ul>

                        </ul>
                    </li>
                    <?php endif; ?>

                    <!-- Manage Users -->
                    <?php if (in_groups(['admin'])): ?>
                    <li class="sidebar-item <?= ($uri1 == 'users') ? 'active' : '' ?>">
                        <a href="<?= base_url('dashboard/users'); ?>" class="sidebar-link">
                            <i class="fa-solid fa-users"></i><span> Users</span>
                        </a>
                    </li>
                    <?php endif; ?>
                </ul>
            </div>
        
        </div>
    </div>
</div>