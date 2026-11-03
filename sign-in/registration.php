<?php require_once('../class/config.php'); ?>
<?php require_once('../class/crud.php'); ?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.83.1">
    <title>SignUp | WDPF R-46</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/sign-in/">

    

    <!-- Bootstrap core CSS -->
<link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

    
    <!-- Custom styles for this template -->
    <link href="signin.css" rel="stylesheet">
  </head>
  <body class="text-center">
    
<main class="form-signin">
  <form action="" method="POST">
    <img class="mb-4" src="../assets/brand/bootstrap-logo.svg" alt="" width="72" height="57">
    <h1 class="h3 mb-3 fw-normal">Please sign up</h1>

    <div class="form-floating">
      <input type="text" name="name" class="form-control" id="floatingInput" placeholder="Your Name">
      <label for="floatingInput">Your Full Name</label>
    </div>
	<div class="form-floating">
      <input type="text" name="user_name" class="form-control" id="floatingInput" placeholder="user name">
      <label for="floatingInput">User name</label>
    </div>
    <div class="form-floating">
      <input type="text" name="contact" class="form-control" id="floatingInput" placeholder="8801---------">
      <label for="floatingInput">Your Contact Number</label>
    </div>

    <div class="form-floating">
      <input type="email" name="email" class="form-control" id="floatingInput" placeholder="name@example.com">
      <label for="floatingInput">Email address</label>
    </div>
	
    <div class="form-floating">
      <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password">
      <label for="floatingPassword">Password</label>
    </div>
    <div class="form-floating">
      <input type="password" name="cpassword" class="form-control" id="floatingPassword" placeholder="Retype Password">
      <label for="floatingPassword">Conform Password</label>
    </div>
    <button class="w-100 btn btn-lg btn-primary" type="submit">Sign Up</button>
	<a href="../login.php"> Login </a>
    <p class="mt-5 mb-3 text-muted">&copy; 2017–2021</p>
  </form>
<?php
	if($_POST){
		$data['name']=$_POST['name'];
		$data['user_name']=$_POST['user_name'];
		$data['contact']=$_POST['contact'];
		$data['email']=$_POST['email'];
		$data['password']=sha1($_POST['password']);
		$data['status']=1;
		$data['created_at']=date('Y-m-d H:i:s');
		if($_POST['password']!== $_POST['cpassword']){
			echo "Both password are not same";
			exit;
		}
		$crud=new crud;
		$rs=$crud->common_insert('users',$data);
		if($rs['success']==1){
			header('location: login.php');
		}else{
			print_r($rs['msg']);
		}
	}
?>
</main>


    
  </body>
</html>
