 
<div class="col-lg-12" style="margin-left:10px;">

    <!-- Preview Image -->
    <img class="img-fluid rounded" src="<?php echo base_url(); ?>images/products/headCar.jpg" alt="" width="1200" />          
</div>

<div class="col-lg-12">
    <div class="row">            
        
        <div class="col-lg-12 col-md-4 col-sm-6 mb-4">
            <h4 class="mt-4 mb-3">Car Models & Products </h4>
            <div class="row">
                <input type="hidden" value="<?php echo base_url(); ?>" id="findbaseurl" name="findbaseurl"/>
                <?php if (count($product)) { ?>
                    <?php foreach ($product as $prod): ?>
                        <div class="col-lg-4 col-md-4 col-sm-6 mb-4">
                            <div class="card h-100 shadow bg-white rounded">
                                <a href="#"><img class="card-img-top" src="<?php echo base_url(); ?>/assets/uploads/file/<?php echo $prod->file_url; ?>" alt="" width="120" height="220"/></a>
                                <div class="card-body">
                                    <table style="width: 100%;">
                                        <tbody style="text-align: center;">
                                            <tr><td><h5><?php echo $prod->Product_Name; ?></h5></td></tr>
                                            <tr><td><h6><?php echo "$".$prod->Product_Price ." per day"; ?></h6></td></tr>
                                            <tr><td><input type="hidden" name="quantity" class="quantity text-center" min="0" value = "1" id="qty<?php echo $prod->product_Id; ?>"/></td></tr>
                                            
                                            <?php foreach ($redeemPoints as $redeem): ?>
                                                <?php if ($redeem->product_Id == $prod->product_Id): ?>
                                                    <?php if ($redeem->offerValue > 0): ?>
                                                        <tr><td><p><small>Point: <?php echo $redeem->offerValue; ?></small></p></td></tr>
                                                    <?php endif; ?>
                                                <?php endif; ?>                                        
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                                <ul class="list-group list-group-flush">                                              
                                    <li class="list-group-item text-center">                            
                                        <button type="button" name="add_cart" class="btn btn-secondary btn-sm add_cart btn-custom" 
                                                data-productname="<?php echo $prod->Product_Name; ?>" data-price="<?php echo $prod->Product_Price; ?>"
                                                data-productid="<?php echo $prod->product_Id; ?>" 
                                                <?php foreach ($redeemPoints as $redeem): ?>
                                                    <?php if ($redeem->product_Id == $prod->product_Id): ?>
                                                        <?php if ($redeem->offerValue > 0): ?>
                                                            data-prodpoint ="<?php echo $redeem->offerValue; ?>"
                                                        <?php endif; ?>
                                                    <?php endif; ?>   
                                                <?php endforeach; ?>>ADD</button>
                                    </li>
                                </ul>
                            </div>
                        </div>   
                    <?php endforeach; ?>                
                <?php }else { ?>
                    <div class="alert alert-light" role="alert">
                        There is no products to list. 
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>

</div>




