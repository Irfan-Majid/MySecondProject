<?php require_once('../include/header.php') ?>

<div class="container-fluid">
    <div class="row">
        <?php require_once('../include/navbar.php') ?>
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Add New Product</h1>
            </div>
            <div class="row">
                <div class="col-12">
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" name="name" id="name">
                        </div>
                        <div class="row">
                            <div class="mb-3 col">
                                <label for="category_id" class="form-label">Category</label>
                                <select class="form-control" name="category_id" id="category_id">

                                    <?php
                                    $rs = $crud->common_select('categories');
                                    #var_dump($rs);
                                    if ($rs['success'] == 1) { ?>
                                        <option value="">Select </option>
                                        <?php foreach ($rs['msg'] as $cat) { ?>
                                            <option value="<?= $cat->id ?>"><?= $cat->name ?></option>
                                        <?php } //end foreach
                                    } else { ?>
                                        <option value="">No Category Found </option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="mb-3 col">
                                <label for="brands_id" class="form-label">Brand</label>
                                <select class="form-control" name="brands_id" id="brands_id">

                                    <?php
                                    $rs = $crud->common_select('brands');
                                    if ($rs['success'] == 1) { ?>
                                        <option value="">Select </option>
                                        <?php foreach ($rs['msg'] as $cat) { ?>
                                            <option value="<?= $cat->id ?>"><?= $cat->name ?></option>
                                        <?php } //end foreach
                                    } else { ?>
                                        <option value="">No brand Found </option>
                                    <?php } ?>
                                </select>
                            </div>


                            <div class="mb-3 col">
                                <label for="supplier_id" class="form-label">Supplier</label>
                                <select class="form-control" name="supplier_id" id="supplier_id">

                                    <?php
                                    $rs = $crud->common_select('suppliers');
                                    if ($rs['success'] == 1) { ?>
                                        <option value="">Select </option>
                                        <?php foreach ($rs['msg'] as $cat) { ?>
                                            <option value="<?= $cat->id ?>"><?= $cat->name ?></option>
                                        <?php } //end foreach
                                    } else { ?>
                                        <option value="">No supplier Found </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                    <div class="row">
                    <div class="mb-3 col">
                            <label for="purchase_price" class="form-label">Purchase Price(per unit)</label>
                            <input type="text" class="form-control" name="purchase_price" id="purchase_price">
                        </div>

                        <div class="mb-3 col">
                            <label for="sale_price" class="form-label">Sale Price(per unit)</label>
                            <input type="text" class="form-control" name="sale_price" id="sale_price">
                        </div>
                    </div>
                       

                        <!-- <div class="mb-3">
                            <label for="qty" class="form-label">Qty</label>
                            <input type="text" class="form-control" name="qty" id="qty">
                        </div> -->

                        <div class="mb-3">
                            <label for="image" class="form-label">Product Image</label>
                            <input type="file" class="form-control" name="image" id="image">
                        </div>
                        <button type="submit" class="btn btn-primary">Add</button>
                    </form>
                    <?php
                    if ($_POST) {
                        $data = $_POST;
                        if ($_FILES['image']['name']) {
                            $fname = time() . $_FILES['image']['name'];
                            if (move_uploaded_file($_FILES['image']['tmp_name'], '../assets/images/' . $fname)) {
                                $_POST['image'] = $fname;
                            }
                        }
                        $_POST['status'] = 1;
                        $_POST["date"] = date('d-M-Y h:i:s');
                        $_POST['stock'] = $_POST['qty'];
                        $ins = $crud->common_insert('products', $_POST);
                        if ($ins['success']) {
                            echo "<script>window.location.href = '{$base_url}products/index.php';
</script>";
                        } else {
                            echo $ins['msg'];
                        }
                    }
                    ?>
                </div>
            </div>
        </main>
    </div>
</div>
<?php require_once('../include/footer.php') ?>