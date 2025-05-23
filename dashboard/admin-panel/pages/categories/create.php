<?php
include "../../include/layout/header.php";

$invalidInputTitle = '';

if (isset($_POST['addCategory'])) {
    if (empty(trim($_POST['title']))) {
        $invalidInputTitle = "فیلد عنوان ضروری هست";
    }

    if (!empty(trim($_POST['title']))) {
        $title = $_POST['title'];
        $categoryInsert = $db->prepare("INSERT INTO categories (title) VALUES (:title )");
        $categoryInsert->execute(['title' => $title]);

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
                <h1 class="fs-3 fw-bold">ایجاد دسته بندی</h1>
            </div>

            <div class="mt-4">
                <form method="post" class="row g-4">
                    <div class="col-12 col-sm-6 col-md-4">
                        <label class="form-label">عنوان دسته بندی</label>
                        <input type="text" name="title" class="form-control" />
                        <div class="form-text text-danger"><?= $invalidInputTitle ?></div>
                    </div>

                    <div class="col-12">
                        <button name="addCategory" type="submit" class="btn bg-primary text-white">
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