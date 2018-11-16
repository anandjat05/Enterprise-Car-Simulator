<?php foreach ($result as $package): ?>
    <div class="col-lg-4 mb-4">    
        <div class="card h-100">
            
            <h4 class="card-header"><?php echo $package->Category_Name; ?></h4>
            <div class="card-body">
                <p class="text-justify">
                   
                    <a href="#"><img class="card-img-top" src="<?php echo base_url(); ?>assets/uploads/file/<?php echo $package->CatImage; ?>" alt=""></a>
                    <!-- <?php echo $package->CatDescription; ?> -->
                    <?php echo $package->CatDescription; ?>

                </p>
            </div>
            <ul class="list-group list-group-flush">            
                <li class="list-group-item" style="padding-left: 100px">
                    <a href="<?php echo base_url(); ?>index.php/page/packages/<?php echo $package->CategoryId; ?>" class="btn btn-primary btn-sm">Go to Vehicle Sales</a>
                </li>
            </ul>
        </div>       
    </div>
<?php endforeach; ?> 

