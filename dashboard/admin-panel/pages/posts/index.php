<?php
include "../../include/layout/header.php";

$posts = $db->query("SELECT * FROM posts ORDER BY id DESC");

if (isset($_GET['action']) && isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = $db->prepare('DELETE FROM posts WHERE id = :id');

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
                <h1 class="fs-3 fw-bold">خبرها</h1>

                <div class="btn-toolbar mb-2 mb-md-0">
                    <a href="./create.php" class="btn btn-sm bg-primary text-white">
                        درج خبر جدید
                    </a>
                </div>
            </div>

            <div class="mt-4">
                <?php if ($posts->rowCount() > 0) : ?>
                    <div class="table-responsive small">
                        <table class="table table-bordered align-middle">
                            <thead class="table-secondary">
                                <tr>
                                    <th>id</th>
                                    <th>عنوان</th>
                                    <th>نویسنده</th>
                                    <th>عملیات</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($posts as $post) : ?>
                                    <tr>
                                        <th><?= $post['id'] ?></th>
                                        <td><?= $post['title'] ?></td>
                                        <td><?= $post['author'] ?></td>
                                        <td>
                                            <a href="./edit.php?id=<?= $post['id'] ?>" class="btn btn-sm btn-outline-primary">ویرایش</a>
                                            <a href="index.php?action=delete&id=<?= $post['id'] ?>" class="btn btn-sm btn-outline-danger">حذف</a>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                <?php else : ?>
                    <div class="col">
                        <div class="alert alert-danger">
                            خبری یافت نشد ....
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