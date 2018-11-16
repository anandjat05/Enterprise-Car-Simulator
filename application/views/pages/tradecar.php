<?php ?>


<div class="col-md-12 mb-4 ">
     <!--For form registration message print-->
    
    <!-- RAppointment form starts from here -->      

    <form id="tradeCar" action="" method="post" role="form" enctype="multipart/form-data">
        <h4 class="mb-4"><b>Make appointment with Car Trade Expert & Value Your Vehicle</b></h4>
        <hr class="colorgraph">        

        <div class="panel panel-primary setup-content" id="step-1">    

            <div class="panel-body"> 
                <div class="row">
                    <div class="col-xs-12 col-sm-6 col-md-6">               
                        <div class="form-group">
                            <input type="text" class="form-control" name="name" placeholder="Full Name" required="" 
                                   value="<?php echo!empty($user['name']) ? $user['name'] : ''; ?>">                    
                                   <?php echo form_error('name', '<span class="help-block">', '</span>'); ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-6 col-md-6">
                        <div class="form-group">
                            <input type="text" class="form-control" name="license" placeholder="License Number" required="" 
                                   value="<?php echo!empty($user['license']) ? $user['license'] : ''; ?>">
                                   <?php echo form_error('license', '<span class="help-block">', '</span>'); ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-6 col-md-6">
                        <div class="form-group">
                            <input type="tel" class="form-control" name="cell" placeholder="Phone Number" required=""
                                   accept=""value="<?php echo!empty($user['cell']) ? $user['cell'] : ''; ?>">                    
                                   <?php echo form_error('cell', '<span class="help-block">', '</span>'); ?>
                        </div>
                    </div>
                </div>    
                

                <div class="row">
                    <div class="col-xs-12 col-sm-6 col-md-6">
                        <div class="form-group">
                            <input type="text" class="form-control" name="year" placeholder="Car Year" required="" 
                                   value="<?php echo!empty($user['year']) ? $user['year'] : ''; ?>">                    
                                   <?php echo form_error('year', '<span class="help-block">', '</span>'); ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-6 col-md-6">
                        <div class="form-group">
                            <input type="text" class="form-control" name="make" placeholder="Car Make" required="" 
                                   value="<?php echo!empty($user['make']) ? $user['make'] : ''; ?>">                    
                                   <?php echo form_error('make', '<span class="help-block">', '</span>'); ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-6 col-md-6">
                        <div class="form-group">                   
                          <div class="form-group">
                                <input type="text" class="form-control" name="model" placeholder="Car Model" 
                                       value="<?php echo!empty($user['model']) ? $user['model'] : ''; ?>">                    
                                       <?php echo form_error('model', '<span class="help-block">', '</span>'); ?>
                            </div>
                            
                        </div>   
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-6 col-md-6">
                        <div class="form-group">                   
                          <div class="form-group">
                                <select name = "carcondition" id = "carcondition" class="form-control input-lg">
                                             <option value = "">Select Car Condition</option>
                                             <option value = "Excellent">Excellent</option>
                                             <option value = "Very Good">Very Good</option>
                                             <option value = "Good">Good</option>
                                             <option value = "Somewhat Good">Somewhat Good</option>
                                             <option value = "Bad">Bad</option>
                                             <option value = "Poor">Poor</option>
                                        </select>
                            </div>
                            
                        </div>   
                    </div>
                </div>       
                <div class="row">
                    <div class="col-xs-12 col-sm-6 col-md-6">
                        <div class="form-group">                   
                          <div class="form-group">
                                <input type="text" class="form-control" name="mileDriven" placeholder="Total Mile Driven" 
                                       value="<?php echo!empty($user['mileDriven']) ? $user['mileDriven'] : ''; ?>">                    
                                       <?php echo form_error('mileDriven', '<span class="help-block">', '</span>'); ?>
                                       <hr>
                            </div>
                            
                        </div>   
                    </div>
                </div>     
                
                
            </div>
        </div>

        <div class="row">
             <div class="col-xs-12 col-sm-6 col-md-6">
                <input type="submit" name="appointmentConfirm" id="appointmentConfirm" value="Make an Appointment" class="btn btn-primary btn-block btn-lg" tabindex="7">
            
                <button type="button" class="btn btn-primary btn-lg btn-block" data-toggle="collapse" data-target="#demo" id="makeAppointment" name="makeAppointment">Calculate Your Car Price</button>
            </div>
        </div>


        <hr class="colorgraph">
             
    </form>  

    <!--For message print-->
    <?php
    if (!empty($success_msg)) {
        echo '<p class="statusMsg">' . $success_msg . '</p>';
    } elseif (!empty($error_msg)) {
        echo '<p class="statusMsg">' . $error_msg . '</p>';
    }
    ?>
</div>

<!-- End:  form -->

