<?php if (count($myCart) > 0) { ?>
    <div class="col-lg-8 mb-4">
        <div class="row">
            <div class="col">
                <div class="card h-100 shadow bg-white rounded">
                    <h5 class="card-header">My Cart</h5>
                    <div class="card-body">

                        <div class="row">
                            <?php foreach ($myCart as $cartItem): ?>
                                <div class="col-12 pt-2">
                                    <div class="row">
                                        <div class="col-2">
                                            <a href="#"><img class="img-thumbnail" src="<?php echo base_url(); ?>assets/uploads/file/<?php echo $cartItem->prodImage; ?>" alt="" width="100" height="100"></a>                                        
                                            <div class="row">
                                                <div class="col mt-1">
                                                    
                                                    <input type="hidden" value="<?php echo base_url(); ?>" id="findbaseurl" name="findbaseurl"/>
                                                    <input type="hidden" value="<?php echo $cartItem->CartId; ?>" id="hdnCartId" name="hdnCartId"/>                                                
                                                </div>
                                                
                                            </div>

                                        </div>
                                        <div class="col-3">
                                            <ul class="list-group border-0">
                                                <li class="list-group-item border-0">
                                                    <h6><?php echo $cartItem->prodName; ?></h6>
                                                    <p><small>
                                                            Price: $<?php echo number_format((float) $cartItem->prodPrice, 2, '.', ''); ?>

                                                        </small>
                                                    </p>      
                                                    <p><small><a href="<?php echo base_url(); ?>index.php/page/removecart/<?php echo $cartItem->CartId; ?>">Remove Items</a></small></p>                                                
                                                </li>                                             
                                            </ul>
                                        </div>
                                        
                                    </div>
                                </div>          

                            <?php endforeach; ?>
                            <div class="text-center">
                                 <p><small><a href="<?php echo base_url(); ?>index.php/page/products/3">Do you want to add Car Accessories.</a></small></p>
                            </div>
                        </div>
                        <?php
                        $totPrice = 0;
                        $amt = 0;
                       
                        foreach ($myCart as $cartItem) {
                            $amt = ($cartItem->prodPrice );
                            $totPrice = $totPrice + $amt;
                        }
                        ?>  
                    </div>
                    <div class="card-footer">
                        <a href="<?php echo base_url(); ?>index.php/page/products/4" class="btn btn-primary">Continue Shopping</a>
                        
                        <button type="button" name="btn_initcart" class="btn btn-danger btn_initcart" data-productid="<?php echo $cartItem->product_Id; ?>"
                                data-cartid="<?php echo $cartItem->CartId; ?>" data-total="<?php echo $totPrice ?>" >Initiate Checkout</button>
                    </div>
                </div>
            </div>
        </div>  

    </div>
    <div class="col-lg-4 mb-4">
        <div class="row">
            <div class="col">
                <?php
                $totalPrice = 0;
                $price = 0;
                $count = 0;
                foreach ($myCart as $cartItem) {
                    $price = ($cartItem->prodPrice );
                    $totalPrice = $totalPrice + $price;
                    $count ++;
                }
                ?>  
                <div class="card h-100 shadow bg-white rounded">
                    <h5 class="card-header">Price Details</h5>
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <p class="card-text">Price (<?php echo $count; ?> items)</p>
                            </div>
                            <div class="col">
                                <?php echo number_format((float) $totalPrice, 2, '.', ''); ?>
                            </div>                            
                        </div>                                       
                    </div>                              
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-6">
                                <h6>Amount Payable</h6>
                            </div>
                            <div class="col-6">
                                <h6 class="text-right">
                                    $<?php echo number_format((float) $totalPrice, 2, '.', ''); ?>
                                </h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>  
    </div>
<?php } else { ?>
    <div class="col-lg-12 mb-4">
        <div class="row">
            <div class="col">
                <div class="card h-100 shadow bg-white rounded text-center">
                    <div class="card-header text-muted text-left">
                        <h5>My Cart</h5>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Your cart is empty</h5>
                        <p class="card-text"><i class="fa fa-cart-arrow-down" style="font-size:150px; color: #CECECE;"></i></p>                       
                    </div>                    
                </div>
            </div>
        </div>
    </div>
<?php } ?>
