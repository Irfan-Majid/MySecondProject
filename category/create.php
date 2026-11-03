<?php require_once('../include/header.php') ?>

<div class="container-fluid">
  <div class="row">
	<?php require_once('../include/navbar.php') ?>
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Add New Category</h1>
      </div>
	  <div class="row">
		<div class="col-12">
		<form action="" method="post" enctype="multipart/form-data">
			

            <div class="mb-3">
				<label for="name" class="form-label">Name</label>
				<input type="text" class="form-control" name="name" id="name">
			</div>
			
			
			<button type="submit" class="btn btn-primary">Submit</button>
			</form>
			<?php
			if($_POST){
				$data=$_POST;
				$_POST['status']=1;
				$ins=$crud->common_insert('categories',$_POST);
				if($ins['success']){
				echo "<script>window.location.href = '{$base_url}category/index.php';
</script>";
				}else{
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