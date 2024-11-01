<?php
include '../lib/database.php';
include '../helpers/format.php';
include '../lib/seesion.php';
include '../classes/course.php';
include '../classes/cart.php';
include '../classes/user.php';
include '../classes/schedule.php';
include '../classes/register.php';

Session::init();
Session::adminCheck();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trung Tâm Anh Ngữ ENGQUI</title>
    <link rel="icon" href="../images/header/icon.png">
</head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<link rel="stylesheet" href="../css/style.css">

<body>
    <header id="header" class="fixed-top">
        <div class="container d-flex align-items-center">

            <h1 class="logo me-auto"><a href="index.php">ENGQUI</a></h1>

            <nav id="navbar" class="navbar">
                <ul>
                    <li><a class="nav-link scrollto" href="index.php">Trang chủ</a></li>
                    <li><a class="nav-link scrollto" href="about.php">Giới Thiệu</a></li>
                    <li><a class="nav-link scrollto" href="course_list.php">Khóa Học</a></li>
                    <li><a class="nav-link scrollto" href="contact.php">Liên Hệ</a></li>
                    <?php
                    if (isset($_GET['action']) && $_GET['action'] == 'logout') {
                        Session::destroy();
                    }

                    if (Session::get("Login") == 1) {
                        echo '<li><a href="course_cart.php">Khóa học đã đăng ký</a></li>' . '<li><a class="login scrollto" href="profile.php">' . Session::get("Name") . '</a></li>' . '<li><a class="nav-link scrollto">|</a></li>' . '<li><a href="?action=logout">Đăng Xuất</a></li>';
                    } else {
                        echo '<li><a class="login scrollto" href="login.php">Đăng Nhập</a></li>';
                    }
                    ?>
                </ul>
                <i style="margin-left: 5vh;" class="fa-solid fa-bars mobile-nav-toggle"></i>
            </nav>

        </div>
    </header>