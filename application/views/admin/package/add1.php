<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><i class="fa fa-cubes"></i> Package <small>Add New</small></h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <div class="row">
        <!-- Login form -->
        <div class="col-md-10 mb-4">            
            <form action="" method="post" id="frmPackage">
                <div class="form-group row">
                    <label for="pkgname" class="col-sm-2 col-form-label">Name <em>*</em></label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="pkgname" placeholder="Package Name" required="" 
                               value="<?php echo!empty($user['pkgname']) ? $user['pkgname'] : ''; ?>">                    
                               <?php echo form_error('pkgname', '<span class="help-block">', '</span>'); ?>
                    </div>                    
                </div>
                <div class="form-group row">
                    <label for="pkgcost" class="col-sm-2 col-form-label">Cost <em>*</em></label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="pkgcost" placeholder="Cost" required="" 
                               value="<?php echo!empty($user['pkgcost']) ? $user['pkgcost'] : ''; ?>">                    
                               <?php echo form_error('pkgcost', '<span class="help-block">', '</span>'); ?>
                    </div>                    
                </div> 
                <div class="form-group row">
                    <label for="pkgImg" class="col-sm-2 col-form-label">Image</label>
                    <div class="col-sm-6">
                        <input type="file" class="form-control" name="pkgImg" placeholder="Image" required="" 
                               value="<?php echo!empty($user['pkgImg']) ? $user['pkgImg'] : ''; ?>">                    
                               <?php echo form_error('pkgImg', '<span class="help-block">', '</span>'); ?>
                    </div>                    
                </div>
                <div class="form-group row">
                    <?php
                    if (!empty($user['pkgType']) && $user['pkgType'] == 'Add-On') {
                        $regular = 'checked="checked"';
                        $addon = '';
                    } else {
                        $addon = 'checked="checked"';
                        $regular = '';
                    }
                    ?>
                    <label for="pkgImg" class="col-sm-2 col-form-label">Type</label>
                    <div class="col-sm-2">
                        <div class="radio">
                            <label>
                                <input type="radio" name="pkgType" value="Bath" <?php echo $regular; ?>>
                                Bath
                            </label>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="radio">
                            <label>
                                <input type="radio" name="pkgType" value="Haircut" <?php echo $regular; ?>>
                                Haircut
                            </label>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="radio">
                            <label>
                                <input type="radio" name="pkgType" value="Add-On" <?php echo $addon; ?>>
                                Add-on
                            </label>
                        </div>
                    </div>
                </div> 
                <div class="form-group row">
                    <label for="pkgDescription" class="col-sm-2 col-form-label">Description <em>*</em></label>
                    <div class="col-sm-6">
                        <textarea class="form-control" placeholder="Package Description" name='pkgDescription' rows="4" required=""
                                  value="<?php echo!empty($user['pkgDescription']) ? $user['pkgDescription'] : ''; ?>"></textarea>
                                  <?php echo form_error('pkgDescription', '<span class="help-block">', '</span>'); ?>
                    </div>                    
                </div>
                <div class="form-group">
                    <input type="submit" name="pkgSubmit" id="pkgSubmit" class="btn-primary" value="Submit" />
                </div>
            </form>                
        </div>
    </div>
    <!-- End: Login form -->