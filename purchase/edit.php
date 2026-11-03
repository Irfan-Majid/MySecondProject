<?php require_once('../include/header.php') ?>

<div class="container-fluid">
    <div class="row">
        <?php require_once('../include/navbar.php') ?>
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div
                class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Edit Product</h1>
            </div>
            <div class="row">
                <div class="col-12">

                    <?php
                    $a = $_GET;
                    //var_dump($_GET);
                    $rs = $crud->common_select('sales', "*", $_GET);
                    $product_id = $rs['msg'][0]->product_id;
                    $qty = $rs['msg'][0]->qty;
                    $sale_price = $rs['msg'][0]->price;
                    $discount = $rs['msg'][0]->discount;
                    $net_price = $rs['msg'][0]->net_price;
                    ?>


                    <form action="" method="post" enctype="multipart/form-data">

                        <div class="mb-3">
                            <label for="product_id" class="form-label">Product Name</label>
                            <select class="form-control" name="product_id" id="product_id">

                                <?php
                                $rs = $crud->common_select('products');
                                #var_dump($rs);
                                if ($rs['success'] == 1) { ?>
                                <option value="">Select </option>
                                <?php foreach ($rs['msg'] as $cat) {

                                        if ($cat->id == $product_id) { ?>
                                <option value="<?= $cat->id ?>" selected><?= $cat->name ?></option>
                                <?php } else { ?>
                                <option value="<?= $cat->id ?>"><?= $cat->name ?></option>

                                <?php }
                                    } //end foreach
                                } else { ?>
                                <option value="">No Product Found </option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="qty" class="form-label">Qty</label>
                            <input type="text" class="form-control" name="qty" id="qty" value="<?= $qty ?>">
                        </div>

                        <div class="mb-3">
                            <label for="sale_price" class="form-label">Total Sale Price</label><small id="small"
                                style="margin-left:10px;" contenteditable="true"
                                value="<?= $sale_price / $qty ?>"><?= "( " . $sale_price / $qty . " Tk per unit )" ?></small>
                            <input type="text" class="form-control" name="price" id="sale_price">
                        </div>

                        <div class="mb-3">
                            <label for="discount" class="form-label">Discount</label>
                            <input type="text" class="form-control" name="discount" id="discount"
                                value="<?= $discount . "%" ?>">
                        </div>

                        <div class="mb-3">
                            <label for="Net_price" class="form-label">Net Price</label>
                            <input type="text" class="form-control" name="net_price" id="Net_price"
                                value="<?= $net_price ?>">
                        </div>
                        <button type="submit" class="btn btn-primary" disabled id="submit">Update</button>
                    </form>
                    <div class="modal fade" id="myModal" role="dialog">
                        <div class="modal-dialog">

                            <!-- Modal content-->
                            <style>
                            .modal-content {
                                background-color: #0480be;
                            }

                            .modal-body {
                                background-color: #fff;
                            }
                            </style>
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title"></h4>
                                </div>
                                <div class="modal-body">
                                    <p>The stock amount you entered is not available</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default close"
                                        data-dismiss="modal">Close</button>
                                </div>
                            </div>

                        </div>
                    </div>
                    <?php
                    if ($_POST) {
                        $data = $_POST;
                        $ins = $crud->common_update('sales', $_POST, $_GET);
                        if ($ins['success']) {
                            echo "<script>window.location.href = '{$base_url}sale/index.php';</script>";
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
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
    crossorigin="anonymous"></script>
<script>
$(document).ready(function() {
    var a = $('#qty').val() * <?= $sale_price / $qty ?>;
    $('#sale_price').val(a);
    $('#qty').blur(function(e) {
        $.ajax({
            type: 'POST',
            url: 'search.php',
            data: {
                'p_id': $('#product_id').val()
            },
            dataType: 'json',
            encode: true,
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status);
                alert(thrownError);
                alert(ajaxOptions);
            }
        }).done(function(data) {
            console.log(data);
            var stock_quantity = data[2];
            var a = $('#qty').val();
            if (a > stock_quantity) {
                $("#myModal").modal('show');
                $(".close").click(function() {
                    $("#myModal").modal('hide')
                });
                $('#sale_price').val("");
                $("#submit").attr("disabled", true);
            } else {
                $('#sale_price').val(data[3] * a);
                $("#submit").attr("disabled", false);
            }
        }).fail(function(e) {
            console.log(e);
        });
    });



    $("#product_id").change(function(e) {
        $.ajax({
            type: 'POST',
            url: 'search.php',
            data: {
                'p_id': $('#product_id').val()
            },
            dataType: 'json',
            encode: true,
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status);
                alert(thrownError);
                alert(ajaxOptions);
            }
        }).done(function(data) {
            $('#small').text("( " + data[3] + " Tk per unit )");
            $('#sale_price').val($('#qty').val() * data[3]);
            var a = $('#discount').val().trim();
            a = a.substring(0, a.indexOf("%"));
            var b = $('#sale_price').val().trim();
            var c = b - (b / 100 * a);
            $('#Net_price').val(c);
            $("#submit").attr("disabled", false);
            if( data[2] < $("#qty").val()){
                $("#myModal").modal('show');
                $(".close").click(function() {
                    $("#myModal").modal('hide')
                });
                
                $("#submit").attr("disabled", true);
            }
        })

    })



    $('#discount').blur(function() {
        var a = $('#discount').val().trim();
        if (a.indexOf("%") < 0) {
            $('#discount').val(a + "%");
        } else {
            a = a.substring(0, a.indexOf("%"));
        }
        var b = $('#sale_price').val().trim();
        if (a != null && b != null) {
            if (a < 50) {
                var c = b - (b / 100 * a);
                $('#Net_price').val(c);

                $("#submit").attr("disabled", false);

            } else {
                $("#submit").attr("disabled", true);
                alert("Discount can not be more then 50%")
            }
        }
    })

})
</script>
<?php
//end if
?>