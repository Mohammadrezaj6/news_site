<?php
include "../../include/layout/header.php";

$invalidInputName = '';
$invalidInputEmail = '';
$invalidInputPassword = '';

if (isset($_POST['addUsers'])) {
    if (empty(trim($_POST['name'] ?? ''))) {
        $invalidInputName = "فیلد نام ضروری هست";
    }
    if (empty(trim($_POST['email'] ?? ''))) {
        $invalidInputEmail = "فیلد ایمیل ضروری هست";
    }

    if (empty(trim($_POST['password'] ?? ''))) {
        $invalidInputPassword = "فیلد رمز عبور ضروری هست";
    }

    if (!empty(trim($_POST['name'] ?? '')) && !empty(trim($_POST['email'] ?? '')) && !empty(trim($_POST['password'] ?? ''))) {
        $name = trim($_POST['name']);
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);
        $userInsert = $db->prepare("INSERT INTO users (name , email , password) VALUES (:name , :email , :password)");
        $userInsert->execute(['name' => $name , 'email' => $email , 'password' => $password]);

        header("Location:index.php");
        exit();
    }

}

?>

<div class="container-fluid">
    <div class="row">
        <?php
        include "../../include/layout/sidebar.php"
        ?>

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="fs-3 fw-bold">ایجاد کاربر</h1>
            </div>

            <div class="mt-4">
                <form method="post" class="row g-4">
                    <div class="col-12 col-sm-6 col-md-4">
                        <label class="form-label">نام</label>
                        <input type="text" name="name" class="form-control" />
                        <div class="form-text text-danger"><?= $invalidInputName ?></div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-4">
                        <label class="form-label">ایمیل</label>
                        <input type="email" name="email" class="form-control" />
                        <div class="form-text text-danger"><?= $invalidInputEmail ?></div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-4">
                        <label class="form-label">رمز عبور</label>
                        <input type="text" name="password" class="form-control" />
                        <div class="form-text text-danger"><?= $invalidInputPassword ?></div>
                    </div>
                    <div class="col-12">
                        <button name="addUsers" type="submit" class="btn bg-primary text-white">
                            ایجاد
                        </button>
                    </div>
                </form>
            </div>
        </main>
    </div>
</div>

<?php
include "../../include/layout/footer.php"
?>