<?php
include "../../include/layout/header.php";

if (!isset($_SESSION['email'])) {
    header("Location: ../../auth/login.php");
    exit();
}

$email = $_SESSION['email'];

$query = $db->prepare("SELECT * FROM users WHERE email = :email");
$query->execute(['email' => $email]);
$user = $query->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    echo "کاربری یافت نشد!";
    exit();
}

if (isset($_POST['editUser'])) {
    $name = trim($_POST['name']);
    $new_email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if (!empty($name) && !empty($new_email)) {
        if (!empty($password)) {
            $updateUser = $db->prepare("UPDATE users SET name = :name, email = :email, password = :password WHERE email = :old_email");
            $updateUser->execute(['name' => $name, 'email' => $new_email, 'password' => $password, 'old_email' => $email]);
        } else {
            $updateUser = $db->prepare("UPDATE users SET name = :name, email = :email WHERE email = :old_email");
            $updateUser->execute(['name' => $name, 'email' => $new_email, 'old_email' => $email]);
        }

        $_SESSION['email'] = $new_email;
        header("Location: index.php");
        exit();
    }
}
?>

<div class="container-fluid">
    <div class="row">
        <?php include "../../include/layout/sidebar.php"; ?>

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="fs-3 fw-bold">ویرایش اطلاعات شخصی</h1>
            </div>

            <div class="mt-4">
                <form method="post" class="row g-4">
                    <div class="col-12 col-sm-6 col-md-4">
                        <label class="form-label">نام</label>
                        <input type="text" value="<?= $user['name'] ?? '' ?>" name="name" class="form-control" required />
                    </div>
                    <div class="col-12 col-sm-6 col-md-4">
                        <label class="form-label">ایمیل</label>
                        <input type="email" name="email" value="<?= $user['email'] ?? '' ?>" class="form-control" required />
                    </div>
                    <div class="col-12 col-sm-6 col-md-4">
                        <label class="form-label">رمز عبور</label>
                        <input type="text" name="password" class="form-control" placeholder="در صورت نیاز وارد کنید" />
                    </div>

                    <div class="col-12">
                        <button name="editUser" type="submit" class="btn bg-primary text-white">ویرایش</button>
                    </div>
                </form>
            </div>
        </main>
    </div>
</div>

<?php include "../../include/layout/footer.php"; ?>
