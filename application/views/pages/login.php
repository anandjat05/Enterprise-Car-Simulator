<?php
/* if(!empty($success_msg)){
  echo '<p class="statusMsg">'.$success_msg.'</p>';
  }
  elseif (!empty ($error_msg)) {
  echo '<p class="statusMsg">'.$error_msg.'</p>';
  } */
?>


<!-- Login form -->
<div class="container">  
    <br>    
    <div>                
        <?php if (isset($error_msg)): ?>
            <div class="alert alert-danger" role="alert">
                <strong>Sorry!! </strong>  <?php echo $error_msg; ?>.
            </div>
        <?php endif; ?>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="row shadow my-4 bg-white rounded" >
                
                <div class="col-8" style="margin-left:80px;">
                    <h5>Sign-In</h5>
                    <form action="" method="post" name="frmLogin" id="frmLogin">
                        <div class="form-group">
                            <input type="email" class="form-control" name="email" placeholder="Enter your Email here" required="" value="">
                            <?php echo form_error('email', '<span class="help-block">', '</span>'); ?>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" name="password" placeholder="Enter your Password" required="">
                            <?php echo form_error('password', '<span class="help-block">', '</span>'); ?>
                        </div> 
                        <div class="form-group">
                            <input type="submit" name="loginSubmit" id="loginSubmit" class="btn-primary" value="Submit" />
                        </div>
                    </form>
                    <p class="footInfo">
                        <small>
                            Don't have an account? <a href="<?php echo base_url(); ?>index.php/page/register">Create a new account</a>
                            <br/>
                            Forgot password? <a href="<?php echo base_url(); ?>index.php/page/resetpassword">Reset</a>
                        </small>
                    </p>
                </div>
            </div>
        </div> 
        <div class="col-md-6" >
            <div style="margin-left:30px;">
                <div class="row shadow my-4 bg-white rounded">
                    <img class="img-fluid" src="<?php echo base_url(); ?>images/footer-images/21.jpg" style="width: 500px; height: 250px;" alt="">
                </div>
            </div>
        </div>      
    </div>
</div>




<!-- End: Login form -->