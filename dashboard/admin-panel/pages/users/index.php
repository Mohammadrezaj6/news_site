<?php
include "../../include/layout/header.php";

$users = $db->query("SELECT * FROM users ORDER BY id DESC");

if (isset($_GET['action']) && isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = $db->prepare('DELETE FROM users WHERE id = :id');

    $query->execute(['id' => $id]);

    header("Location:index.php");
    exit();
}

?>

<div class="container-fluid">
    <div class="row">
        <?php
        include "../../include/layout/sidebar.php"
        ?>

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="fs-3 fw-bold">کاربران</h1>

                <div class="btn-toolbar mb-2 mb-md-0">
                    <a href="./create.php" class="btn btn-sm bg-primary text-white">
                        ایجاد کاربر
                    </a>
                </div>
            </div>

            <div class="mt-4">
                <?php if ($users->rowCount() > 0) : ?>
                    <div class="table-responsive small">
                        <table class="table table-bordered align-middle">
                            <thead class="table-secondary">
                                <tr>
                                    <th>id</th>
                                    <th>نام</th>
                                    <th>ایمیل</th>
                                    <th>رمز عبور</th>
                                    <th>عملیات</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($users as $user) : ?>
                                    <tr>
                                        <th><?= $user['id'] ?></th>
                                        <td><?= $user['name'] ?></td>
                                        <td><?= $user['email'] ?></td>
                                        <td><?= $user['password'] ?></td>
                                        <td>
                                            <a href="./edit.php?id=<?= $user['id'] ?>" class="btn btn-sm btn-outline-primary">ویرایش</a>
                                            <a href="index.php?action=delete&id=<?= $user['id'] ?>" class="btn btn-sm btn-outline-danger">حذف</a>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                <?php else : ?>
                    <div class="col">
                        <div class="alert alert-danger">
                            دسته بندی یافت نشد ....
                        </div>
                    </div>
                <?php endif ?>
            </div>
        </main>
    </div>
</div>

<?php
include "../../include/layout/footer.php"
?>