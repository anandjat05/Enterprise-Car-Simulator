<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<footer class="footer_nav">
    <div class="footer_nav_border">
        <div class="container">
            <span style="color: #fff;">Contact On-the Wheel experts : info.onthewheel@gmail.com</span>
           
        
        </div>        
    </div>
    <div class="container footer_nav">
        <div class="row">
            <div class="col-lg-2 mb-2 footer_navmenu">
                <ul>
                    <li><a href="<?php echo base_url(); ?>index.php/page">Home</a></li>
                    <li><a href="<?php echo base_url(); ?>index.php/page/products">Rent</a></li>
                    <li><a href="<?php echo base_url(); ?>index.php/page/packagetype">Buy</a></li>
                </ul>                 
            </div>
            <div class="col-lg-2 mb-2 footer_navmenu">
                <ul>                    
                    <li><a href="<?php echo base_url(); ?>index.php/page/products/4">Cars, SUV, Trucks</a></li>
                    <li><a href="<?php echo base_url(); ?>index.php/page/whyFinanceWithUs">Finance</a></li>
                    <li><a href="<?php echo base_url(); ?>index.php/page/products/2">Minivans & Vans</a></li>
                </ul>                 
            </div>
            <div class="col-lg-2 mb-2 footer_navmenu">
                <ul>
                    <li><a href="<?php echo base_url(); ?>index.php/page/packagetype">Promo Code</a></li>
                    <li><a href="<?php echo base_url(); ?>index.php/page/register">Car Points</a></li> 
                    <li><a href="<?php echo base_url(); ?>index.php/page/login">Sign-Up offers</a></li>                      
                </ul>                 
            </div> 
            <div class="col-lg-2 mb-2 footer_navmenu">
                <ul>
                    <li><a href="<?php echo base_url(); ?>index.php/page/login">Sign-In</a></li>
                    <li><a href="<?php echo base_url(); ?>index.php/page/register">Sign-Up</a></li>
                    <li><a href="<?php echo base_url(); ?>index.php/page/ourlocation">Our Location</a></li>               
                </ul>                 
            </div>           

            <div class="col-lg-4 mb-4 text-right">                  
                <h5>
                    <small class="text-muted">Contact Us</small>
                </h5>                    
                <ul class="list-unstyled">
                    <li class="text-muted">660 238 0623</li>
                    <li class="text-muted">onthewheelInfo@gmail.com</li>
                </ul>
                <a href="#"><span class="fa-stack fa-lg">
                        <i class="fa fa-circle-thin fa-stack-2x"></i>
                        <i class="fa fa-twitter fa-stack-1x"></i>
                    </span></a>

                <a href="#"><span class="fa-stack fa-lg">
                        <i class="fa fa-circle-thin fa-stack-2x"></i>
                        <i class="fa fa-facebook fa-stack-1x"></i>
                    </span></a>

                <a href="#"><span class="fa-stack fa-lg">
                        <i class="fa fa-circle-thin fa-stack-2x"></i>
                        <i class="fa fa-youtube fa-stack-1x"></i>
                    </span></a>

                <a href="#"><span class="fa-stack fa-lg">
                        <i class="fa fa-circle-thin fa-stack-2x"></i>
                        <i class="fa fa-linkedin fa-stack-1x"></i>
                    </span></a>

                <a href="#"><span class="fa-stack fa-lg">
                        <i class="fa fa-circle-thin fa-stack-2x"></i>
                        <i class="fa fa-google-plus fa-stack-1x"></i>
                    </span></a>  
                <p><small class="text-muted">&copy; 2018 All right reserved |  onthewheel.com</small></p>
            </div>
        </div>                    
    </div>
    <!-- /.container -->
</footer>
<!-- Bootstrap core JavaScript -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/vendor/jquery/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>vendor/popper/popper.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>vendor/datepicker/js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/vendor/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>dist/js/bootstrapValidator.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/validation.js"></script>
<?php if(isset($jsFile)): ?>
<script type="text/javascript" src="<?php echo base_url(); ?>js/<?php echo $jsFile; ?>.js"></script>
<?php endif; ?>
<?php
if ($title == 'Products') {
    ?>
    <script type="text/javascript" src="<?php echo base_url(); ?>js/products-validate.js"></script>
    <?php
}
?>
</body>
</html>
