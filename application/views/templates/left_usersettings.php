<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<!-- Sidebar Column -->
<div class="col-lg-4 mb-4">
    <div class="jumbotron custom-jumbotron">        
        <ul>
            <li>
                My Profile
                <ul>
                    <li><a href="<?php echo base_url(); ?>index.php/page/usersettings">Details</a></li>
                    <li><a href="<?php echo base_url(); ?>index.php/page/addaddress/view">Address</a></li>
                    <li><a href="<?php echo base_url(); ?>index.php/page/myorderhistory">My Orders</a></li>
                    <li><a href="<?php echo base_url(); ?>index.php/page/mycarpoints">My Car Points</a></li>
                </ul>                
            </li>    
            <li>Settings
                <ul>
                    <li><a href="<?php echo base_url(); ?>index.php/page/userchagepassword">Change Password</a></li>
                </ul>
            </li>


        </ul>
    </div>
    <!-- /.jumbotron -->
</div>

