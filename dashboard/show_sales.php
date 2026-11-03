<?php require_once('../class/config.php'); ?>
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
<?php
if ($_GET) {
	$rs = $crud->common_query('SELECT * FROM `sales_details` join sales on sales.id=sales_details.sale_id WHERE sales_details.id=' . $_GET['id']);

	if ($rs['success']) {
?>
		<table>
				<tr>
					<th>sales id:<?= $rs['msg'][0]->sale_id ?></th>
					<th>sold quantiy<?= $rs['msg'][0]->qty ?></th>
					<th>price per unit<?= $rs['msg'][0]->price ?></th>
					<th>Total amount<?= ($rs['msg'][0]->price * $rs['msg'][0]->qty) ?></th>
					<th>discount <?= $rs['msg'][0]->discount ?></th>
					<th>net amount <?= ($rs['msg'][0]->price * $rs['msg'][0]->qty) * ($rs['msg'][0]->discount) / 100 ?></th>
				</tr>
		</table>
<?php
	} else {
	}
}
?>