<div id="demo" class="collapse">  
<div class ="row">
  <div class="col-lg-8 mb-4">
    <div class="row">
        <div class="col-12">
            <div class="row">
                <div class="col-12">
                    <div class="row">
                        <div class="col text-center">
                            <h4 class="mb-4"><b>How Much is My Car Worth?</b></h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 pt-4 text-center">
                            <select name = "year" id = "year" class="form-control input-lg">
                                <option value = "">Select Year</option>
                                <?php
                                foreach ($year as $row) {
                                    # code...for getting years
                                    echo '<option value = "'.$row->years.'">'.$row->years.'</option>';
                                }
                                ?>
                            </select>

                        </div>
                        <div class="col-12 pt-4 text-center">
                            <select name = "make" id = "make" class="form-control input-lg">
                                <option value = "">Select Make</option>
                                <?php
                                foreach ($make as $row) {
                                    # code...for getting years
                                    echo '<option value = "'.$row->make_Id.'">'.$row->make.'</option>';
                                }
                                ?>

                            </select>

                        </div>
                        <div class="col-12 pt-4 text-center">
                            <select name = "model" id = "model" class="form-control input-lg" >
                                <option value = "">Select Model</option>
                            </select>
                        </div>
                        <div class="col-12 pt-4 text-center">
                            <input type="text" name = "mileage" id = "mileage" class="form-control input-lg" placeholder ="Mileage per Gallon" required=""> 
                        </div>
                        <div class="col-12 pt-4 text-center">
                            <input type="text" name = "mileDriven" id = "mileDriven" class="form-control input-lg" placeholder ="Total Miles Driven" required=""> 
                        </div>
                    </div>  
                    <div class="row">
                        <div class="col-12 pt-4 text-center">                            
                            <button type="button" class="btn btn-primary btn-lg btn-block" id="btnCaluclate" name="btnCaluclate">CALCULATE YOUR CAR PRICE</button>
                        </div>                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-lg-4 mb-4" style="padding-top: 100px;">
    <div class="row align-items-center justify-content-md-center" style="background-color: #FF7171; height: 250px; color: #FFF;">
        <div class="col-md-auto text-center">
            <h1>Your Car Price</h1>
            <h3 id="priceValue"></h3>
        </div>
    </div>
</div>      
</div>
</div>
<script type="text/javascript">
    window.addEventListener("load", function(){
        document.getElementById("make").addEventListener("click", function(){
            var make_Id = document.getElementById("make").value;
            if(make_Id !=''){
                $.ajax({
                    url: "<?php echo base_url(); ?>index.php/page/fetch_model",
                    method: "POST",
                    data:{make_Id:make_Id},
                    success:function(data){
                        $('#model').html(data);
                    }

                })
        }//end if-else


        }, false);
         document.getElementById("btnCaluclate").addEventListener("click", function(){
            var make_Id = document.getElementById("make").value;
            var year = document.getElementById("year").value;
            var mileage = validationMileage();
            var mileDriven = validatioMile();
            var model = validateModel();

            var mileagePrice;
            var drivenPrice;
            var basePriceMake;
            var yearPrice;

            if(year != ""){
                if(year ==2011){
                    yearPrice =330;
                }else if(year ==2012){
                    yearPrice =430;
                } else if(year =2013){
                    yearPrice =630;
                }else if(year =2014){
                    yearPrice =745;
                }else if(year =2015){
                    yearPrice =930;
                }else if(year =2016){
                    yearPrice =1330;
                }else if(year =2017){
                    yearPrice =1544;
                }else{
                    yearPrice =2037;
                }//end if-else year price
                }else{
                    alert("Please Select Car Year!");
                }//end if-else



                if(make_Id ==1){
                    basePriceMake = 11400;
                }else if(make_Id ==2){
                    basePriceMake = 10400;
                }else if(make_Id ==3){
                    basePriceMake = 13400;
                }else if(make_Id ==4){
                    basePriceMake = 8400;
                }else if(make_Id ==5){
                    basePriceMake = 12555;
                }else{
                    basePriceMake = 7800;
                }//end if-else make_Id
                    

                if(mileage<=10){
                    mileagePrice =421;
                }else if(mileage>10 && mileage<=20){
                    mileagePrice =842;
                }else if(mileage>20 && mileage<=30){
                    mileagePrice =1684;
                }else{
                    mileagePrice =3368;
                }//end-if/else mileage

                if(mileDriven <=25000){
                    drivenPrice = 8400;
                }else if(mileDriven >25000 && mileDriven <=50000){
                    drivenPrice = 6500;
                }else if(mileDriven >50000 && mileDriven <=75000){
                    drivenPrice = 5400;
                }else if(mileDriven >75000 && mileDriven <=100000){
                    drivenPrice = 4400;
                }else if(mileDriven >100000 && mileDriven <=150000){
                    drivenPrice = 3400;
                }else if(mileDriven >150000 && mileDriven <=200000){
                    drivenPrice = 2200;
                }else if(mileDriven >200000 && mileDriven <=300000){
                    drivenPrice = 1200;
                }else if(mileDriven >300000 && mileDriven <=500000){
                    drivenPrice = 500;
                }else{
                    alert("Mile Driven Value Should be less than 500,000 ");
                }

                var sumPrice = drivenPrice+mileagePrice +basePriceMake+yearPrice;



            document.getElementById("priceValue").innerHTML = "$ "+sumPrice;

         });//end event-listner for button

    }, false);
    function validateModel(){
        var model = document.getElementById("model").value;
        if(model !=""){
            return model;
        }else{
            alert("Model Name is Required!!");
        }//end if-else
    }

    function validationMileage(){
        var mileage = document.getElementById("mileage").value;

        if(mileage != ""){    
            if(!isNaN(mileage)){
                if(mileage < 40){
                    return mileage.trim();
                }else{
                    alert("Mileage Should be less than 40");
                }//end inner if-else
            }else{
                alert("Please Enter Mileage in Number!");
            }//end if-else
        }else{
            alert("Please Enter a Valid Input Mileage");
        }

        
    }
    function validatioMile(){
         var mileDriven = document.getElementById("mileDriven").value;
            if(mileDriven != ""){ 
             if(!isNaN(mileDriven)){
                if(mileDriven < 500000){
                    return mileDriven.trim();
                }else{
                    alert("your vehicle ran more than 500,000 miles, it seems a Salvage ");
                }//end inner if-else
            }else{
                alert("Please Enter Miles in Number Form!");
            }//end if-else
        }else{
            alert("Please Enter a Valid Input Miles");
        }
    }


</script>




