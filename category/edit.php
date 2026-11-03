<?php require_once('../include/header.php') ?>

<div class="container-fluid">
  <div class="row">
	<?php require_once('../include/navbar.php') ?>
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Edit Category</h1>
      </div>
	  <div class="row">
		<div class="col-12">

        <?php
	
		$rs=$crud->common_select('categories',"*",$_GET);
        $category_id=$rs['msg'][0]->id;
		
		$category_name=$rs['msg'][0]->name;
		
	?>


		<form action="" method="post" enctype="multipart/form-data">
			
            
            <div class="mb-3">
				<label for="name" class="form-label">name</label>
				<input type="text" class="form-control" name="name" id="name" value="<?=$category_name?>">
			</div>
			
			
			<button type="submit" class="btn btn-primary">Update</button>
			</form>
			<?php
			if($_POST){
				$_POST['status']=1;
				$ins=$crud->common_update('categories',$_POST,$_GET);
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