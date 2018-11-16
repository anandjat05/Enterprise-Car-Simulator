<div class="col-md-8">
    <div class="row shadow mb-4 bg-white rounded">                
        <div class="col-8 pt-4">
            <h6>Change Password</h6>
            <form action="" method="post" name="frmChangepass" id="frmChangepass">                                
                <div class="form-group">
                    <input type="password" class="form-control" name="txtCrntPass" placeholder="Password" required="">
                    <?php echo form_error('password', '<span class="help-block">', '</span>'); ?>
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" name="txtNewPass" placeholder="New Password" required="" value="">
                    <?php echo form_error('password', '<span class="help-block">', '</span>'); ?>
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" name="txtConfirmPass" placeholder="Re-enter password" required="">
                    <?php echo form_error('password', '<span class="help-block">', '</span>'); ?>
                </div> 
                <div class="form-group">
                    <input type="submit" value="Change password" name="resetPassSubmit"/>
                </div> 
            </form>            
        </div>        
    </div>
    <div>
        <?php if (isset($successMessage)): ?>
            <div class="alert alert-success" role="alert">
                <strong>Success!</strong> Your password updated successfully.
            </div>
        <?php endif; ?>
        
        <?php if (isset($errorMessage)): ?>
            <div class="alert alert-danger" role="alert">
                <strong>Oops!</strong> <?php echo $errorMessage; ?>.
            </div>
        <?php endif; ?>
    </div>
</div> 