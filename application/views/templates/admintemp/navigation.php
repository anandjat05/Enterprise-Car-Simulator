 <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php echo base_url(); ?>index.php/admin">ON-the Wheel: Admin</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">                
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="<?php echo base_url(); ?>index.php/admin/adminLogout">
                        <i class="glyphicon glyphicon-log-out"></i></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                        <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="login.html"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search">
                            <div class="input-group custom-search-form">
                                <input type="text" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                            </div>
                            <!-- /input-group -->
                        </li>
                        <li>
                            <a href="<?php echo base_url(); ?>index.php/admin"><i class="fa fa-home fa-fw"></i> Home</a>
                        </li>                        
                        <li>
                            <a href="<?php echo base_url(); ?>index.php/admin/packages"><i class="fa fa-cubes fa-fw"></i> Packages<span class="fa arrow"></span></a>
                            
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="<?php echo base_url(); ?>index.php/admin/products"><i class="fa fa-paw fa-fw"></i> Products<span class="fa arrow"></span></a>
                            
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="<?php echo base_url(); ?>index.php/admin/PackageCatetory"><i class="fa fa-th-list fa-fw"></i> Package Category<span class="fa arrow"></span></a>
                            
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="<?php echo base_url(); ?>index.php/admin/adoption"><i class="fa fa-file-text fa-fw"></i> Adoption Details<span class="fa arrow"></span></a>
                            
                            <!-- /.nav-second-level Adoptionrequestview -->
                        </li>
                         <li>
                            <a href="<?php echo base_url(); ?>index.php/admin/adoptionrequestview"><i class="fa fa-file-text fa-fw"></i> Adoption Request<span class="fa arrow"></span></a>
                            
                            <!-- /.nav-second-level  -->
                        </li>
                        <li>
                            <a href="<?php echo base_url(); ?>index.php/admin/offergroup"><i class="fa fa-gears fa-fw"></i> Reward Settings<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php echo base_url(); ?>index.php/admin/offergroup">Offer Group</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url(); ?>index.php/admin/AssignOfferGroup">Assign Group</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url(); ?>index.php/admin/PromoCods">Promo Cods</a>
                                </li>
                            </ul>
                            
                            
                            <!-- /.nav-second-level  -->
                        </li>
                        <li>
                            <a href="<?php echo base_url(); ?>index.php/admin/PetEvents"><i class="fa fa-file-text fa-fw"></i> Events<span class="fa arrow"></span></a>
                            
                            <!-- /.nav-second-level  -->
                        </li>
                        
                        <li>
                            <a href="#"><i class="fa fa-gears fa-fw"></i> Pet Wellness<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php echo base_url(); ?>index.php/admin/InhouseExperts">In-house Experts</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url(); ?>index.php/admin/ExpertAdvice">Expert Advice</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url(); ?>index.php/admin/TipsAndVideos">Tips and videos</a>
                                </li>
                            </ul>
                            
                            
                            <!-- /.nav-second-level  -->
                        </li>
                        
                        <?php
                        /*
                        ?>
                        <li>
                            <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Events<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="flot.html">List Events</a>
                                </li>
                                <li>
                                    <a href="morris.html">Create Events</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="tables.html"><i class="fa fa-table fa-fw"></i> Packages</a>
                        </li>
                        <li>
                            <a href="forms.html"><i class="fa fa-edit fa-fw"></i> Cart Products</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-wrench fa-fw"></i> UI Elements<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="panels-wells.html">Panels and Wells</a>
                                </li>
                                <li>
                                    <a href="buttons.html">Buttons</a>
                                </li>
                                <li>
                                    <a href="notifications.html">Notifications</a>
                                </li>
                                <li>
                                    <a href="typography.html">Typography</a>
                                </li>
                                <li>
                                    <a href="icons.html"> Icons</a>
                                </li>
                                <li>
                                    <a href="grid.html">Grid</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-sitemap fa-fw"></i> Multi-Level Dropdown<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="#">Second Level Item</a>
                                </li>
                                <li>
                                    <a href="#">Second Level Item</a>
                                </li>
                                <li>
                                    <a href="#">Third Level <span class="fa arrow"></span></a>
                                    <ul class="nav nav-third-level">
                                        <li>
                                            <a href="#">Third Level Item</a>
                                        </li>
                                        <li>
                                            <a href="#">Third Level Item</a>
                                        </li>
                                        <li>
                                            <a href="#">Third Level Item</a>
                                        </li>
                                        <li>
                                            <a href="#">Third Level Item</a>
                                        </li>
                                    </ul>
                                    <!-- /.nav-third-level -->
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-files-o fa-fw"></i> Sample Pages<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="blank.html">Blank Page</a>
                                </li>
                                <li>
                                    <a href="login.html">Login Page</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <?php
                        */
                        ?>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>