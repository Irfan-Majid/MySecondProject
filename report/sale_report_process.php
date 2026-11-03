<?php
require_once('../class/config.php'); ?>
<?php
require_once('../class/crud.php');
$crud = new crud();
?>
<?php session_start() ?>
<?php
if (!isset($_SESSION['isloged'])) {
  header('location: ../login.php');
}
?>



<!doctype html>
<html lang="en-US">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <title>Default Page Title</title>
  <link href="<?= $base_url ?>assets/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>

  </style>
</head>

<body class="container">
  <?php
  if (isset($_GET['submit'])) {

    $start_date   = $_GET['start-date'];
    $end_date     = $_GET['end-date'];
    $start_date   = date('d-m-Y', strtotime($start_date));
    $end_date   = date('d-m-Y', strtotime($end_date));
    //end if

  ?>


    <div class="sale-head col-12">
      <h1>Inventory Management System - Sales Report</h1>
      <strong><?php if (isset($start_date)) {
                echo $start_date;
              } ?> TILL DATE <?php if (isset($end_date)) {
                                                                              echo $end_date;
                                                                            } ?> </strong>
    </div>
    <div class="row">
      <div class="col-6">
        <table class="table table-border table-responsive">
          <thead>
            <tr>
              <th>Date</th>
              <th>credit Account</th>
              <th>Amount</th>

            </tr>
          </thead>
          <tbody>
            <?php
            $q = "SELECT purchases.*,suppliers.name as supname from purchases join suppliers ON suppliers.id=purchases.supplier where saledate BETWEEN '$start_date' AND '$end_date'";
            $rs = $crud->common_query($q);
            $expenses = 0;
            if ($rs['success'] == 1) {

              foreach ($rs['msg'] as $as) {
            ?>
                <tr>
                  <td>
                    <?= $as->saledate ?>
                  </td>
                  <td>
                    <?= $as->supname ?>
                  </td>
                  <td>
                    <?= $as->total_price ?>
                    <?php $expenses += $as->total_price; ?>
                  </td>
                </tr>
            <?php
              };  //end foreach
            }
            ?>

          </tbody>
          <tfoot>
            <tr class="text-right">
              <td colspan="4"></td>
              <td colspan="1">Grand Total</td>
              <td> $
                <?= $expenses ?>
              </td>
            </tr>
            
          </tfoot>
        </table>
      </div>
      <!-- purchase part -->
      <div class="col-6">
        <table class="table table-border table-responsive">
          <thead>
            <tr>
              <th>Date</th>
              <th>debit Account</th>
              <th>Amount</th>

            </tr>
          </thead>
          <tbody>
            <?php
            $q = "SELECT * from sales where saledate BETWEEN '$start_date' AND '$end_date'";
            $rs = $crud->common_query($q);
            $revenue = 0;
            if ($rs['success'] == 1) {

              foreach ($rs['msg'] as $as) {
            ?>
                <tr>
                  <td>
                    <?= $as->saledate ?>
                  </td>
                  <td>
                    <?= $as->customer_name ?>
                  </td>
                  <td>
                    <?= $as->total_price ?>
                    <?php $revenue += $as->total_price; ?>
                  </td>
                </tr>
            <?php
              };  //end foreach
            }
            ?>

          </tbody>
          <tfoot>
            <tr class="text-right">
              <td colspan="4"></td>
              <td colspan="1">Grand Total</td>
              <td> $<?= $revenue ?>
                <?php ?>
              </td>
            </tr>
            
          </tfoot>
        </table>
      </div>
      <?php 
      if($revenue>$expenses){
        $calulation="profit $".($revenue-$expenses);
      }elseif($revenue<$expenses){
        $calulation="Loss $".($expenses-$revenue);
      }else{
        $calulation="No profit or loss";
      }
      ?>
      <div class="col-12 bg-info"><?=  $calulation ?></div>
    </div>

  <?php
  }
  ?>
</body>

</html>