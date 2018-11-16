<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<!--Package starts from here-->

<div class="col-lg-12">
    <div class="row">            
        
        <div class="col-lg-12 col-md-4 col-sm-6 mb-4">
            <h3 class="mt-4 mb-3" style="text-align: center"> Featured Cars, Trucks, SUV. At Price you can't ignore </h3><hr>
            <div class="row">
                <input type="hidden" value="<?php echo base_url(); ?>" id="findbaseurl" name="findbaseurl"/>
                
                    <?php foreach ($result as $row): ?>
                        <div class="col-lg-4 col-md-4 col-sm-6 mb-4">
                            <div class="card h-100 shadow bg-white rounded">
                                <a href="#"><img class="card-img-top" src="<?php echo base_url(); ?>/assets/uploads/file/<?php echo $row->pkgImg; ?>" alt="" width="120" height="220"/></a>
                                <div class="card-body">
                                    <table style="width: 100%;">
                                        <tbody style="text-align: center;">
                                            <tr><td><h6><?php echo $row->pkgName; ?></h6></td></tr>
                                            <tr><td><h4><?php echo "$".$row->pkgCost; ?></h4></td></tr>
                                            <tr><td><?php echo $row->pkgDescription; ?></td></tr>
                                            <tr> <td><a href="<?php echo base_url(); ?>index.php/page/custompackages/<?php echo $row->pkgId; ?>" class="btn btn-primary">Schedule Test Drive</a></td></tr>
                                            
                                        </tbody>
                                    </table>
                                </div>
                                
                            </div>
                        </div>   
                    <?php endforeach; ?>                
                
            </div>
        </div>
    </div>

</div>











