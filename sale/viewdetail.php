<!DOCTYPE html>
<html lang="en">
<?php require_once('../class/config.php') ?>
<?php require_once('../class/crud.php');
$crud = new crud();
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <style>
        body {
            background-color: #B0E0E6;
        }

        .head {
            border: 1px solid black;
        }
       
        @media print {
  #printPageButton {
    display: none;
  }
}
    </style>
</head>

<body>
    <?php
    $a = $_GET['id'];
    $rs = $crud->common_select('sales', "*", $_GET);
    $id = $rs['msg'][0]->id;
    $customer_name = $rs['msg'][0]->customer_name;
    $customer_contact = $rs['msg'][0]->customer_contact;
    $total_price = $rs['msg'][0]->total_price;
    $discount = $rs['msg'][0]->discount;
    $pay_status = $rs['msg'][0]->pay_status;
    $saledate = $rs['msg'][0]->saledate;
    ?>

    <div id="editor">
        <div id="htmlContent">
            <div class=" text-center">
                <h5>Inventory Managment system</h5>
                <div>Invoice#:<?= $id ?></div>
                <div>Invoice Date:<?= $saledate ?></div>
            </div>
            <br>
            <div class="container">
                <h6>Bil To:</h6>
                <div><b>Customer name:</b> <?= $customer_name ?></div>
                <div><b>Contact:</b> <?= $customer_contact ?></div>
                <div><b>Payment Status:</b> <?= $pay_status ?></div>
            </div>

            <br>
            <div class="container">
                <table border="0" cellpadding="4" width="100%">
                    <thead class="head">
                        <tr class="text-center">
                            <th class="text-center">Product Name </th>
                            <th> </th>
                            <th> </th>
                            <th> Quantity </th>
                            <th> Unite Price</th>
                            <th>Amount </th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        <?php $abab = "SELECT `sales_details`.*,products.name as proname FROM `sales_details` join products on products.id=sales_details.product_id WHERE sales_details.sale_id = $a";
                        $a = array();
                        $b = array();
                        $rs = $crud->common_query($abab);
                        if ($rs['success'] == 1) {
                            foreach ($rs['msg'] as $i => $data) {
                                $a[] = $data->qty;
                                $b[] = $data->price; ?>
                                <tr>
                                    <td><?= $data->proname ?></td>
                                    <td></td>
                                    <td></td>
                                    <td><?= $data->qty ?></td>
                                    <td><?= $data->price ?></td>
                                    <td><?= ($data->qty) * ($data->price) ?></td>
                                </tr>
                        <?php
                            }
                        }
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <th>Total Bill:
                              <span>  <?php $aaa = 0;
                                for($x = 0; $x < count($a); $x++) {
                                    $aaa += $a[$x] * $b[$x];
                                }
                                echo $aaa;
                                ?></span>

                            </th>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <th>Discount @ <span><?= $discount ?>%: <?= $aaa / 100 * $discount ?></span></th>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <th>Net Price: <span><?= $total_price ?></th></span>
                        </tr>

                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    <!-- <button class="btn btn-info" id="generatePDF">Generate PDF</button> -->
    <button class="btn btn-secondary" onclick="window.print()" id="printPageButton">Click to Print</button>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.5/jspdf.min.js"></script>
    <script type="text/javascript">
        var doc = new jsPDF();
        var specialElementHandlers = {
            '#editor': function(element, renderer) {
                return true;
            }
        };


        // $('#generatePDF').click(function() {
        //     doc.fromHTML($('#htmlContent').html(), 15, 15, {
        //         'width': 700,
        //         'elementHandlers': specialElementHandlers
        //     });
        //     doc.save('sample_file.pdf');
        // });
    </script>

</body>

</html>