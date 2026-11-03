<?php require_once('../include/header.php') ?>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" />
<style>
  .card-footer {
    background-color: #ffe3e3;
  }

  .card-header {
    background-color: #00c1d4;
  }
</style>
<div class="container-fluid">
  <div class="row">
    <?php require_once('../include/navbar.php') ?>
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Dashboard</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group me-2">
            <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
            <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
          </div>
          <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
            <span data-feather="calendar"></span>
            This week
          </button>
        </div>
      </div>

      <div class="col-lg-12 card-columns">
        <div class="row p-3">
          <div class="col-md-3">
            <div class="card">
              <div class="card-header text-white">
                <div class="row align-items-center">
                  <div class="col">
                    <h1><i class="bi bi-cart-plus"></i></h1>
                  </div>
                  <div class="col">
                    <h2 class="display">
                      <?php
                      $sql = "SELECT COUNT(id) AS total FROM products";
                      $olddata = $crud->common_query($sql);
                      echo ($olddata['msg'][0]->total); ?>

                    </h2>
                    <h6>Products</h6>
                  </div>
                </div>
              </div>
              <div class="card-footer">
                <h4>
                  <a href="<?= $base_url ?>products/index.php" class="text-primary">View details <i class="bi bi-arrow-right-circle-fill"></i></a>
                </h4>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="card">
              <div class="card-header text-white">
                <div class="row align-items-center">
                  <div class="col">
                    <h1><i class="bi bi-bag-dash"></i></h1>
                  </div>
                  <div class="col">
                    <h2 class="display">
                      <?php
                      $sql = "SELECT COUNT(id) AS total FROM brands";
                      $olddata = $crud->common_query($sql);
                      echo ($olddata['msg'][0]->total); ?>
                    </h2>
                    <h6>Brands</h6>
                  </div>
                </div>
              </div>
              <div class="card-footer">
                <h4>
                  <a href="<?= $base_url ?>brand/index.php" class="text-primary">View details <i class="bi bi-arrow-right-circle-fill"></i></a>
                </h4>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="card">
              <div class="card-header text-white">
                <div class="row align-items-center">
                  <div class="col">
                    <h1><i class="bi bi-card-list"></i></h1>
                  </div>
                  <div class="col">
                    <h2 class="display">
                      <?php
                      $sql = "SELECT COUNT(id) AS total FROM categories";
                      $olddata = $crud->common_query($sql);
                      echo ($olddata['msg'][0]->total); ?>
                    </h2>
                    <h6>Categories</h6>
                  </div>
                </div>
              </div>
              <div class="card-footer">
                <h4>
                  <a href="<?= $base_url ?>category/index.php" class="text-primary">View details <i class="bi bi-arrow-right-circle-fill"></i></a>
                </h4>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="card">
              <div class="card-header text-white">
                <div class="row align-items-center">
                  <div class="col">
                    <h1><i class="bi bi-truck"></i></h1>
                  </div>
                  <div class="col">
                    <h2 class="display">
                      <?php
                      $sql = "SELECT COUNT(id) AS total FROM suppliers";
                      $olddata = $crud->common_query($sql);
                      echo ($olddata['msg'][0]->total); ?>
                    </h2>
                    <h6>suppliers</h6>
                  </div>
                </div>
              </div>
              <div class="card-footer">
                <h4>
                  <a href="<?= $base_url ?>suppliers/index.php" class="text-primary">View details <i class="bi bi-arrow-right-circle-fill"></i></a>
                </h4>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="bg-white pd-20 card-box mb-30 col-12">
        <h4 class="h4 text-blue">Comparetive statement of last five days</h4>
        <div id="chart2"></div>
      </div>
      <div class="row">
        <div class="col-md-4">
          <div class="panel panel-default">
            <div class="panel-heading">
              <strong>
                <span class="glyphicon glyphicon-th"></span>
                <span>Highest Selling Products</span>
              </strong>
            </div>
            <div class="panel-body">
              <table class="table table-striped table-bordered table-condensed">
                <thead>
                  <tr>
                    <th>Title</th>
                    <th>Number of order</th>
                    <th>Total Quantity</th>
                  <tr>
                </thead>
                <tbody>
                  <?php
                  $sql  = "SELECT p.name, COUNT(s.product_id) AS totalSold, SUM(s.qty) AS totalQty FROM sales_details s LEFT JOIN products p ON p.id = s.product_id GROUP BY s.product_id ORDER BY SUM(s.qty) DESC LIMIT 5";
                  $olddata = $crud->common_query($sql);
                  foreach ($olddata['msg'] as  $product_sold) : ?>
                    <tr>
                      <td><?= $product_sold->name ?></td>
                      <td><?= $product_sold->totalSold ?></td>
                      <td><?= $product_sold->totalQty ?></td>
                    </tr>
                  <?php endforeach; ?>
                <tbody>
              </table>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="panel panel-default">
            <div class="panel-heading">
              <strong>
                <span class="glyphicon glyphicon-th"></span>
                <span>LATEST SALES</span>
              </strong>
            </div>
            <div class="panel-body">
              <table class="table table-striped table-bordered table-condensed">
                <thead>
                  <tr>
                    <th class="text-center" style="width: 50px;">#</th>
                    <th>Product Name</th>
                    <th>Date</th>
                    <th>Total Sale</th>
                  </tr>
                </thead>
                <?php $sql  = "SELECT sl.saledate as date,sl.discount as dis,s.id,s.qty,s.price,p.name FROM sales_details s LEFT JOIN products p ON s.product_id = p.id Join sales sl on s.sale_id=sl.id ORDER BY sl.saledate DESC limit 5";
                $olddata = $crud->common_query($sql);
                ?>
                <tbody>
                  <?php foreach ($olddata['msg'] as  $recent_sale) : ?>
                    <tr>
                      <td class="text-center"><?php ?></td>
                      <td>
                        <a href="show_sales.php?id=<?= $recent_sale->id ?>">
                          <?= $recent_sale->name ?>
                        </a>
                      </td>
                      <td><?= $recent_sale->date ?></td>
                      <td>TK<?= (($recent_sale->qty) * ($recent_sale->price) * (1 - (($recent_sale->dis) / 100))) ?></td>
                    </tr>

                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="panel panel-default">
            <div class="panel-heading">
              <strong>
                <span class="glyphicon glyphicon-th"></span>
                <span>Products running low</span>
              </strong>
            </div>
            <div class="panel-body">
              <table class="table table-striped table-bordered table-condensed">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Name of product</th>
                    <th>Available stock</th>
                    <th></th>
                  <tr>
                </thead>
                <tbody>
                  <?php
                  $sql  = "SELECT id,name,stock FROM `products`order by stock limit 5";
                  $olddata = $crud->common_query($sql);
                  foreach ($olddata['msg'] as  $product_sold) : ?>
                    <tr>
                      <td><?= $product_sold->id ?></td>
                      <td><?= $product_sold->name ?></td>
                      <td><?= $product_sold->stock ?></td>
                      <td><a href="<?= $base_url ?>purchase/create.php" class="btn btn-outline-info">Order now</a></td>
                    </tr>
                  <?php endforeach; ?>
                <tbody>
              </table>
            </div>
          </div>
        </div>
      </div>


    </main>
  </div>
