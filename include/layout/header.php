<?php
session_start();
include "./include/config.php";
include "./include/db.php";

$query = "SELECT * FROM categories";
$categories = $db->query($query);


?>

<!DOCTYPE html>
<html dir="rtl" lang="fa">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>سایت خبری</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="./assets/css/style.css" />
</head>

<body>
    <div class="container py-3">
        <header class="d-flex justify-content-between flex-column flex-md-row align-items-center pb-3 mb-4 border-bottom">
            <a href="index.php" class="fs-4 fw-medium link-body-emphasis text-decoration-none">
                سایت خبری
            </a>
            <nav class="d-inline-flex mt-2 mt-md-0">
                <?php if ($categories->rowCount() > 0) : ?>
                    <?php foreach ($categories as $category) : ?>
                        <a class="me-3 py-2 link-body-emphasis text-decoration-none <?= (isset($_GET['category']) && $category['id'] == $_GET['category']) ? 'fw-bold' : '' ?>" 
                            href="index.php?category=<?= $category['id'] ?>">
                            <?= $category['title'] ?>
                        </a>
                    <?php endforeach ?>
                <?php endif ?>
            </nav>

            <div>
                <?php if (isset($_SESSION['email'])) : ?>
                    <?php 
                        $role = $_SESSION['role'] ?? ''; 
                    ?>
                    <?php if ($role == 'admin') : ?>
                        <a href="/news_site/dashboard/admin-panel/index.php" class="btn btn-warning">داشبورد ادمین</a>
                    <?php else : ?>
                        <a href="/news_site/dashboard/user-panel/index.php" class="btn btn-outline-primary">حساب کاربری</a>
                    <?php endif; ?>
                    <a href="/news_site/dashboard/auth/logout.php" class="btn btn-outline-danger ms-2">خروج</a>
                <?php else : ?>
                    <a href="/news_site/dashboard/auth/signup.php" class="btn btn-primary">ثبت نام</a>
                    <a href="/news_site/dashboard/auth/login.php" class="btn btn-primary">ورود</a>
                <?php endif; ?>
            </div>
        </header>
