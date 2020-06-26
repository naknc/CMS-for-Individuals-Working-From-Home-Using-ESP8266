<div class="row">
    <div class="col-md-12">
        <h4 class="m-b-lg">
            Site Settings
            <?php if(isAllowedWriteModule()) { ?>
                <a href="<?php echo base_url("settings/new_form"); ?>" class="btn btn-outline btn-primary btn-xs pull-right"> <i class="fa fa-plus"></i> Add New</a>
            <?php } ?>
         </h4>
    </div><!-- END column -->
    <div class="col-md-12">
        <div class="widget p-lg">

            <?php if(empty($items)) { ?>

                <div class="alert alert-info text-center">
                <p>There is no data here. Please click <?php if(isAllowedUpdateModule()) { ?>
                                  <a href="<?php echo base_url("settings/new_form"); ?>">
                                    <?php } ?>here</a> to add</p>
                </div>

            <?php } ?>

        </div><!-- .widget -->
    </div><!-- END column -->
</div>