</div>
<script src="apexcharts/apexcharts.min.js"></script>

<script src="apexcharts-setting.js"></script>

<script>
  var asasa = new Array;
  var dadada = new Array;
  <?php
  $rs = $crud->common_query("SELECT saledate AS date, SUM(total_price) AS total_pr FROM sales GROUP BY date order by date limit 5");
  if ($rs['success'] == 1) {
    foreach ($rs['msg'] as $i => $data) { ?>
      asasa[<?= $i ?>] = <?= $data->total_pr ?>;
      dadada[<?= $i ?>] = "<?= $data->date ?>";
  <?php }
  }
  ?>
  var bsbsb = new Array;
  var dbdbdb = new Array;
  <?php
  $rs = $crud->common_query("SELECT saledate AS date, SUM(total_price) AS total_pr FROM purchases GROUP BY date order by date limit 5");
  if ($rs['success'] == 1) {
    foreach ($rs['msg'] as $i => $data) { ?>
      bsbsb[<?= $i ?>] = <?= $data->total_pr ?>;
      dbdbdb[<?= $i ?>] = "<?= $data->date ?>";
  <?php }
  }
  ?>
  var options2 = {
    series: [{
      name: 'sales',
      data: [asasa[0], asasa[1], asasa[2], asasa[3], asasa[4]]
    }, {
      name: 'purchases',
      data: [bsbsb[0], bsbsb[1], bsbsb[2], bsbsb[3], bsbsb[4]]
    }],
    chart: {
      height: 350,
      type: 'area',
      toolbar: {
        show: true,
      }
    },
    grid: {
      show: true,
      padding: {
        left: 30,
        right: 0
      }
    },
    dataLabels: {
      enabled: true
    },
    stroke: {
      curve: 'smooth'
    },
    xaxis: {
      type: 'category',
      categories: [dadada[0], dadada[1], dadada[2], dadada[3], dadada[4], ]
    },
    tooltip: {
      x: {
        format: 'dd/MM/yy'
      },
    },
  };
  var chart = new ApexCharts(document.querySelector("#chart2"), options2);
  chart.render();
</script>
<?php require_once('../include/footer.php') ?>