<?php ?>


<div class="col-md-12 mb-4 ">
    
    <!-- Registeration form starts from here -->      

    <form id="regForm" action="" method="post" role="form" enctype="multipart/form-data">
        <h2>Sign Up <small>It's a free On-the wheel account </small></h2>
        <hr class="colorgraph">        

        <div class="panel panel-primary setup-content" id="step-1">    
            <div class="panel-body">                
                <div class="form-group">
                    <input type="text" class="form-control" name="name" placeholder="Name" required="" 
                           value="<?php echo!empty($user['name']) ? $user['name'] : ''; ?>">                    
                           <?php echo form_error('name', '<span class="help-block">', '</span>'); ?>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-6 col-md-6">
                        <div class="form-group">
                            <input type="email" class="form-control" name="email" placeholder="Email" required="" 
                                   value="<?php echo!empty($user['email']) ? $user['email'] : ''; ?>">
                                   <?php echo form_error('email', '<span class="help-block">', '</span>'); ?>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-6">
                        <div class="form-group">
                            <input type="tel" class="form-control" name="phone" placeholder="Phone" required=""
                                   accept=""value="<?php echo!empty($user['phone']) ? $user['phone'] : ''; ?>">                    
                                   <?php echo form_error('name', '<span class="help-block">', '</span>'); ?>
                        </div>
                    </div>
                </div>    
                <div class="row">
                    <div class="col-xs-12 col-sm-6 col-md-6">
                        <div class="form-group">
                            <input type="password" class="form-control" name="password" placeholder="Password" required="">
                            <?php echo form_error('password', '<span class="help-block">', '</span>'); ?>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-6">
                        <div class="form-group">
                            <input type="password" class="form-control" name="conf_password" placeholder="Confirm Password" required="">
                            <?php echo form_error('conf_password', '<span class="help-block">', '</span>'); ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <?php
                    if (!empty($user['gender']) && $user['gender'] == 'Female') {
                        $fcheck = 'checked="checked"';
                        $mcheck = '';
                    } else {
                        $mcheck = 'checked="checked"';
                        $fcheck = '';
                    }
                    ?>
                    <div class="col-xs-12 col-sm-6 col-md-6">
                         <div class="form-group">
                            <label>Gender</label>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-3 col-md-3">
                        <div class="form-group">
                            <div class="radio">
                                <label>
                                    <input type="radio" name="gender" value="Male" <?php echo $mcheck; ?>>
                                    Male
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-3 col-md-3">
                        <div class="form-group">
                            <div class="radio">
                                <label>
                                    <input type="radio" name="gender" value="Female" <?php echo $fcheck; ?>>
                                    Female
                                </label>
                            </div>
                        </div>
                    </div>

                </div>    
                <div class="form-group">
                    <input type="text" class="form-control" name="streetAddress" placeholder="Street Address" required="" 
                           value="<?php echo!empty($user['streetAddress']) ? $user['streetAddress'] : ''; ?>">                    
                           <?php echo form_error('streetAddress', '<span class="help-block">', '</span>'); ?>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-6 col-md-6">
                        <div class="form-group">
                            <input type="text" class="form-control" name="address2" placeholder="Address Line2" required="" 
                                   value="<?php echo!empty($user['address2']) ? $user['address2'] : ''; ?>">                    
                                   <?php echo form_error('address2', '<span class="help-block">', '</span>'); ?>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-6">
                        <div class="form-group">
                            <input type="text" class="form-control" name="state" placeholder="State" required="" 
                                   value="<?php echo!empty($user['state']) ? $user['state'] : ''; ?>">                    
                                   <?php echo form_error('state', '<span class="help-block">', '</span>'); ?>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12 col-sm-6 col-md-6">
                        <div class="form-group">
                            <input type="text" class="form-control" name="country" placeholder="Country" required="" 
                                   value="<?php echo!empty($user['country']) ? $user['country'] : ''; ?>">                    
                                   <?php echo form_error('country', '<span class="help-block">', '</span>'); ?>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-6">
                        <div class="form-group">
                            <input type="text" class="form-control" name="zipcode" placeholder="Zip Code" required="" 
                                   value="<?php echo!empty($user['zipcode']) ? $user['zipcode'] : ''; ?>">                    
                                   <?php echo form_error('zipcode', '<span class="help-block">', '</span>'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">                   
                  <div class="form-group">
                        <input type="text" class="form-control" name="licenseNumber" placeholder="Driver License Number (Optional)" 
                               value="<?php echo!empty($user['licenseNumber']) ? $user['licenseNumber'] : ''; ?>">                    
                               <?php echo form_error('licenseNumber', '<span class="help-block">', '</span>'); ?>
                    </div>
                    
                </div>              
                <div >
                    <div >
                        <span class="button-checkbox">
                            
                            <input type="checkbox" name="tandc" id="tandc" class="hidden" value="1" required="">

                            By clicking <strong class="label label-primary">Register</strong>, you agree to the <a href="#" data-toggle="modal" data-target="#t_and_c_m">Terms and Conditions</a> set out by this site, including our Cookie Use.
                        </span>
                    </div>
                   
                </div>
                <hr>
                
            </div>
        </div>

        <div class=" col-md-6" style="margin-left:280px;">
            <input type="submit" name="regisSumbit" id="regisSumbit" value="Register" class="btn btn-primary btn-block btn-lg" tabindex="7">
        </div>

        <hr class="colorgraph">
             
    </form>    
    <p class="footInfo">Already have an account? <a href="<?php echo base_url(); ?>index.php/page/login">Sign-In here</a></p>
    <!--For form registration message print-->
    <?php
    if (!empty($success_msg)) {
        echo '<p class="statusMsg">' . $success_msg . '</p>';
    } elseif (!empty($error_msg)) {
        echo '<p class="statusMsg">' . $error_msg . '</p>';
    }
    ?>
</div>
<!-- End: Register form -->

<!-- Modal -->
<div class="modal fade" id="t_and_c_m" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel">Terms & Conditions</h4>
            </div>
            <div class="modal-body">
                <p>1. These Terms and Conditions, the rental document signed by you, and a return    record with computed rental charges together constitute the rental agreement between yourself and On-the wheel Rent A Car System, LLC, or the independent Avis System Licensee identified on the rental document (“On- the Wheel”).</p>

                <p>2. You rent from us the car described on the rental document, which rental is solely a bailment for mutual benefit. You agree to the terms below, provided any such term is not prohibited by the law of a jurisdiction covering this rental, which case such law controls. “You” and “your” refer to the person who signs this agreement, “we”, “our” and “us” refer to Avis. You also agree that you are not our agent for any purpose; and that you cannot assign or transfer your obligations</p>

                <p>3.  Any change in this rental agreement or our rights must be in writing and signed by an authorized Avis officer. You further agree that we have the right to change these Terms and Conditions from time to time either upon written notice to you, in paper or electronic form, or upon our posting such changes on the Avis web site. Such changes will apply to rentals that you reserve after such notice has been given, as indicated by the date of such notice, if sent in written form, or the date such changes are posted on the Avis web site, which date will be indicated therein. Changes to the Terms and Conditions will be posted as they occur on the Avis web site at avis.com/terms and will govern all rentals even if the terms provided at time of enrollment are different.</p>

                <p>4. The word “car” means the vehicle rented to you or its replacement and includes tires, tools, equipment, accessories, plates, and documents, unless othewise explicitly specified in this rental agreement.</p>

                <p>5. You represent that you are a capable and validly licensed driver. You agree that we have the right to verify thatyour license has been validly issued and is in good standing; and that we may in our sole discretion refuse to rent to you if your license has been suspended, revoked, otherwise restricted in any way. We reserve the right to deny rentals based upon information about your license status or driving record provided by the Motor Vehicle Department of the jurisdiction that issued your license or any other reliable source in the business of validating an identity. Except where otherwise specifically authorized by applicable law, only you, your spouse or domestic partner, or, if you rent from us under your employer’s corporate account agreement, your employer or a regular fellow employee incidental to business duties may drive the car, but only with your prior permission. The other driver must be at least 25 years old and must also be a capable and validly licensed driver. There may be a charge for each additional driver authorized to drive the car, which will be specified on the rental document.</p>

                <p>6. You will pay for the number of miles/kilometers you drive and the period of time you rent the car at the rate indicated on the rental document, or your applicable corporate rate. The minimum charge is one day (24 hours), unless “calendar day” is indicated on the rental document, plus mileage/kilometerage, or a fixed fee. </p>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">I Agree</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

