<?php require_once('../include/header.php') ?>
<?php
$olddata=$crud->common_select('suppliers','*',$_GET);
	if($olddata['error']==1){
		echo "<script>window.location.href = '{$base_url}suppliers/index.php?msg=ID invalid';
</script>";

		exit;
	}else{
		$data['status']=0;
		
		$wh['id']=$_GET['id'];
		
		$ins=$crud->common_update('suppliers',$data,$wh);
		
		if($ins['success']){
			
			echo "<script>window.location.href = '{$base_url}suppliers/index.php';
			
		</script>";
		echo "a";
die();
		}else{
			echo $ins['msg'];
		}
	}
?>