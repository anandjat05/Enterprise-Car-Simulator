
<div class="col-lg-8 mb-4">
    <div class="row">
        <div class="col">
            <div class="card h-100 shadow bg-white rounded text-center">
                <div class="card-header text-muted text-left">
                    <h5>My Profile</h5>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col"># Order</th>
                                <th scope="col">Total Amount</th>                                
                                <th scope="col">Date</th>
                                <!--<th scope="col">View</th>-->
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($myOrders as $orderRows): ?>
                                <?php $count = 1; ?>
                                <tr>
                                    <th scope="row"># <?php echo $orderRows->OrderId; ?></th>
                                    <td><?php echo $orderRows->TotalAmnt; ?></td>
                                    <td><?php echo $orderRows->crDate; ?></td>
                                    
                                </tr>
                                <?php $count++; ?>
                            <?php endforeach; ?>                            
                        </tbody>
                    </table>

                </div>                    
            </div>
        </div>
    </div>
</div>
