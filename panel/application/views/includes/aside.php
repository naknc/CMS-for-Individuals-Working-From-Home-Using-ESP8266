<?php $user = get_active_user();?>

<aside id="menubar" class="menubar light">
    <div class="app-user">
        <div class="media">
            <div class="media-left">
                <div class="avatar avatar-md avatar-circle">
                    <a href="javascript:void(0)">
                        <img class="img-responsive"
                             src="<?php echo base_url("assets"); ?>/assets/images/<?php echo rand(1,29);?>.jpg"
                             alt="<?php echo convertToSEO($user->full_name); ?>"/>
                    </a>
                </div><!-- .avatar -->
            </div>
            <div class="media-body">
                <div class="foldable">
                    <h5><a href="javascript:void(0)" class="username"><?php echo $user->full_name; ?></a></h5>
                    <ul>
                        <li class="dropdown">
                            <a href="javascript:void(0)" class="dropdown-toggle usertitle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <small>Operations</small>
                                <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu animated flipInY">
                                <li>
                                    <a class="text-color" href="<?php echo base_url("users/update_form/$user->id"); ?>">
                                        <span class="m-r-xs"><i class="fa fa-user"></i></span>
                                        <span>My Profile</span>
                                    </a>
                                </li>
                                <li role="separator" class="divider"></li>
                                <li>
                                    <a class="text-color" href="<?php echo base_url("logout"); ?>">
                                        <span class="m-r-xs"><i class="fa fa-power-off"></i></span>
                                        <span>Logout</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div><!-- .media-body -->
        </div><!-- .media -->
    </div><!-- .app-user -->

    <div class="menubar-scroll">
        <div class="menubar-scroll-inner">
            <ul class="app-menu">

                <?php if(isAllowedViewModule("settings")) { ?>
                    <li>
                        <a href="<?php echo base_url("settings"); ?>">
                            <i class="menu-icon zmdi zmdi-settings zmdi-hc-lg"></i>
                            <span class="menu-text">Settings</span>
                        </a>
                    </li>
                <?php } ?>

                <?php if(isAllowedViewModule("users")) { ?>
                    <li>
                        <a href="<?php echo base_url("users"); ?>">
                            <i class="menu-icon fa fa-user-secret"></i>
                            <span class="menu-text">Users</span>
                        </a>
                    </li>
                <?php } ?>

                <?php if(isAllowedViewModule("user_roles")) { ?>
                    <li>
                        <a href="<?php echo base_url("user_roles"); ?>">
                            <i class="menu-icon fa fa-eye"></i>
                            <span class="menu-text">User Roles</span>
                        </a>
                    </li>
                <?php } ?>

                <?php if(isAllowedViewModule("emailsettings")) { ?>

                    <li>
                        <a href="<?php echo base_url("emailsettings"); ?>">
                            <i class="menu-icon zmdi zmdi-email zmdi-hc-lg"></i>
                            <span class="menu-text">E-mail Settings</span>
                        </a>
                    </li>

                <?php } ?>

                <?php if(isAllowedViewModule("galleries")) { ?>

                    <li>
                        <a href="<?php echo base_url("galleries"); ?>">
                            <i class="menu-icon zmdi zmdi-apps zmdi-hc-lg"></i>
                            <span class="menu-text">Galleries</span>
                        </a>
                    </li>

                <?php } ?>

                <?php if(isAllowedViewModule("product")) { ?>

                    <li>
                        <a href="<?php echo base_url("product"); ?>">
                            <i class="menu-icon fa fa-cubes"></i>
                            <span class="menu-text">Products</span>
                        </a>
                    </li>

                <?php } ?>

                <?php if(isAllowedViewModule("services")) { ?>

                    <li>
                        <a href="<?php echo base_url("services"); ?>">
                            <i class="menu-icon fa fa-cutlery"></i>
                            <span class="menu-text">Services</span>
                        </a>
                    </li>

                <?php } ?>

                <?php if(isAllowedViewModule("portfolio") && isAllowedViewModule("portfolio_categories")) { ?>

                    <li class="has-submenu">
                        <a href="javascript:void(0)" class="submenu-toggle">
                            <i class="menu-icon fa fa-asterisk"></i>
                            <span class="menu-text">Portfolio Transactions</span>
                            <i class="menu-caret zmdi zmdi-hc-sm zmdi-chevron-right"></i>
                        </a>
                        <ul class="submenu">
                            <li>
                                <a href="<?php echo base_url("portfolio_categories"); ?>">
                                    <span class="menu-text">Portfolio Categories</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo base_url("portfolio"); ?>">
                                    <span class="menu-text">Portfolios</span>
                                </a>
                            </li>
                        </ul>
                    </li>

                <?php } ?>

                <?php if(isAllowedViewModule("news")) { ?>

                    <li>
                        <a href="<?php echo base_url("news"); ?>">
                            <i class="menu-icon fa fa-newspaper-o"></i>
                            <span class="menu-text">News</span>
                        </a>
                    </li>

                <?php } ?>

                <?php if(isAllowedViewModule("courses")) { ?>

                    <li>
                        <a href="<?php echo base_url("courses"); ?>">
                            <i class="menu-icon fa fa-calendar"></i>
                            <span class="menu-text">Courses</span>
                        </a>
                    </li>

                <?php } ?>

                <?php if(isAllowedViewModule("brands")) { ?>
                    <li>
                        <a href="<?php echo base_url("brands"); ?>">
                            <i class="menu-icon zmdi zmdi-puzzle-piece zmdi-hc-lg"></i>
                            <span class="menu-text">Brands</span>
                        </a>
                    </li>
                <?php } ?>

                <?php if(isAllowedViewModule("references")) { ?>

                    <li>
                        <a href="<?php echo base_url("references"); ?>">
                            <i class="menu-icon zmdi zmdi-check zmdi-hc-lg"></i>
                            <span class="menu-text">References</span>
                        </a>
                    </li>

                <?php } ?>
                                     
                <?php if(isAllowedViewModule("testimonials")) { ?>

                    <li>
                        <a href="<?php echo base_url("testimonials"); ?>">
                            <i class="menu-icon fa fa-comments"></i>
                            <span class="menu-text">Testimonials</span>
                        </a>
                    </li>

                <?php } ?>

            </ul><!-- .app-menu -->
        </div><!-- .menubar-scroll-inner -->
    </div><!-- .menubar-scroll -->
</aside>