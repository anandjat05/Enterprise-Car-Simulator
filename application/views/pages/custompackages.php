<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div class="col-lg-8 col-sm-4">
    <div class="row">
        <div class="col text-center mb-4">
            <h3>All Availible Vehicles Here</h3>
            <p>Select the vehicle which you want to test drive.</p>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-sm-4">
            <form id="regForm" action="" method="post" role="form">
                <div class="row">
                    <div class="col">                       
                        <ul class="list-group list-group-flush shadow bg-white rounded">
                            <li class="list-group-item list-group-item-secondary">Attractive Cars for sale</li>
                            <?php foreach ($result as $row): ?>
                                <?php if ($carPackage !== 0): ?>
                                    <?php $checked = 'checked'; ?>
                                <?php endif; ?>

                                <?php if ($row->Category_Name == 'Attractive Cars for Sale'): ?>
                                    <li class="list-group-item">
                                        <input type="checkbox" name="check_Car[]" value="<?php echo $row->pkgId; ?>" 
                                        <?php if ($carPackage == $row->pkgId): ?>
                                            <?php echo $checked; ?>
                                        <?php endif; ?>
                                               /> <label><?php echo $row->pkgName; ?></label></li>                                    
                                    <?php endif; ?>
                                <?php endforeach; ?>
                        </ul>
                    </div>
                    <div class="col">
                        <ul class="list-group list-group-flush shadow bg-white rounded">
                            <li class="list-group-item list-group-item-secondary">Trucks for Sale</li>
                            <?php foreach ($result as $row): ?>
                                <?php if ($row->Category_Name == 'Trucks For Sale'): ?>
                                    <li class="list-group-item">
                                        <input type="checkbox" name="check_Truck[]" value="<?php echo $row->pkgId; ?>" 
                                        <?php if ($carPackage == $row->pkgId): ?>
                                            <?php echo $checked; ?>
                                        <?php endif; ?>
                                               /> <label><?php echo $row->pkgName; ?></label></li>                                    
                                    <?php endif; ?>
                                <?php endforeach; ?>
                        </ul>
                    </div>
                    <div class="col">
                        <ul class="list-group list-group-flush shadow bg-white rounded">
                            <li class="list-group-item list-group-item-secondary">SUV For Sale</li>
                            <?php foreach ($result as $row): ?>
                                <?php if ($row->Category_Name == 'SUV For Sale'): ?>
                                    <li class="list-group-item">
                                        <input type="checkbox" name="check_SUV[]" value="<?php echo $row->pkgId; ?>" 
                                        <?php if ($carPackage == $row->pkgId): ?>
                                            <?php echo $checked; ?>
                                        <?php endif; ?>
                                               /> <label><?php echo $row->pkgName; ?></label>
                                    </li>                                    
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
                <div class="row">
                    <div class="col mt-5">                        
                        <input type="submit" value="Schedule Test Drive" name="btnCustomPackage" id="btnCustomPackage" class="btn btn-success btn-sm"/>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <?php if (isset($selectedVehicle) > 0): ?>
        <div class="row">
            <div class="col my-4">
                <ul class="list-group list-group-flush shadow bg-white rounded">
                    <li class="list-group-item list-group-item-secondary">Make an Appointment | ON-the Wheel</li>
                    <li class="list-group-item">
                        <form name="bookMyCustomPackage" id="bookMyCustomPackage" method="post">
                            <div class="form-row">
                                <div class="col-md-6 mb-3">
                                    <label for="fullName">Full Name</label>
                                    <input type="text" class="form-control" name="fullName" id="fullName" placeholder="Your Full Name" value="" required>
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label for="location">Location</label>
                                    <select name = "location" id = "location" class="form-control" required>
                                             <option value = "">Select ON-the Wheel Location</option>
                                             <option value = "Warrensburg, MO">Warrensburg, MO</option>
                                             <option value = "Kansas City, MO">Kansas City, MO</option>
                                             <option value = "New York, NY">New York, NY</option>
                                             
                                        </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-6 mb-3">
                                    <label for="txtEmailId">Email</label>                                    
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroupPrepend2">@</span>
                                        </div>
                                        <input type="email" class="form-control" name="txtEmailId" id="txtEmailId" placeholder="Email" required>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="txtContactNum">Contact Number</label>
                                    <input type="text" class="form-control" name="txtContactNum" id="txtContactNum" placeholder="Contact Number" required>
                                </div>                                
                            </div>
                            <div class="form-row">
                                <div class="col-md-12 mb-3">
                                    <label for="mSlctPackages">Selected Vehicle for Test Drive</label>
                                    <select multiple class="form-control" id="mSlctPackages[]" name="mSlctPackages[]">
                                        <?php foreach ($result as $row): ?>
                                            <?php foreach ($selectedVehicle as $rowPkgs): ?>
                                                <?php if ($row->pkgId == $rowPkgs): ?>
                                                    <option value="<?php echo $row->pkgId; ?> " selected><?php echo $row->pkgName; ?></option>                                                   
                                                <?php endif; ?>
                                            <?php endforeach; ?>                                        
                                        <?php endforeach; ?>
                                    </select>                                    
                                </div>                                
                            </div>
                            <div class="form-row">
                                <div class="col-md-6 mb-3">
                                    <label for="txtAppoDate">Date</label>
                                    <input class="form-control" type="date" value="" name="txtAppoDate" id="txtAppoDate">
                                </div> 
                                <div class="col-md-6 mb-3">
                                    <label for="txtAppoTime">Time</label>
                                    <input class="form-control" type="time" value="10:10:00" id="txtAppoTime" name="txtAppoTime">
                                </div> 
                            </div>


                            <input class="btn btn-primary" type="submit" name="btnSubmitForAppmnt" value = "Book Appointment" id="btnSubmitForAppmnt"/>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    <?php endif; ?>
    <div class="row">
        <div class="col my-4">
            <?php if (isset($successMessage)): ?>
                <div class="alert alert-success" role="alert">
                    <?php echo $successMessage; ?>
                </div>
            <?php endif; ?>
            <?php if (isset($errorMessage)): ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $errorMessage; ?>
                </div>s
            <?php endif; ?>            
        </div>
    </div>
</div> 
<?php if (isset($pkgConfirmation)): ?>
    <div class="col-lg-12 mb-4">
        <div class="row">
            <div class="col">
                <div class="card h-100 shadow bg-white rounded text-center">
                    <div class="card-header text-muted text-left">
                        <h5>Booking Success</h5>
                    </div>

                    <?php if (isset($pkgCustomMsg)) { ?>
                        <div class="card-body">
                            <h5 class="card-title">
                                <?php echo $pkgCustomMsg; ?>
                            </h5>
                            <p class="card-text"><i class="fa fa-gift" style="font-size:150px; color: #ff6666;"></i></p>
                        </div> 
                    <?php } else { ?>                        
                        <div class="card-body">
                            <h5 class="card-title">
                                <?php echo $pkgConfirmation; ?>
                            </h5>
                            <p class="card-text"><i class="fa fa-check-circle" style="font-size:150px; color: #ff6666;"></i></p>
                        </div>                        
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>