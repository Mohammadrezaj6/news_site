<?php
include "../../include/layout/header.php";

$comments = $db->query("SELECT * FROM comments ORDER BY id DESC");

if (isset($_GET['action']) && isset($_GET['id'])) {

    $action = $_GET['action'];
    $id = $_GET['id'];

    if ($action == "delete") {
        $query = $db->prepare('DELETE FROM comments WHERE id = :id');
    } else {
        $query = $db->prepare("UPDATE comments SET status='1' WHERE id = :id");
    }
    
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
                <h1 class="fs-3 fw-bold">کامنت ها</h1>
            </div>

            <div class="mt-4">
                <?php if ($comments->rowCount() > 0) : ?>
                    <div class="table-responsive small">
                        <table class="table table-bordered align-middle">
                            <thead class="table-secondary">
                                <tr>
                                    <th>id</th>
                                    <th>نام</th>
                                    <th>متن کامنت</th>
                                    <th>عملیات</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($comments as $comment) : ?>
                                    <tr>
                                        <th><?= $comment['id'] ?></th>
                                        <td><?= $comment['name'] ?></td>
                                        <td><?= $comment['comment'] ?></td>
                                        <td>
                                            <?php if ($comment['status']) : ?>
                                                <button class="btn btn-sm btn-outline-dark disabled">تایید شده</button>
                                            <?php else : ?>
                                                <a href="index.php?action=approve&id=<?= $comment['id'] ?>" class="btn btn-sm btn-outline-primary">در انتظار تایید</a>
                                            <?php endif ?>


                                            <a href="index.php?action=delete&id=<?= $comment['id'] ?>" class="btn btn-sm btn-outline-danger">حذف</a>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                <?php else : ?>
                    <div class="col">
                        <div class="alert alert-danger">
                            کامنتی یافت نشد ....
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