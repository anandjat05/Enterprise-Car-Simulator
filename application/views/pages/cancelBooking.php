<div class="col-lg-8 mb-4">
	<form method="POST" name="frmCancel" id="frmCancel" action="">
		<div class="row">
	        <div class="col">
	        	<div class="card h-100 shadow bg-white rounded text-center">
	                <div class="card-header text-muted text-left">
	                    <h5>Cancel Your Booking</h5>
	                </div>
	                <div class="card-body" >
                	<?php foreach ($userInfo as $user): ?>
                		<input type="hidden" name="email_Id" name="email_Id" value="<?php echo $user->email; ?>">
                	<?php endforeach; ?>
	                	<label>Please Select your Order Id # </label>&nbsp;
	        			<select name = "orderId" id = "orderId">
                                <option value = "">Select Order Id</option>
                                <?php
                                foreach ($orderInfo as $row) {
                                    # getting all previeous orders
                                    echo '<option value = "'.$row->OrderId.'">'.$row->OrderId.'</option>';
                                }
                                ?>
                        </select>&nbsp;
	        			<input type="submit" class="btn btn-primary" name="btnSubmitCancel" id="btnSubmitCancel" value="Confirm Cancel Booking" />
	        		</div>
	        	</div>	
	    	</div>
	    </div>
	</br></br>

	    <div class="row">
	        <div class="col">
	            <div class="card h-100 shadow bg-white rounded text-center">
	                <div class="card-header text-muted text-left">
	                    <h5>Your All Available Booking</h5>
	                </div>
	                <div class="card-body">
	                    <table class="table">
	                        <thead>
	                            <tr>
	                                <th scope="col"># Order</th>
	                                <th scope="col">Total Amount</th>                                
	                                <th scope="col">Pick-Up Date</th>
	                                <th scope="col">Return Date</th>
	                                <!--<th scope="col">View</th>-->
	                            </tr>
	                        </thead>
	                        <tbody>
	                            <?php foreach ($orderRecord as $orderRows): ?>
	                                <?php $count = 1; ?>
	                                <tr>
	                                    <th scope="row"># <?php echo $orderRows->OrderId; ?></th>
	                                    <td><?php echo "$ ".$orderRows->TotalAmnt; ?></td>
	                                    <td><?php echo $orderRows->pickupDate; ?></td>
	                                    <td><?php echo $orderRows->returnDate; ?></td>
	                                </tr>
	                                <?php $count++; ?>
	                            <?php endforeach; ?>                            
	                        </tbody>
	                    </table>

	                </div>                    
	            </div>
	        </div>
	    </div>
	</form>
</div>
