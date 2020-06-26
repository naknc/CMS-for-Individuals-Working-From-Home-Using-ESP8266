<div class="row">
    <div class="col-md-12">
        <h4 class="m-b-lg">
            Add New Video
        </h4>
    </div><!-- END column -->
    <div class="col-md-12">
        <div class="widget">
            <div class="widget-body">
                <form action="<?php echo base_url("galleries/gallery_video_save/$gallery_id"); ?>" method="post">

                        <div class="form-group">
                            <label>Video Url</label>
                            <input class="form-control" placeholder="Paste the video link (id) here" name="url">
                            <?php if(isset($form_error)){ ?>
                                <small class="pull-right input-form-error"> <?php echo form_error("url"); ?></small>
                            <?php } ?>
                        </div>

                    <?php if(isAllowedWriteModule()) { ?>
          <button type="submit" class="btn btn-primary btn-md btn-outline">Submit</button>
<?php } ?>
                    <a href="<?php echo base_url("galleries/gallery_video_list/$gallery_id"); ?>" class="btn btn-md btn-danger btn-outline">Cancel</a>
                </form>
            </div><!-- .widget-body -->
        </div><!-- .widget -->
    </div><!-- END column -->
</div>