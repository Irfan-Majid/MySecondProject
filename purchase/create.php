<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php require_once('../include/header.php') ?>

    <div class="container-fluid">
        <div class="row">

            <main class="col-md-12 col-lg-12 px-md-12">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Add New purchase</h1>
                    <a class="btn btn-info float-right" href="<?= $base_url ?>purchase/index.php">
                        < Back </a>
                </div>

                <div class="col-md-4 offset-md-4">

                    <!--suggetion form-->
                    <form method="post" action="" autocomplete="off" id="fil-ter">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-btn">
                                    <button type="" class="btn btn-primary">Filter</button>
                                </span>
                                <input type="text" id="filter" class="form-control" name="title" placeholder="filter for supplier name">
                            </div>
                        </div>
                    </form>
                </div>
        </div>
        <div class="row pt-3">
            <div class="col-4">
                <div class="row text-center">
                    <h6 class="col-sm-3">Name</h6>
                    <h6 class="col-sm-3">Qty</h6>
                    <h6 class="col-sm-3">Price</h6>
                    <h6 class="col-sm-3">Total</h6>
                </div><br>
                <form class="text-center" action="" method="post" enctype="multipart/form-data">
                    <div class="product-data">

                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">


                            <div class="mb-3 form-group">
                                <label for="discount" class="form-label">Discount (%)</label>
                                <input type="text" onkeyup="cal_total()" class="form-control" name="discount" id="discount">
                            </div>

                            <div class="mb-3 form-group">
                                <label for="Net_price" class="form-label">Net Price</label>
                                <input type="text" class="form-control" name="net_price" id="Net_price">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3 form-group">
                                <label class="form-label">Pay Status</label>
                                <select type="text" class="form-control" name="pay_status">
                                    <option value="paid">Paid</option>
                                    <option value="unpaid">Unpaid</option>
                                </select>
                            </div>
                            <!--<div class="mb-3 form-group">
                                <label class="form-label">Supplier Name</label>
                                <input type="text" class="form-control" name="customer_name">
                            </div>-->
                            <!-- <div class="mb-3 col">
                                <label for="supplier_id" class="form-label">Supplier</label>
                                <select class="form-control" name="supplier_id" id="supplier_id">

                                    <?php
                                    $rs = $crud->common_select('suppliers');
                                    if ($rs['success'] == 1) { ?>
                                        <option value="">Select </option>
                                        <?php foreach ($rs['msg'] as $cat) { ?>
                                            <option value="<?php $cat->id ?>"><?php $cat->name ?></option>
                                        <?php } //end foreach
                                    } else { ?>
                                        <option value="">No supplier Found </option>
                                    <?php } ?>
                                </select>
                            </div> -->
                        </div>
                    </div>

                    <!-- <div class="mb-3 form-group">
                                <label class="form-label">Customer Contact</label>
                                <input type="text" class="form-control" name="customer_contact">
                            </div> -->

                    <button type="submit" class="btn btn-primary btn-xl" id="submit">Sale Submit</button>
                </form>
                <div class="modal fade" id="myModal" role="dialog">
                    <div class="modal-dialog">




                        <!-- Modal content-->
                        <style>
                            .modal-body {
                                background-color: #FFFFFF;
                            }

                            .modal-content {
                                border-radius: 6px;
                                -webkit-border-radius: 6px;
                                -moz-border-radius: 6px;
                                background-color: transparent;
                            }

                            .modal-footer {
                                border-bottom-left-radius: 6px;
                                border-bottom-right-radius: 6px;
                                -webkit-border-bottom-left-radius: 6px;
                                -webkit-border-bottom-right-radius: 6px;
                                -moz-border-radius-bottomleft: 6px;
                                -moz-border-radius-bottomright: 6px;
                            }

                            .modal-header {
                                border-top-left-radius: 6px;
                                border-top-right-radius: 6px;
                                -webkit-border-top-left-radius: 6px;
                                -webkit-border-top-right-radius: 6px;
                                -moz-border-radius-topleft: 6px;
                                -moz-border-radius-topright: 6px;
                            }
                        </style>
                        <div class="modal-content">
                            <div class="modal-header bg-secondary">
                                <button type="button" class="close btn-outline-danger" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title"></h4>
                            </div>
                            <div class="modal-body bgColorWhite">
                                <p>The stock amount you entered is not available</p>
                            </div>
                            <div class="modal-footer bg-secondary">
                                <button type="button" class="btn btn-default btn-outline-danger close" data-dismiss="modal">Close</button>
                            </div>
                        </div>

                    </div>
                </div>

                <?php
                if ($_POST) {
                    //     $data['supplier_id']=$_POST['supplier_id'];
                    // $data['customer_contact']=$_POST['customer_contact'];
                    $data['total_price'] = $_POST['net_price'];
                    $data['discount'] = $_POST['discount'];
                    $data['pay_status'] = $_POST['pay_status'];
                    $data['supplier'] =$_POST['supplier_id'];
                    $data['saledate'] = date('d-M-Y h:i:s');
                    $ins = $crud->common_insert('purchases', $data);
                    if ($ins['success']) {
                        $insid = $ins['msg'];
                        // echo "qty<br>";
                        // var_dump($_POST['qty']);
                        // echo "price<br>";
                        // var_dump($_POST['price']);
                        // echo "id<br>";
                        // var_dump($_POST['id']);
                        // die();
                        $items = $_POST['id'];
                        if (count($items) > 0) {
                            foreach ($items as $i => $item) {
                                $ddata['purchase_id'] = $insid;
                                $ddata['product_id'] = $item;
                                $ddata['qty'] = $_POST['qty'][$i];
                                $ddata['price'] = $_POST['price'][$i];


                                $up = $crud->common_insert('purchases_details', $ddata);
                                if ($up['success']) {
                                    // echo "<br>";
                                    // var_dump($_POST['stock'][$i]);
                                    // echo "<br>";
                                    // var_dump($_POST['qty'][$i]);
                                    $proup['stock'] = $_POST['stock'][$i] + $_POST['qty'][$i];
                                    $where['id'] = $item;
                                    var_dump($proup['stock']);
                                    // echo "<br>";
                                    // var_dump($where['id']);

                                    $crud->common_update('products', $proup, $where);
                                }
                            }
                        }
                        echo "<script>window.location.href = '{$base_url}purchase/index.php';
 </script>";
                    } else {
                        echo $ins['msg'];
                    }
                }
                ?>
            </div>



            <div class="col-8">



                <div class="row filter_div" id="filter_div">
                    <div class="table-responsive" style="clear:both">
                        <table class="table table-striped table-sm">
                            <thead>
                                <tr>
                                    <!-- <th>#</th> -->
                                    <th>id</th>
                                    <th>Supplier</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="ser">
                                <?php
                                $rs = $crud->common_select("suppliers");
                                if ($rs['success'] == 1) {
                                    foreach ($rs['msg'] as $i => $data) {
                                        if ($data->status == 0) {
                                            continue; //to avoid deleted item
                                        }

                                ?>
                                        <tr>
                                            <td><?= ++$i ?></td>
                                            <!-- <td> $data->id </td> -->
                                            <td><?= $data->name ?></td>
                                            <td>
                                                <button value="<?= $data->id ?>" onclick="find_product(<?=$data->id?>)" class="btn btn-outline-primary find_pro">Show products</button>
                                            </td>
                                        </tr>
                                <?php } //end foreach
                                } //end if
                                ?>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>






        </div>
        </main>
    </div>
    </div>
    <?php require_once('../include/footer.php') ?>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="search.js?id=<?= time() ?>"></script>
    <script>
        $("#filter").on("keyup", function() {
            var url = 'search.php';
            $.get(
                url, {
                    'fil_ter': $(this).val()
                },
                function(data) {

                    $("#filter_div").empty();
                    $("#filter_div").html(data);


                }
            )
        })
        function find_product(a){
            var url = 'search.php';
            $.get(url, {'find_pro': a},function(data) {
                $("#filter").attr("disabled","disabled");
                    $("#filter_div").empty();
                    $("#filter_div").html(data);
                })
        }

        var productList = new Array();

        function add_cart(id) {

            $.ajax({
                type: 'POST',
                url: 'search.php',
                data: {
                    'p_id': id
                },
                dataType: 'json',
                encode: true,
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status);
                    alert(thrownError);
                    alert(ajaxOptions);
                }
            }).done(function(data) {
                if (productList.indexOf(data[0]) >= 0) {
                    oldqty = parseFloat($('.row#' + data[0]).find('.qty').val()) + 1;
                    $('.row#' + data[0]).find('.qty').val(oldqty);
                    $('.row#' + data[0]).find('.subtotal').val(oldqty * data[2]);
                } else {
                    productList.push(data[0]);
                    $('.product-data').append('<div class="row" id="' + data[0] + '">\
                                  <div class="col-sm-3">\
                                      <input type="hidden" name="id[]" value="' + data[0] + '">\
                                      <spnn class="name">' + data[1] + '</spnn>\
                                      <input type="hidden" name="supplier_id" value="' + data[0] + '">\
                                  </div>\
                                  <div class="col-sm-3">\
                                      <input type="text" class="form-control qty" onkeyup="change_price(' + data[0] + ')" name="qty[]" value="1">\
                                      <input type="hidden" class="stock" name="stock[]" value="' + data[3] + '">\
                                  </div>\
                                  <div class="col-sm-3">\
                                      <input type="text" class="form-control price" onkeyup="change_price(' + data[0] + ')" name="price[]" value="' + data[2] + '">\
                                  </div>\
                                  <div class="col-sm-3">\
                                      <input type="text" class="form-control subtotal" onkeyup="change_price(' + data[0] + ')" name="subtotal[]" value="' + data[2] + '">\
                                  </div>\
                              </div>');
                }
                change_price(data[0])




                var stock_quantity = data[2];
                $('#qty').blur(function() {
                    var a = $('#qty').val();
                    if (a > stock_quantity) {

                        $("#submit").attr("disabled", true);
                        $("#discount").attr("disabled", true);
                        $("#myModal").modal('show');
                        $(".close").click(function() {
                            $("#myModal").modal('hide')
                        });
                        $('#sale_price').val("");
                    } else {

                        $("#discount").attr("disabled", false);
                        $('#sale_price').val(data[3] * a);
                    }

                });

            })
        }

        function change_price(id) {
            totalqty = parseFloat($('.row#' + id).find('.qty').val());
            price = parseFloat($('.row#' + id).find('.price').val());
            subtotal = totalqty * price;
            $('.row#' + id).find('.subtotal').val(subtotal);
            cal_total()
        }

        function cal_total() {
            var total = 0
            var discount = $('#discount').val()
            $('.subtotal').each(function() {
                total += parseFloat($(this).val());
            });
            if (discount) {
                total = (total - (total * discount / 100))
            }
            $('#Net_price').val(total)

        }
    </script>
    <?php
    //end if
    ?>