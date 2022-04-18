<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>جهتك</title>
    <link rel="favicon" type="image/png" href="<?php echo URL; ?>public/images/favicon.png"/>

    <!-- bootstrap-rtl -->
    <link rel="stylesheet" href="<?php echo URL; ?>public/css/bootstrap.rtl.css"/>
    <link rel="stylesheet" href="<?php echo URL; ?>public/css/bootstrap-icons/bootstrap-icons.css">

    <!-- site css -->
    <link rel="stylesheet" href="<?php echo URL; ?>public/css/style.css">
    <link rel="stylesheet" href="<?php echo URL; ?>public/css/app.rtl.css"/>

    <!-- font -->
    <link href="https://fonts.googleapis.com/css2?family=El+Messiri&display=swap" rel="stylesheet">
</head>

<body>

<div id="app">

    <div id="sidebar" class="<?php if (isset($page)) {
                                if ($page != 'homepage') {
                                    echo 'active';
                                }
                            } ?>">
        <div class="sidebar-wrapper active">
            <div class="sidebar-header">
                <div class="d-flex justify-content-between">
                    <div class="logo">
                        <a href="<?php echo URL; ?>"><img class="w-100 h-100"
                                                          src="<?php echo URL; ?>public/images/logo/logo.png" alt="Logo"
                                                          srcset=""></a>
                    </div>
                    <div class="toggler">
                        <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                    </div>
                </div>
            </div>

            <div class="sidebar-menu">
                <ul class="menu">
                    <li class="sidebar-title">القائمة</li>

                    <li class="sidebar-item  ">
                        <a class="sidebar-link" style="<?php if (isset($page)) {
                            if ($page == 'homepage') echo 'background-color:#3f54918c;';
                        } ?>" href="<?php echo URL; ?>">
                            <i class="bi bi-grid-fill"></i>
                            <span>الصفحة الرئيسية</span>
                        </a>
                    </li>

                    <li class="sidebar-item  ">
                        <a class="sidebar-link" style="<?php if (isset($page)) {
                            if ($page == 'supervisors') echo 'background-color:#3f54918c;';
                        } ?>" href="<?php echo URL; ?>home/supervisors">
                            <i class="bi bi-grid-fill"></i>
                            <span>المشرفين</span>
                        </a>
                    </li>

                    <li class="sidebar-item  ">
                        <a class="sidebar-link" style="<?php if (isset($page)) {
                            if ($page == 'companies') echo 'background-color:#3f54918c;';
                        } ?>" href="<?php echo URL; ?>home/companies">
                            <i class="bi bi-grid-fill"></i>
                            <span>جهات التدريب</span>
                        </a>
                    </li>

                    <li class="sidebar-item ">
                        <a class="sidebar-link" style="<?php if (isset($page)) {
                            if ($page == 'students') echo 'background-color:#3f54918c;';
                        } ?>" href="<?php echo URL; ?>home/students">
                            <i class="bi bi-grid-fill"></i>
                            <span>جميع الطلاب</span>
                        </a>
                    </li>

                </ul>
            </div>
        </div>
    </div>

    <div id="main" class='layout-navbar'>
        <header class='mb-3'>
            <nav class="navbar navbar-expand navbar-light ">
                <div class="container-fluid">
                    <a href="#" class="burger-btn d-block">
                        <i class="bi bi-justify fs-3 text-black"></i>
                    </a>

                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                            <li class="nav-item dropdown me-1">
                                <a class="nav-link active dropdown-toggle" href="#" data-bs-toggle="dropdown"
                                   aria-expanded="false">
                                    <i class='bi bi-envelope bi-sub fs-4 text-black'></i>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                                    <li>
                                        <h6 class="dropdown-header">البريد الإلكتروني</h6>
                                    </li>
                                    <li><a class="dropdown-item" href="#">لا يوجد رسائل</a></li>
                                </ul>
                            </li>
                            <li class="nav-item dropdown me-3">
                                <a class="nav-link active dropdown-toggle" href="#" data-bs-toggle="dropdown"
                                   aria-expanded="false">
                                    <i class='bi bi-bell bi-sub fs-4 text-black'></i>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                                    <li>
                                        <h6 class="dropdown-header">الإشعارات</h6>
                                    </li>
                                    <li><a class="dropdown-item">لا توجد إشعارات</a></li>
                                </ul>
                            </li>
                        </ul>
                        <div class="dropdown">
                            <a href="#" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="user-menu d-flex">
                                    <div class="user-name text-end me-3">
                                        <?php
                                        if (isset($_SESSION['email'])) { ?>
                                            <h6 class="mb-0 text-black"><?php echo $_SESSION['name']; ?></h6>
                                            <p class="mb-0 text-sm text-black"><?php echo $_SESSION['role_name']; ?></p>
                                        <?php } else { ?>
                                            <p class="mb-0 text-sm text-black"><a href="<?php echo URL; ?>home/login">تسجيل
                                                    دخول</a></p>
                                        <?php } ?>
                                    </div>
                                    <?php
                                    if (isset($_SESSION['email'])) { ?>
                                        <div class="user-img d-flex align-items-center">
                                            <div class="avatar avatar-md">
                                                <img src="<?php echo URL; ?>public/images/<?php
                                                if ($_SESSION['role_name'] == 'شركة') echo 'companies/';
                                                else echo 'users/';
                                                echo $_SESSION['image_url']; ?>">
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton"
                                style="min-width: 11rem;">
                                <li><a class="dropdown-item"
                                       href="<?php echo URL; ?>home/profile/<?php echo $_SESSION['id']; ?>"><i
                                                class="icon-mid bi bi-person me-2"></i>
                                        ملفي الشخصي</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <a class="dropdown-item" href="<?php echo URL; ?>home/useraction/logout"><i
                                                class="icon-mid bi bi-box-arrow-left me-2"></i> خروج</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>
        </header>