
<!-- Page Content -->
<div class="container">

    <div class="row">
        <div class="col-md-12 mb-4">
            <?php
            if (!empty($success_msg)) {
                echo '<div class="alert alert-success" role="alert">' . $success_msg . '</div>';
            } elseif (!empty($error_msg)) {
                echo '<div class="alert alert-danger" role="alert">' . $error_msg . '</div>';
            }
            ?>
        </div>
    </div>
    <div class="row">

