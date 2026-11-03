<?php require_once('../include/header.php') ?>
<div class="container-fluid">
  <div class="row">
    <?php require_once('../include/navbar.php') ?>
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Sales</h1>
      </div>

      <a class="btn btn-primary float-end" href="<?= $base_url ?>sale/create.php">New Sale</a>
      <div class="table-responsive" style="clear:both">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th>id</th>
              <th>Name</th>
              <th>Contact</th>
              <th>Sold Amount</th>
              <th>Status</th>
              <th>Date of sale</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <?php
            $q = "SELECT * from sales";
            $rs = $crud->common_query($q);
            if ($rs['success'] == 1) {
              foreach($rs['msg'] as $as ){?>
              <tr>
                  <td><?=  $as->id ?></td>
                  <td><?=  $as->customer_name?></td>
                  <td><?=  $as->customer_contact?></td>
                  <td><?=  $as->total_price ?></td>
                  <td><?=  $as->pay_status ?></td>
                  <td><?=  $as->saledate ?></td>
                  <td>
                  <a class="btn btn-outline-info" href="viewdetail.php?id=<?=$as->id?>">Show detail</a>
                  </td>
              </tr>
              <?php };  //end foreach
            } //end if
            ?>
          </tbody>
        </table>
      </div>
    </main>
  </div>
</div>
<?php require_once('../include/footer.php') ?>