
<div class="section-container" style="max-width: 900px; width: 100%; margin: auto;padding-top: 50px; text-align: center; padding-bottom: 30px">
            <h1 class="learn-financing-hero-title" id="learn-financing-hero-header" data-cv-test="Cv.LearnFinancing.H1">Finance with ON-the Wheel</h1>
            <p class="learn-financing-hero-text">Financing with ON-the Wheel makes it even easier to get into the car that’s right for you. By pre-qualifying for a Our auto loan, you can browse our expansive inventory of vehicles with completely personalized financing terms without impacting your credit score. During the purchase process, you will be asked to provide the name of your bank or credit union, the amount of your loan, and your loan officer’s name and contact information, if applicable. We recommend that you are already approved or pre-approved with your lender before starting the online purchase process. Once you complete the purchase process and schedule for delivery, our underwriting team will provide you the necessary documents to forward to your bank or loan officer to finalize your loan. Please note that your loan must be funded and we will need to verify the method of payment with your financial institution before we can confirm your delivery or pickup.</p>
            
            <a class="button primary-btn info-hero-button" href="<?php echo base_url(); ?>index.php/page/getprequalified">Get Pre-qualified</a>
            <br><br>
            <p class="learn-financing-hero-text"><h5><b>Here Are Some Special Vehicle financing ON-the Wheel offers which makes your life easy.</b></h5></p>
        </div>


<!--Actual code from here-->
<div class="row">
    <?php if (count($selectedEvent) > 0) { ?>
        <?php foreach ($selectedEvent as $eventRows): ?>
            <div class="col-lg-12 portfolio-item">
                <div class="card h-100">
                    <a href="#"><img class="card-img-top" src="<?php echo base_url(); ?>assets/uploads/file/<?php echo $eventRows->financeImage; ?>" alt="" width ="200" height = "500"></a>
                    <div class="card-body">
                        <h2 class="card-title text-center">
                            <a href="#"><?php echo $eventRows->financeName; ?></a>                           
                        </h2>
                       <!--  <small class="text-muted text-center"><?php echo $eventRows->EventLocation; ?></small> -->
                        <hr>
                        <p class="card-text">
                            
                        </p>
                        <p>
                            <small class="text-muted">
                                <b>Offer available for Limited time Only:</b>
                                &nbsp;&nbsp;&nbsp;&nbsp; Start Date: <b><?php echo $eventRows->financeStartDate; ?></b>
                                &nbsp;&nbsp;-&nbsp;&nbsp;
                                End Date: <b><?php echo $eventRows->financeEndDate; ?></b>
                            </small>
                        </p>
                        <hr>
                        <p class="card-text">
                            <?php
                                echo $eventRows->financeDescription;
                            ?>
                        </p>
                        
                    </div>
                </div>
            </div>

        <?php endforeach; ?><br><br>
    <?php } else { ?>    
    </div>
    
        <div class="col-lg-12">
            <div class="alert alert-primary" role="alert">
                Currently there is no events or Offers available to display!
            </div>
        </div>
<?php } ?>
<!-- /.row -->
</div>