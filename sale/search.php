<?php 
	require_once('../class/crud.php');
  require_once('../class/config.php');
	$crud=new crud();
 ?>
<?php
    $html = '';
   if(isset($_POST['product_name']) && strlen($_POST['product_name'])){
   $n_ame=$_POST['product_name']; 
     $sq="SELECT name FROM products WHERE name like '%$n_ame%' LIMIT 5";
     /*$sq="SELECT `products`.*,categories.name as catname,brands.name as brand,suppliers.name as supplier FROM `products` join categories on categories.id=products.category_id join brands on brands.id=products.brands_id join suppliers on suppliers.id=products.supplier_id where products.status = 1";*/
	 $rs =$crud->common_query($sq);
     if($rs['msg']){
        foreach ($rs['msg'] as $i=>$data){
           $html .= "<li class=\"list-group-item\">";
           $html .= $data->name/*."<span class='float-right'>brand:".$data->brand*/;
           $html .= "</li>";
		  // endforeach;
      }
	 } 

      echo json_encode($html);
   }
 ?>
 <?php
  if(isset($_POST['p_name']) && strlen($_POST['p_name'])){
   $dat =array();
   $table="products";
   $fields="*";
   $where['name']=$_POST['p_name'];
   $rs =$crud->common_select($table,$fields,$where);
   if($rs['success']){
	   
        foreach ($rs['msg'] as $i=>$data){
			$dat[]=$data->id;
           $dat[]=$data->name;
		   $dat[]=$data->stock;
           $dat[]=$data->sale_price;
		  // endforeach;
      }
	 } 

      echo json_encode($dat);
  }
 ?>

<?php
  /*if(isset($_GET['name']) && strlen($_GET['name'])){
   $dat =[];
   $table="products";
   $fields="*";
   $where['id']=$_GET['name'];
   $rs =$crud->common_select($table,$fields,$where);
   if($rs['msg']){
	   
        foreach ($rs['msg'] as $i=>$data){
		   $dat[]=$data->qty;
           $dat[]=$data->sale_price;
		  // endforeach;
      }
	 } 
   echo json_encode($dat);
  }*/
 ?>
 <?php
 /*product search for edit */
  if(isset($_POST['p_id']) && strlen($_POST['p_id'])){
   $dat =array();
   $table="products";
   $fields="id,name,stock,sale_price";
   $where['id']=$_POST['p_id'];
   $rs =$crud->common_select($table,$fields,$where);
   if($rs['success']){
	   
        foreach ($rs['msg'] as $i=>$data){
          $dat[]=$data->id;
          $dat[]=$data->name;
          $dat[]=$data->sale_price;
          $dat[]=$data->stock;
      }
	 } 

      echo json_encode($dat);
  }
 ?>
 <?php
 /*for filter */
  if(isset($_GET['fil_ter'])){
    $n_ame=$_GET['fil_ter']; 
    $sq="SELECT * FROM products WHERE name like '%$n_ame%' AND status=1";
    $rs =$crud->common_query($sq);
   if($rs['success']){
	   
        foreach ($rs['msg'] as $i=>$data){
?>
         <div class='col-3 pb-2'>
                                <div class='card text-center image-center' style='width: 100%;height: 100%;'>
                                    <img src='<?= $base_url ?>assets/images/<?= $data->image ?>' width='100%' height='100% image-center' />
                                    <h5 class='card-title text-info'>
                                        Product name:
                                        <?= $data->name ?>
                                    </h5>
                                    <div class='card-text'>
                                        <div>
                                            Sale Price:
                                            <?= $data->sale_price ?>
                                        </div>
                                        <div>
                                            Available stock:
                                            <?= $data->stock ?>
                                        </div>
                                    </div>
                                    <button onclick="add_cart(<?= $data->id ?>)" class="bg-info">Add</button>
                                </div>
                            </div><?php
      }
	 } 
  }
 ?>

<?php
 /*for filter */
  if(isset($_GET['fil_ter'])){
    $n_ame=$_GET['fil_ter']; 
    $sq="SELECT * FROM products WHERE supplier_id='$n_ame' AND status=1";
    $rs =$crud->common_query($sq);
   if($rs['success']){
	   
        foreach ($rs['msg'] as $i=>$data){
?>
         <div class="col-lg-2 pb-2 col-md-6">
                                <div class="card text-center image-center" style="width: 100%;height: 100%;">
                                    <img src="<?= $base_url ?>assets/images/<?= $data->image ?>" width="100%" height="100% image-center" />
                                    <h6 class="card-title text-info">
                                        Product name:
                                        <?= $data->name ?>
                                    </h6>
                                    <div class="card-text">
                                        <div>
                                            Sale Price:
                                            <?= $data->sale_price ?>
                                        </div>
                                    </div>
                                    <button onclick="add_cart(<?= $data->id ?>)" class="bg-info" >Add</button>
                                </div>
                            </div>
                            <?php
      }
	 }else{
        ?>
        <div class="bg-info text-white">no product found for the search</div>
   <?php }
  }
 ?>
   