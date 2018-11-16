<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><i class="fa fa-paw fa-fw"></i> Pet Store - Products <small>Add New</small></h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <?php
    /*
    <div class="row">
        <!-- Login form -->
        <div class="col-md-10 mb-4">            
            <form action="" method="post" id="formProducts" enctype="multipart/form-data">
                <div class="form-group row">
                    <label for="pkgname" class="col-sm-2 col-form-label">Name <em>*</em></label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="prodName" placeholder="Product Name" required="" 
                               value="<?php echo!empty($user['prodName']) ? $user['prodName'] : ''; ?>">                    
                               <?php echo form_error('prodName', '<span class="help-block">', '</span>'); ?>
                    </div>                    
                </div>
                <div class="form-group row">
                    <label for="prodCategory" class="col-sm-2 col-form-label">Category</label>
                    <div class="col-sm-6">
                        <select class="form-control" id="prodCategory" name="prodCategory">
                            <option value="2">Pet Food</option>
                            <option value="3">Pet Wear</option>
                            <option value="4">Pet Toys</option>
                            <option value="5">Gift Pack Goodie Kits</option>
                            <option value="6">Pet DIY Kits</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="pkgcost" class="col-sm-2 col-form-label">Cost <em>*</em></label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="prodCost" placeholder="Product Cost" required="" 
                               value="<?php echo!empty($user['prodCost']) ? $user['prodCost'] : ''; ?>">                    
                               <?php echo form_error('prodCost', '<span class="help-block">', '</span>'); ?>
                    </div>                    
                </div> 
                <div class="form-group row">
                    <label for="pkgImg" class="col-sm-2 col-form-label">Image</label>
                    <div class="col-sm-6">
                        <input type="file" class="form-control" name="prodImg" placeholder="Image" required="" 
                               value="<?php echo!empty($user['prodImg']) ? $user['prodImg'] : ''; ?>">                    
                               <?php echo form_error('prodImg', '<span class="help-block">', '</span>'); ?>
                    </div>                    
                </div>                
                <div class="form-group">
                    <input type="submit" name="prodSubmit" id="pkgSubmit" class="btn-primary" value="Submit" />
                </div>
            </form>                
        </div>        
    </div>
    8?
     * 
     */
    ?>
    <?php echo $output; ?>
    
    <div class="row justify-content-md-center">
        <?php if($this->session->userdata('admsuccess_msg') !== NULL): ?>
        <div class="alert alert-success" role="alert">
            <?php echo $this->session->userdata('admsuccess_msg'); ?>
        </div>
        <?php endif;?>
        <?php if($this->session->userdata('admerror_msg') !== NULL): ?>
        <div class="alert alert-danger" role="alert">
            <?php echo $this->session->userdata('admerror_msg'); ?>
        </div>
        <?php endif;?>
    </div>
    <!-- End: Login form -->