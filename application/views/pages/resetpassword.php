<?php

?>
<!-- Login form -->
<div class="container">   
    <br>
    <div>
        <?php if (isset($successMessage)): ?>
            <div class="alert alert-success" role="alert">
                <strong>Success!</strong> Your password updated successfully. <?php echo $successMessage; ?>
            </div>
        <?php endif; ?>
        
        <?php if (isset($errorMessage)): ?>
            <div class="alert alert-danger" role="alert">
                <strong>Sorry!</strong> <?php echo $errorMessage; ?>.
            </div>
        <?php endif; ?>
    </div>
    <div class="row justify-content-center my-4">
        <div class="col-md-6">
            <div class="row shadow my-4 bg-white rounded">                
                <div class="col-12">                    
                    <form action="" method="post" name="frmResetLogin" id="frmResetLogin" class="pt-4">
                        <div class="form-group row">

                            <label for="txtResetEmail" class="col-sm-4 col-form-label">Registered Email</label>

                            <div class="col-sm-8">
                                <input type="txtResetEmail" class="form-control" name="txtResetEmail" placeholder="User Registered Email" required="" value="">
                                <?php echo form_error('Email', '<span class="help-block">', '</span>'); ?>
                            </div>
                        </div>
                        <div class="form-group">

                        </div>                       
                        <div class="form-group row">
                            <label for="resetSubmit" class="col-sm-4 col-form-label"> </label>
                            <div class="col-sm-8">
                                <input type="submit" name="resetSubmit" id="resetSubmit" class="btn btn-primary btn-sm" value="Confirm" />
                                <input type="reset" name="clearSubmit" id="resetSubmit" class="btn btn-default btn-sm" value="Reset" />
                            </div>
                        </div>
                    </form>
                    <p class="footInfo">
                        <small>
                            Don't have an account? <a href="<?php echo base_url(); ?>index.php/page/register">Create a new account</a>
                            <br/>
                            Already have an account? <a href="<?php echo base_url(); ?>index.php/page/login">Sign-In</a>
                        </small>
                    </p>
                </div>
            </div>
        </div>         
    </div>
</div>
<!-- End: Login form -->