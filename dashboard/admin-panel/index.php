<?php
include "./include/layout/header.php";

if (isset($_GET['entity']) && isset($_GET['action']) && isset($_GET['id'])) {
    $entity = $_GET['entity'];
    $action = $_GET['action'];
    $id = $_GET['id'];

    if ($action == "delete") {
        switch ($entity) {
            case "post":
                $query = $db->prepare('DELETE FROM posts WHERE id = :id');
                break;
            case "comment":
                $query = $db->prepare('DELETE FROM comments WHERE id = :id');
                break;
            case "category":
                $query = $db->prepare('DELETE FROM categories WHERE id = :id');
                break;
        }
    } elseif($action == "approve") {
        $query = $db->prepare("UPDATE comments SET status = '1' WHERE id = :id");
    }

    $query->execute(['id' => $id]);
}

$posts = $db->query("SELECT * FROM posts ORDER BY id DESC LIMIT 5");
$comments = $db->query("SELECT * FROM comments ORDER BY id DESC LIMIT 5");
$categories = $db->query("SELECT * FROM categories ORDER BY id DESC");

?>

<div class="container-fluid">
    <div class="row">
        <?php
            include "./include/layout/sidebar.php"
        ?>

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="fs-3 fw-bold">داشبورد</h1>
            </div>

            <div class="mt-4">
                <h4 class="text-secondary fw-bold">اخبار اخیر</h4>
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
                                            <a href="./pages/posts/edit.php?id=<?= $post['id'] ?>" class="btn btn-sm btn-outline-primary">ویرایش</a>
                                            <a href="index.php?entity=post&action=delete&id=<?= $post['id'] ?>" class="btn btn-sm btn-outline-danger">حذف</a>
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

            <div class="mt-4">
                <h4 class="text-secondary fw-bold">کامنت های اخیر</h4>
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
                                                <button class="btn btn-sm btn-outline-primary disabled">تایید شده</button>
                                            <?php else : ?>
                                                <a href="index.php?entity=comment&action=approve&id=<?= $comment['id'] ?>" class="btn btn-sm btn-outline-primary">در انتظار تایید</a>
                                            <?php endif ?>
                                            <a href="index.php?entity=comment&action=delete&id=<?= $comment['id'] ?>" class="btn btn-sm btn-outline-danger">حذف</a>
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

            <div class="mt-4">
                <h4 class="text-secondary fw-bold">دسته بندی</h4>
                <?php if ($categories->rowCount() > 0) : ?>
                    <div class="table-responsive small">
                        <table class="table table-bordered align-middle">
                            <thead class="table-secondary">
                                <tr>
                                    <th>id</th>
                                    <th>عنوان</th>
                                    <th>عملیات</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($categories as $category) : ?>
                                    <tr>
                                        <th><?= $category['id'] ?></th>
                                        <td><?= $category['title'] ?></td>
                                        <td>
                                            <a href="./pages/categories/edit.php?id=<?= $category['id'] ?>" class="btn btn-sm btn-outline-primary">ویرایش</a>
                                            <a href="index.php?entity=category&action=delete&id=<?= $category['id'] ?>" class="btn btn-sm btn-outline-danger">حذف</a>
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
include "./include/layout/footer.php"
?>