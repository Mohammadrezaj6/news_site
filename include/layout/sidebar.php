<?php

$query = "SELECT * FROM categories";
$categories = $db->query($query);

?>

<div class="col-lg-4">
    <div class="card">
        <div class="card-body">
            <p class="fw-bold fs-6">جستجو در سایت</p>
            <form action="search.php" method="GET">
                <div class="input-group mb-3">
                    <input type="text" name="search" class="form-control" placeholder="جستجو ..." />
                    <button class="btn btn-primary" type="submit">
                        <i class="bi bi-search"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="card mt-4">
        <div class="fw-bold fs-6 card-header">دسته بندی ها</div>
        <ul class="list-group list-group-flush p-0">
            <?php if ($categories->rowCount() > 0) : ?>
                <?php foreach ($categories as $category) : ?>
                    <li class="list-group-item">
                        <a class="link-body-emphasis text-decoration-none" href="index.php?category=<?= $category['id'] ?>"><?= $category['title'] ?></a>
                    </li>
                <?php endforeach ?>
            <?php endif ?>
        </ul>
    </div>

    <div class="card mt-4">
        <div class="card-body">
            <p class="fw-bold fs-6">عضویت در خبرنامه</p>

            <?php
            $invalidInputName = '';
            $invalidInputEmail = '';
            $message = '';

            if (isset($_POST['subscribe'])) {
                if (empty(trim($_POST['name']))) {
                    $invalidInputName = 'فیلد نام الزامیست';
                } elseif (empty(trim($_POST['email']))) {
                    $invalidInputEmail = 'فیلد ایمیل الزامیست';
                } else {
                    $name = $_POST['name'];
                    $email = $_POST['email'];

                    $subscribeInsert = $db->prepare("INSERT INTO subscribers (name, email) VALUES (:name, :email)");
                    $subscribeInsert->execute(['name' => $name, 'email' => $email]);

                    $message = "عضویت شما با موفقیت انجام شد.";
                }
            }

            ?>
            <div class="text-success"><?= $message ?></div>
            <form method="POST">
                <div class="mb-3">
                    <label class="form-label">نام</label>
                    <input type="text" name="name" class="form-control" />
                    <div class="form-text text-danger"><?= $invalidInputName ?></div>
                </div>
                <div class="mb-3">
                    <label class="form-label">ایمیل</label>
                    <input type="email" name="email" class="form-control" />
                    <div class="form-text text-danger"><?= $invalidInputEmail ?></div>
                </div>
                <div class="d-grid gap-2">
                    <button type="submit" name="subscribe" class="btn btn-primary">
                        ارسال
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="card mt-4">
        <div class="card-body">
            <p class="fw-bold fs-6">درباره ما</p>
            <p class="text-justify">
            ما یک رسانه خبری مستقل هستیم که با ارائه جدیدترین و دقیق‌ترین اخبار، شما را در جریان رویدادهای مهم ایران و جهان قرار می‌دهیم. هدف ما اطلاع‌رسانی سریع، شفاف و بی‌طرفانه است تا شما بتوانید تصمیم‌های آگاهانه‌تری بگیرید
            </p>
        </div>
    </div>

    <div class="card mt-4">
        <img src="./assets/images/Gif.gif" alt="">
    </div>
</div>