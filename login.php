
<?php require_once('class/crud.php'); ?>
<?php require_once('class/config.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">
  <link rel="stylesheet" href="<?= $base_url ?>css/style.css">
  
</head>

        <!-- Sing in  Form -->
        <section class="sign-in">
            <div class="container">
                <div class="signin-content">
                    <div class="signin-image">
                        <figure><img src="images/signin-image.jpg" alt="sing up image"></figure>
                        <a href="sign-in/registration.php" class="signup-image-link">Create an account</a>
                    </div>

                    <div class="signin-form">
                        <h2 class="form-title">Login</h2>
                        <form method="POST" class="register-form" action="login.php" id="login-form">
                       
                            <div class="form-group">
                                <label for="email"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="email" id="email" required="_required" placeholder="email"/>
                            </div>
                            <div class="form-group">
                                <label for="your_pass"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" name="password" id="password" required="_required" placeholder="Password"/>
                            </div>
                            
                            <div class="form-group form-button">
                                <input type="submit" name="submit" id="submit" class="form-submit" value="Log in"/>
                            </div>
                        </form>
                        <div class="social-login">
                            <span class="social-label">Or login with</span>
                            <ul class="socials">
                                <li><a href="#"><i class="display-flex-center zmdi zmdi-facebook"></i></a></li>
                                <li><a href="#"><i class="display-flex-center zmdi zmdi-twitter"></i></a></li>
                                <li><a href="#"><i class="display-flex-center zmdi zmdi-google"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>
<?php
	if($_POST){
		$wh['email']=$_POST['email'];
		$wh['password']=sha1($_POST['password']);
		$crud=new crud;
		$rs=$crud->common_select('users','*',$wh);
		if($rs['success']==1){
			if($rs['msg'][0]->status=="0"){
				echo "You are inactive user. Please contact to admin";
			}else{
				session_start();
				$_SESSION['id']=$rs['msg'][0]->id;
				$_SESSION['name']=$rs['msg'][0]->name;
				$_SESSION['email']=$rs['msg'][0]->email;
				$_SESSION['isloged']=1;
                $data['last_login']=date('d-M-Y h:i:s');//now()
                $where['id']=$rs['msg'][0]->id;
                $where['name']=$rs['msg'][0]->name;
                $where['email']=$rs['msg'][0]->email;
                $crud->common_update("users",$data,$where);
				header('location: dashboard/index.php');
			}
		}else{
			print_r($rs['msg']);
		}
	}
?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

</body>
</html>