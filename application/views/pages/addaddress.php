
<div class="col-lg-8 mb-4">
    <div class="row">
        <div class="col">
            <div class="card h-100 shadow bg-white rounded text-center">
                <div class="card-header text-muted text-left">
                    <div class="row">
                        <div class="col-6">
                            <h5>My Profile - address</h5>
                        </div>
                        <div class="col-6 text-right">
                            <?php if (isset($AddMyAddress)): ?>
                                <a href="<?php echo base_url(); ?>index.php/page/addaddress/view" class="btn btn-primary btn-sm">View Address</a>
                            <?php endif; ?>
                            <?php if (isset($EditMyAddress)): ?>
                                <a href="<?php echo base_url(); ?>index.php/page/addaddress/view" class="btn btn-primary btn-sm">View Address</a>
                            <?php endif; ?>
                            <?php if (isset($ViewMyAddress)): ?>
                                <a href="<?php echo base_url(); ?>index.php/page/addaddress/add" class="btn btn-primary btn-sm">Add address</a>
                            <?php endif; ?>
                        </div>
                    </div>                                        
                </div>
                <div class="card-body">
                    <form name="frmAddAddress" id="frmAddAddress" method="POST" class="text-left px-4">
                        <?php if (isset($ViewMyAddress)): ?>
                            <?php foreach ($ViewMyAddress as $viewRow): ?>
                                <div class="form-group row mb-0">
                                    <label for="staticEmail" class="col-sm-2 col-form-label">Type</label>
                                    <div class="col-sm-10">
                                        <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="<?php echo $viewRow->addrType; ?>">
                                    </div>
                                </div>
                                <div class="form-group row mb-0">
                                    <label for="inputPassword" class="col-sm-2 col-form-label">Address</label>
                                    <div class="col-sm-10">
                                        <label><?php echo $viewRow->streetAddr; ?></label><br/>
                                        <label><?php echo $viewRow->addrLine2; ?></label><br/>
                                        <label><?php echo $viewRow->state; ?></label>,
                                        <label><?php echo $viewRow->country; ?></label>.
                                        <label>Zip Code: <?php echo $viewRow->zipCode; ?></label>.<br/>
                                        <label>
                                            <a href="<?php echo base_url(); ?>index.php/page/addaddress/edit/<?php echo $viewRow->addrId; ?>" >Edit My Address</a>
                                        </label>

                                    </div>
                                </div>                                                                                              
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </form>
                    <?php if (isset($AddMyAddress)): ?>
                        <form name="frmAddMyAddress" id="frmAddMyAddress" method="POST" >
                            <div class="form-group text-left">
                                <label for="slctAddressType" >Select Type</label>
                                <select class="form-control" id="slctAddressType" name="slctAddressType">
                                    <option value="Permanent">Permanent</option>
                                    <option value="Home">Home</option>
                                    <option value="Office">Office</option>                                    
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="streetAddress" placeholder="Street Address" value="">                                                           
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="address2" placeholder="Address Line2" value="">                    

                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="state" placeholder="State" value="">                    
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xs-12 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="country" placeholder="Country" value="">                    

                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="zipcode" placeholder="Zip Code" value="">                                                                   
                                    </div>
                                </div>
                            </div>
                            <div class="row text-left">
                                <div class="col-xs-12 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <input type="submit" name="btnAddMyAddress" id="btnAddMyAddress" value="Save Address" class="btn btn-primary btn-sm"/>
                                    </div>
                                </div>
                            </div>
                        </form> 
                    <?php endif; ?>


                    <?php if (isset($EditMyAddress)): ?>
                        <?php foreach ($EditMyAddress as $rowView): ?>
                            <form name="frmEditMyAddress" id="frmEditMyAddress" method="POST" >
                                <div class="form-group row mb-0">
                                    <label for="staticEmail" class="col-sm-2 col-form-label">Type</label>
                                    <div class="col-sm-10">
                                        <input type="text" readonly class="form-control-plaintext" id="txtEditAddrType" name="txtEditAddrType"
                                               value="<?php echo!empty($rowView->addrType) ? $rowView->addrType : ''; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="text" id="txtEditstreetAddress" class="form-control" name="txtEditstreetAddress" placeholder="Street Address" required="" 
                                           value="<?php echo!empty($rowView->streetAddr) ? $rowView->streetAddr : ''; ?>">                    

                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="txtEditaddrLine2" id="txtEditaddrLine2" placeholder="Address Line2" required="" 
                                                   value="<?php echo!empty($rowView->addrLine2) ? $rowView->addrLine2 : ''; ?>">                    

                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="txtEditstate" id="txtEditstate" placeholder="State" required="" 
                                                   value="<?php echo!empty($rowView->state) ? $rowView->state : ''; ?>">                    

                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-xs-12 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="txtEditcountry" id="txtEditcountry" placeholder="Country" required="" 
                                                   value="<?php echo!empty($rowView->country) ? $rowView->country : ''; ?>">                    

                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="txtEditzipcode" id="txtEditzipcode" placeholder="Zip Code" required="" 
                                                   value="<?php echo!empty($rowView->zipCode) ? $rowView->zipCode : ''; ?>">                    

                                        </div>
                                    </div>
                                </div>
                                <div class="row text-left">
                                    <div class="col-xs-12 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <input type="submit" name="btnEditMyAddress" id="btnEditMyAddress" value="Save Changes" class="btn btn-primary btn-sm"/>
                                        </div>
                                    </div>
                                </div>
                            </form> 
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>                    
            </div>
        </div>
    </div>
</div>
