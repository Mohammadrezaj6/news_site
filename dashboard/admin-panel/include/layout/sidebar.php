<?php
$path = $_SERVER['REQUEST_URI'];
?>

<div class="sidebar border border-right col-md-3 col-lg-2 p-0 bg-body-tertiary">
    <div class="offcanvas-md offcanvas-end bg-body-tertiary" tabindex="-1" id="sidebarMenu">
        <div class="offcanvas-header">
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#sidebarMenu"></button>
        </div>

        <div class="offcanvas-body d-md-flex flex-column p-0 pt-lg-3 overflow-y-auto">
            <ul class="nav flex-column pe-3">
                <li class="nav-item">
                    <a class="nav-link link-body-emphasis text-decoration-none d-flex align-items-center gap-2 <?= str_contains($path, 'pages') ? '' : 'text-secondary' ?>" href="/news_site/dashboard/admin-panel/index.php">
                        <i class="bi bi-house fs-4 text-secondary"></i>
                        <span class="fw-bold">داشبورد</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link link-body-emphasis text-decoration-none d-flex align-items-center gap-2 <?= str_contains($path, 'posts') ? 'text-secondary' : '' ?>" href="/news_site/dashboard/admin-panel/pages/posts/index.php">
                        <i class="bi bi-newspaper fs-4 text-secondary"></i>
                        <span class="fw-bold">اخبارها</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link link-body-emphasis text-decoration-none d-flex align-items-center gap-2 <?= str_contains($path, 'categories') ? 'text-secondary' : '' ?>" href="/news_site/dashboard/admin-panel/pages/categories/index.php">
                        <i class="bi bi-folder fs-4 text-secondary"></i>
                        <span class="fw-bold">دسته بندی</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link link-body-emphasis text-decoration-none d-flex align-items-center gap-2 <?= str_contains($path, 'comments') ? 'text-secondary' : '' ?>"" href="/news_site/dashboard/admin-panel/pages/comments/index.php">
                        <i class="bi bi-chat-left-text fs-4 text-secondary"></i>
                        <span class="fw-bold">کامنت ها</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link link-body-emphasis text-decoration-none d-flex align-items-center gap-2 <?= str_contains($path, 'users') ? 'text-secondary' : '' ?>"" href="/news_site/dashboard/admin-panel/pages/users/index.php">
                        <i class="bi bi-person fs-4 text-secondary"></i>
                        <span class="fw-bold">کاربران</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link link-body-emphasis text-decoration-none d-flex align-items-center gap-2 <?= str_contains($path, 'view') ? 'text-secondary' : '' ?>"" href="/news_site/index.php">
                        <i class="bi bi-eye fs-4 text-secondary"></i>
                        <span class="fw-bold">مشاهده سایت</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link link-body-emphasis text-decoration-none d-flex align-items-center gap-2" href="/news_site/dashboard/auth/logout.php">
                        <i class="bi bi-box-arrow-right fs-4 text-secondary"></i>
                        <span class="fw-bold">خروج</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>