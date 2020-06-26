<div class="row">
    <div class="col-md-12">
        <?php if(isAllowedWriteModule()) { ?>
           <div class="widget">
            <div class="widget-body">
                <form data-url="<?php echo base_url("portfolio/refresh_image_list/$item->id"); ?>" action="<?php echo base_url("portfolio/image_upload/$item->id"); ?>" id="dropzone" class="dropzone" data-plugin="dropzone" data-options="{ url: '<?php echo base_url("portfolio/image_upload/$item->id"); ?>'}">
                    <div class="dz-message">
                        <h3 class="m-h-lg">Drag the files you want to upload here</h3>
                        <p class="m-b-lg text-muted">(Drag your files to upload or click here)</p>
                    </div>
                </form>
            </div><!-- .widget-body -->
        </div><!-- .widget -->
        <?php } ?>
    </div><!-- END column -->
</div>

<div class="row">
    <div class="col-md-12">
        <h4 class="m-b-lg">
            Pictures of <b><?php echo $item->title; ?></b> record
        </h4>
    </div><!-- END column -->
    <div class="col-md-12">
        <div class="widget">
            <div class="widget-body image_list_container">

                <?php $this->load->view("{$viewFolder}/{$subViewFolder}/render_elements/image_list_v"); ?>

            </div><!-- .widget-body -->
        </div><!-- .widget -->
    </div><!-- END column -->
</div>

