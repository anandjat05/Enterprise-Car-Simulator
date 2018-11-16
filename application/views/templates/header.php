<?php
?>
 
<!DOCTYPE html>
<html lang="en">

    <head>  

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

        <title><?php echo $title; ?> |On-the Wheel Car Services</title>

        <!-- Bootstrap core CSS -->
        <link href="<?php echo base_url(); ?>assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>dist/css/bootstrapValidator.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>vendor/datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>css/modern-business.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
        

    </head>
    <body>
        <div class="myCars">
            <div class="container">               
                <div class="row">
                    <div class="col-6">
                        <a class="navbar-brand" href="#">
                            <img src="<?php echo base_url(); ?>images/logo.png" width="90" height="80"/>
                        </a>

                    </div>                                         
                    
                    <div class="col-6 text-right">
                        <div class="dropdown custom-dropdown">
                            <?php
                            if ($this->session->userdata('isUserLoggedIn')) {
                                ?>
                                <label><i><b>Welcome Mr.</b></i></label>
                                <button class="btn btn-link dropdown-toggle" type="button" data-toggle="dropdown" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $this->session->userdata('uName'); ?>
                                    <span class="caret"></span></button>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                    
                                    <a class="dropdown-item" href="<?php echo base_url(); ?>index.php/page/usersettings">Setting</a>
                                </div>

                                <a href="<?php echo base_url(); ?>index.php/page/viewcart"><button type="button" class="btn btn-secondary btn-sm btn-custom">My Cart (<?php
                                        if ($this->session->userdata('cartcount') !== NULL) {
                                            echo $this->session->userdata('cartcount');
                                        } else {
                                            echo ' 0 ';
                                        }
                                        ?>)</button></a>
                                <a href="<?php echo base_url(); ?>index.php/page/logout"><button type="button" class="btn btn-primary btn-sm">Sign-Out</button></a>
                                <?php
                            } else {
                                ?>
                                <a href="<?php echo base_url(); ?>index.php/page/login"><button type="button" class="btn btn-primary btn-sm btn-custom">Sign-In</button></a>&nbsp;&nbsp;
                                <a href="<?php echo base_url(); ?>index.php/page/register"><button type="button" class="btn btn-secondary btn-sm btn-custom">Create an Account</button></a>
                                
                                <?php
                                }
                            ?>
                        </div>

                    </div>                   
                </div>               
            </div>           
        </div>
        <!-- Navigation strts from here -->    
        <nav class="navbar navbar-expand-lg navbar-dark navbar-custom">
            <div class="container">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo base_url(); ?>index.php/page/">Home</a>
                        </li>
                        &nbsp; &nbsp; &nbsp;
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownPetStore" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Rent
                            </a>
                            <div class="dropdown-menu dropdown-menu-left dropdown-menu-custom" aria-labelledby="navbarDropdownPetStore">
                                <a class="dropdown-item" href="<?php echo base_url(); ?>index.php/page/products/4">Start a Car Reservation</a>
                                <a class="dropdown-item" href="<?php echo base_url(); ?>index.php/page/products/2">Start a SUV Reservation</a>
                                <a class="dropdown-item" href="<?php echo base_url(); ?>index.php/page/products/6">Start a Truck Reservation</a>
                                <a class="dropdown-item" href="<?php echo base_url(); ?>index.php/page/products/5">Special Demand - Exotic Cars</a>
                                <a class="dropdown-item" href="<?php echo base_url(); ?>index.php/page/products/3">View | Modify | Cancel</a>
                            </div>
                        </li>  
                        &nbsp; &nbsp; &nbsp;          
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownPetGrooming" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Buy
                            </a>
                            <div class="dropdown-menu dropdown-menu-left dropdown-menu-custom" aria-labelledby="navbarDropdownPetGrooming">
                                <a class="dropdown-item" href="<?php echo base_url(); ?>index.php/page/carpackagetype">Cars, SUV, Trucks</a>
                                <a class="dropdown-item" href="<?php echo base_url(); ?>index.php/page/specialoffers">Special Offers</a>   
                                <!-- reference page of special offer "custompackages" -->             
                            </div>
                        </li>
                        &nbsp; &nbsp; &nbsp;
                        <li class="nav-item dropdown">
                            <a class="nav-link"  href="<?php echo base_url(); ?>index.php/page/tradecar" id="navbarDropdown" aria-haspopup="true" aria-expanded="false">
                               Car Trading
                            </a>
                        </li>
                        &nbsp; &nbsp; &nbsp;
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownPetEvents" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Financing
                            </a>
                            <div class="dropdown-menu dropdown-menu-left dropdown-menu-custom" aria-labelledby="navbarDropdownPetEvents">
                                <a class="dropdown-item" href="<?php echo base_url(); ?>index.php/page/whyFinanceWithUs">Why finance with "ON-the Wheel"</a>
                                <a class="dropdown-item" href="<?php echo base_url(); ?>index.php/page/getprequalified">Get Prequalified</a>                
                                <a class="dropdown-item" href="<?php echo base_url(); ?>index.php/page/autoloancalculator">Auto Loan Calculator</a>                            
                            </div>
                        </li>
                        &nbsp; &nbsp; &nbsp;
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownPetWellness" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                About Us
                            </a>
                            <div class="dropdown-menu dropdown-menu-left dropdown-menu-custom" aria-labelledby="navbarDropdownPetWellness">
                                <a class="dropdown-item" href="<?php echo base_url(); ?>index.php/page/ourlocation">Our Locations</a>                
                                <a class="dropdown-item" href="<?php echo base_url(); ?>index.php/page/carTrading">Car Price Calculator</a>                                               
                            </div>
                        </li>
                       &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; 
                      
                       <li class="nav-item dropdown">
                            <i class="fa fa-sun-o" aria-hidden="true" style="color: yellow; padding-top: 10px;"></i>
                        </li>
                        <li class="nav-item dropdown nav-link">
                            <span id = "showTitle"></span>
                        </li>
                        <li class="nav-item dropdown" style="padding-top: 3px;">
                            <span id = "showWeather"></span>
                        </li>



                    </ul>
                </div>

            </div>
        </nav>
 <script type="text/javascript">
     $(function(){
   
        
        try{
            $.ajax({
                url: "https://query.yahooapis.com/v1/public/yql?q=select%20*%20from%20weather.forecast%20where%20woeid%20in%20(select%20woeid%20from%20geo.places(1)%20where%20text%3D%22warrensburg%2C%20mo%22)&format=json&env=store%3A%2F%2Fdatatables.org%2Falltableswithkeys",
                
                success: function(data){
                    
                    
                    var title = "<h6>"+data.query.results.channel.location.city+","+data.query.results.channel.location.region+"</h6>";
                    var weather = "<h4>"+data.query.results.channel.item.condition.temp+"° F</h4>";
                    
                    $("#showTitle").html(title);
                    $("#showWeather").html(weather);
                    
                },//end callback function for success
                error: function(xhr, textStatus, errorThrown){
                    alert("An error occured!"+ (errorThrown? errorThrown: xhr.status ));
                }//error
            });//ajax
            
        }catch(ex){
            alert(ex);
        }//end try catch
        
});//end ready

 </script>
