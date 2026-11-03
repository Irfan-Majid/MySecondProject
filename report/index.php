<?php require_once('../include/header.php') ?>
<div class="container-fluid">
  

  <div class="row">

    <?php require_once('../include/navbar.php') ?>
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="col-md-6">
        <div class="panel">
          <div class="panel-heading">

          </div>
          <div class="panel-body">
            <form class="clearfix" method="get" action="sale_report_process.php">
              <div class="form-group">
                <label class="form-label">Date Range</label>
                <div class="input-group">
                  <input type="date" class="datepicker form-control" name="start-date" placeholder="From">
                  <span class="input-group-addon"><i class="glyphicon glyphicon-menu-right"></i></span>
                  <input type="date" class="datepicker form-control" name="end-date" placeholder="To">
                </div>
              </div>
              <div class="form-group">
                <button type="submit" name="submit" class="btn btn-primary">Generate Report</button>
              </div>
            </form>
          </div>

        </div>
      </div>
    </main>
  </div>
</div>

<?php require_once('../include/footer.php') ?>
