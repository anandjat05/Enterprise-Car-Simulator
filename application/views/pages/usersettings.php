
<div class="col-lg-8 mb-4">
    <div class="row">
        <div class="col">
            <div class="card h-100 shadow bg-white rounded text-center">
                <div class="card-header text-muted text-left">
                    <h5>My Profile</h5>
                </div>
                <div class="card-body">
                    <form name="frmAddAddress" id="frmAddAddress" class="text-left px-4">
                        <?php foreach ($userDetails as $userRow): ?>
                            <div class="form-group row mb-0">
                                <label for="staticEmail" class="col-sm-2 col-form-label">Name</label>
                                <div class="col-sm-10">
                                    <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="<?php echo $userRow->name; ?>">
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <label for="inputPassword" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="<?php echo $userRow->email; ?>">
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <label for="inputPassword" class="col-sm-2 col-form-label">Phone </label>
                                <div class="col-sm-10">
                                    <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="<?php echo $userRow->phone; ?>">
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <label for="inputPassword" class="col-sm-2 col-form-label">Gender</label>
                                <div class="col-sm-10">
                                    <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="<?php echo $userRow->gender; ?>">
                                </div>
                            </div>                        
                        <?php endforeach; ?>
                    </form>
                    
                </div>                    
            </div>
        </div>
    </div>
</div>
