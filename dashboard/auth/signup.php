<?php
session_start();

include "../../include/config.php";
include "../../include/db.php";

$invalidInputEmail = '';
$invalidInputPassword = '';
$invalidInputName = '';
$successMessage = '';

if (isset($_POST['register'])) {
    
    if (empty(trim($_POST['name']))) {
        $invalidInputName = "فیلد نام ضروری هست";
    }

    if (empty(trim($_POST['email']))) {
        $invalidInputEmail = "فیلد ایمیل ضروری هست";
    }

    if (empty(trim($_POST['password']))) {
        $invalidInputPassword = "فیلد رمز عبور ضروری هست";
    }

    if (!empty(trim($_POST['name'])) && !empty(trim($_POST['email'])) && !empty(trim($_POST['password']))) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];


        $userCheck = $db->prepare("SELECT * FROM users WHERE email=:email");
        $userCheck->execute(['email' => $email]);

        if ($userCheck->rowCount() > 0) {
            $invalidInputEmail = "این ایمیل قبلاً ثبت‌ نام شده است";
        } else {

            $role = 'user';

            $sql = "INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)";
            $stmt = $db->prepare($sql);
            $stmt->execute([$name, $email, $password, $role]);

            $successMessage = "ثبت‌ نام شما با موفقیت انجام شد! حالا می‌توانید وارد شوید.";


            header("Location: login.php?msg=" . urlencode($successMessage));
            exit();
        }
    }
}
?>

<!DOCTYPE html>
<html dir="rtl" lang="fa">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>ثبت‌نام در سایت</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous" />

    <link rel="stylesheet" href="../assets/css/style.css" />
</head>

<body class="auth">
    <main class="form-signin w-100 m-auto">
        <form class="card p-3" method="post">
            <div class="fs-2 fw-bold text-center mb-4">News Site</div>
            
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

            <div class="mb-3">
                <label class="form-label">رمز عبور</label>
                <input type="password" name="password" class="form-control" />
                <div class="form-text text-danger"><?= $invalidInputPassword ?></div>
            </div>
            <button name="register" class="w-100 btn btn-primary mt-4" type="submit">
                ثبت‌نام
            </button>
        </form>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>

</html>
