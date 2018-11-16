<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<html>
    <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo $title; ?></title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<!-- All the files that are required -->
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link href='http://fonts.googleapis.com/css?family=Varela+Round' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/admin/login-admin.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.13.1/jquery.validate.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    </head>
<!-- Login form -->
      <!--  <div class="col-md-5 mb-4">
            <h5>Login</h5>
            <form action="" method="post">
                <div class="form-group">
                    <input type="email" class="form-control" name="email" placeholder="Email" required="" value="">
                    <?php echo form_error('email', '<span class="help-block">', '</span>'); ?>
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" name="password" placeholder="Password" required="">
                    <?php echo form_error('password', '<span class="help-block">', '</span>'); ?>
                </div> 
                <div class="form-group">
                    <input type="submit" name="loginSubmit" class="btn-primary" value="Submit" />
                </div>
            </form>    
            <p class="footInfo">Don't have an account? <a href="<?php echo base_url(); ?>index.php/page/register">Register here</a></p>
        </div> -->
<!-- End: Login form -->

<body>
<!-- LOGIN FORM -->
<div class="text-center" style="padding:50px 0">
	<div class="logo">login</div>
	<!-- Main Form -->
	<div class="login-form-1">
		<form id="login-form" class="text-left" action="" method="post">
			<div class="login-form-main-message"></div>
			<div class="main-login-form">
				<div class="login-group">
					<div class="form-group">
                                            <label for="username" class="sr-only">User Name</label>
                                            <input type="text" class="form-control" name="username" placeholder="Username" required="" value="">
                                            <?php echo form_error('username', '<span class="help-block">', '</span>'); ?>  						
					</div>
					<div class="form-group">
                                            <label for="password" class="sr-only">Password</label>
                                            <input type="password" class="form-control" name="password" placeholder="Password" required="">
                                            <?php echo form_error('password', '<span class="help-block">', '</span>'); ?>												
					</div>
					<!--<div class="form-group login-group-checkbox">
						<input type="checkbox" id="lg_remember" name="lg_remember">
						<label for="lg_remember">remember</label>
					</div>-->
				</div>
                            <!--<button type="submit" name="loginSubmit" class="login-button"><i class="fa fa-chevron-right"></i></button>-->
                            <input type="submit" name="loginSubmit" class="login-button fa fa-chevron-right" value="Submit" />
			</div>
			<div class="etc-login-form">
				<p>forgot your password? <a href="#">click here</a></p>				
			</div>
		</form>
	</div>
	<!-- end:Main Form -->
        <div class="container">
            <div class="row">
                <div class="col-md-12 mb-4">
                    <?php 
                        if(!empty($success_msg)){                  
                            echo '<div class="alert alert-success" role="alert">'.$success_msg.'</div>';
                        }
                        elseif (!empty ($error_msg)) {
                            echo '<div class="alert alert-danger" role="alert">'.$error_msg.'</div>';
                        }
                    ?>
                </div>
            </div>
        </div>
        
</div>

</body>
</html>

