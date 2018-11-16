<div class="col-lg-8 mb-4">
    <form method="POST" name="frmCheckoutCart" id="frmCheckoutCart" action="">
        <div class="row">
            <div class="col-12 mb-4">            
                <div class="card h-100 shadow mb-2 bg-white rounded">
                    <h5 class="card-header">Your Address</h5>
                    <div class="col-md-12 order-md-1 pt-3">
                        <?php foreach ($addressinfo as $addrRow): ?>
                            <div class="d-block my-3">
                                <div class="custom-control custom-radio">
                                    <input id="radioShippingaddress<?php echo $addrRow->addrId; ?>" name="radioShippingaddress" type="radio" value="<?php echo $addrRow->addrId; ?>" class="custom-control-input" required>
                                    <label class="custom-control-label" for="radioShippingaddress<?php echo $addrRow->addrId; ?>">
                                        <b>Type: <?php echo $addrRow->addrType; ?></b><br/>
                                        <?php echo $addrRow->streetAddr; ?><br/>
                                        <?php echo $addrRow->addrLine2; ?><br/>
                                        <?php echo $addrRow->state; ?>, <?php echo $addrRow->country; ?>. 
                                        Zip code: <?php echo $addrRow->zipCode; ?><br/>

                                    </label>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <div class="col-12 mb-4">            
                <div class="card h-100 shadow mb-2 bg-white rounded">
                    <h5 class="card-header">Order Summary</h5>
                    <div class="col-md-12 order-md-1 pt-3">                    
                        <ul class="list-group mb-3">
                            <?php foreach ($myCart as $cartItem): ?>
                                <li class="list-group-item d-flex justify-content-between lh-condensed">                                    
                                    <div class="row">
                                        <div class="col-4">
                                            <a href="#"><img src="<?php echo base_url(); ?>assets/uploads/file/<?php echo $cartItem->prodImage; ?>" alt="" width="80" height="50"></a>
                                        </div>
                                        <div class="col-8">
                                            <h6 class="my-0"><?php echo $cartItem->prodName; ?></h6>                                            
                                            
                                            <small class="text-muted">Car Price: $<?php echo $cartItem->prodPrice; ?>&nbsp per day</small>
                                        </div>
                                        
                                    </div>
                                </li>
                            <?php endforeach; ?>
                            <div class = "row">
                            <div class="col-6">
                                           
                                     <small><label for="pickupDate">Pick-Up</label></small>
                                     <input class="form-control" type="date" value="" name="pickupDate" id="pickupDate">   
                            </div>
                            <div class="col-6">
                               
                                     <small><label for="returnDate">Return</label></small>
                                     <input class="form-control" type="date" value="" name="returnDate" id="returnDate">
                            </div> 
                        </div>
                    </ul>
                    </div>
                </div>
            </div>

            <div class="col-12 mb-4">            
                <div class="card h-100 shadow mb-5 bg-white rounded">
                    <h5 class="card-header">Payment</h5>
                    <div class="col-md-12 order-md-1 pt-3">  
                        <?php foreach ($initCart as $initRows): ?>
                            <input type="hidden" name="txtHdnTotal" id="txtHdnTotal" value="<?php echo $initRows->CartTotal; ?>"/>
                        <?php endforeach; ?>
                        <div class="d-block my-3">
                            <div class="custom-control custom-radio">
                                <input id="credit" name="paymentMethod" type="radio" class="custom-control-input" checked required>
                                <label class="custom-control-label" for="credit">Credit card</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input id="debit" name="paymentMethod" type="radio" class="custom-control-input" required>
                                <label class="custom-control-label" for="debit">Debit card</label>
                            </div>
                           
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="cc-name">Name on card</label>
                                <input type="text" class="form-control" name="txtNameOnCard" id="txtNameOnCard" placeholder="Name on Card" required>
                                <small class="text-muted">Full name as displayed on card</small>
                                <div class="invalid-feedback">
                                    Name on card is required
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="cc-number">Credit card number</label>
                                <input type="text" class="form-control" name="txtCardNum" id="txtCardNum" placeholder="Card Number" required>
                                <div class="invalid-feedback">
                                    Credit card number is required
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <label for="cc-expiration">Expiration month</label>
                                <select name="slctExpMonth" class="form-control" >
                                    <option value="01">01</option>
                                    <option value="02">02</option>
                                    <option value="03">03</option>
                                    <option value="04">04</option>
                                    <option value="05">05</option>
                                    <option value="06">06</option>
                                    <option value="07">07</option>
                                    <option value="08">08</option>
                                    <option value="09">09</option>
                                    <option value="10">10</option>
                                    <option value="11">11</option>
                                    <option value="12">12</option>
                                </select>
                                <div class="invalid-feedback">
                                    Expiration date required
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="cc-expiration">Expiration year</label>
                                <input type="text" class="form-control" name="txtExpYear" id="txtExpYear" placeholder="YYYY" required>
                                <div class="invalid-feedback">
                                    Year Exp required
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="cc-expiration">CVV</label>
                                <input type="text" class="form-control" id="txtCardCCV" name="txtCardCCV" placeholder="" required>
                                <div class="invalid-feedback">
                                    Security code required
                                </div>
                            </div>
                        </div>
                        <hr class="mb-4">

                        <input type="submit" class="btn btn-primary btn-lg btn-block" name="btnSubmittoCheckout" id="btnSubmittoCheckout" value="Checkout" />

                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<div class="col-lg-4 mb-4">
    <div class="row">
        <div class="col-12 mb-3">          
            <div class="card h-100 shadow bg-white rounded">                
                <h5 class="card-header">Price Details</h5>
                <div class="card-body">
                    <?php foreach ($initCart as $initRows): ?>
                        <div class="row">
                            <div class="col">
                                <p class="card-text">Price </p>
                            </div>
                            <div class="col text-right">
                                <?php if ($initRows->initDiscount > 0) { ?>
                                    $<?php
                                    echo number_format((float) $initRows->CartTotal, 2, '.', '') + number_format((float) $initRows->initDiscount, 2, '.', '');
                                    ?>
                                <?php } else { ?>
                                    $<?php echo number_format((float) $initRows->CartTotal, 2, '.', ''); ?>
                                <?php } ?>
                            </div>                            
                        </div>                   
                        <div class="row">
                            <div class="col">
                                <p class="card-text">Discount</p>
                            </div>
                            <div class="col text-right">
                                $<?php echo number_format((float) $initRows->initDiscount, 2, '.', ''); ?>
                            </div>                            
                        </div>
                        <hr/>

                        <div class="row">
                            <div class="col">
                                <p class="card-text">Total Price</p>
                            </div>   
                            <div class="col text-right">
                                $<?php echo number_format((float) $initRows->CartTotal, 2, '.', ''); ?>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-12">
                                <p class="card-text" style="color: green;">
                                    <small>
                                        <b id="success_couponcode">
                                            <?php if ($initRows->initDiscount > 0): ?>
                                                1 offer applied
                                            <?php endif; ?>
                                        </b>
                                    </small>
                                </p>
                            </div>                          
                        </div>
                    <?php endforeach; ?>
                </div>                              
                <div class="card-footer">
                    <div class="row">
                        <div class="col-6">
                            <h6>Amount Payable</h6>
                        </div>
                        <div class="col-6">
                            <h6 class="text-right">
                                $<?php echo number_format((float) $initRows->CartTotal, 2, '.', ''); ?>
                            </h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 mb-3">          
            <div class="card h-100 shadow bg-white rounded">                                
                <div class="card-body">                   
                    <div class="row">
                        <form class="card">
                            <div class="input-group">
                                <input type="text" class="form-control" name="txtPlaceHolder" id="txtPlaceHolder" placeholder="Promo code">
                                <?php foreach ($initCart as $initRows): ?>
                                    <input type="hidden" name="findbaseurl" id="findbaseurl" value="<?php echo base_url(); ?>"/>
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-secondary btnRedeemCode" name="btnRedeemCode" id="btnRedeemCode"
                                                data-initid="<?php echo $initRows->InitId; ?>" data-totalamnt="<?php echo $initRows->CartTotal; ?>">Apply Redeem</button>                                        
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </form>
                    </div>
                </div>                                              
            </div>
        </div>

        <?php if (count($myCarPoints) > 0): ?>
            <div class="col-12 mb-3">          
                <div class="card h-100 shadow bg-white rounded"> 
                    <?php foreach ($myCarPoints as $pointRows): ?>
                        <h5 class="card-header">Your total car point is : <?php echo $pointRows->PointEarned; ?></h5>
                        <input type="hidden" name="myTotalCarPoints" id="myTotalCarPoints" value="<?php echo $pointRows->PointEarned; ?>"/>
                        <div class="card-body">                   
                            <div class="row">
                                <?php if ($pointRows->PointEarned > 0): ?>                                
                                    <form class="card">
                                        <div class="input-group">
                                            <input type="text" class="form-control txtApplyCarpoints" name="txtApplyCarpoints" id="txtApplyCarpoints" placeholder="Car points">
                                            <div class="input-group-append">
                                                <?php foreach ($initCart as $initRows): ?>
                                                <button type="button" class="btn btn-secondary btnPawPoints" name="btnApplyCarPoints" id="btnApplyCarPoints"
                                                        data-initid="<?php echo $initRows->InitId; ?>" data-totalamnt="<?php echo $initRows->CartTotal; ?>">Apply points</button>                                        
                                                <?php endforeach; ?>
                                            </div>
                                        </div>
                                    </form>
                                <?php endif; ?>                        
                            </div>
                            <p class="text-warning mt-2 small" id="showNotifications">
                                
                            </p>                           
                        </div>  
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>
    </div>  
</div>


