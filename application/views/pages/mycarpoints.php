
<div class="col-lg-8 mb-4">
    <div class="row">
        <div class="col">
            <div class="card h-100 shadow bg-white rounded text-center">
                <div class="card-header text-muted text-left">
                    <h5>My Profile</h5>
                </div>
                <div class="card-body">
                    <?php foreach ($mycarpoints as $rowPoint): ?>
                    <h5>Your total Car Point: <?php echo $rowPoint->PointEarned; ?></h5>
                    <?php endforeach; ?>
                    <p class="text-muted"><small><i>10 Point = 1$</i></small></p>
                </div>                    
            </div>
        </div>
    </div>
</div>
