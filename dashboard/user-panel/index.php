<?php
include "./include/layout/header.php";

$email = $_SESSION['email'];
$query = $db->prepare("SELECT * FROM users WHERE email = :email");
$query->execute(['email' => $email]);
$user = $query->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    echo "کاربری یافت نشد!";
    exit();
}
?>

<div class="container-fluid">
    <div class="row">
        <?php include "./include/layout/sidebar.php"; ?>

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="fs-3 fw-bold">اطلاعات</h1>
            </div>
            <div class="table-responsive small">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th>نام</th>
                            <th>ایمیل</th>
                            <th>نقش</th>
                        </tr>
                    </thead>
                    <tbody>
                            <tr>
                                <th><?=$user['name'] ?></th>
                                <td><?= $user['email'] ?></td>
                                <td><?= ($user['role'] == 'admin') ? 'مدیر' : 'کاربر عادی' ?></td>
                                <td></td>
                            </tr>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</div>

<?php include "./include/layout/footer.php"; ?>