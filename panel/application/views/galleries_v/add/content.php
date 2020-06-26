<div class="row">
    <div class="col-md-12">
        <h4 class="m-b-lg">
            Add New Gallery
        </h4>
    </div><!-- END column -->
    <div class="col-md-12">
        <div class="widget">
            <div class="widget-body">
                <form action="<?php echo base_url("galleries/save"); ?>" method="post">
                    <div class="form-group">
                        <label>Gallery Name</label>
                        <input class="form-control" placeholder="Enter gallery name" name="title">
                        <?php if(isset($form_error)){ ?>
                            <small class="pull-right input-form-error"> <?php echo form_error("title"); ?></small>
                        <?php } ?>
                    </div>

                    <div class="form-group">
                        <label for="control-demo-6" class="">Gallery Type</label>
                        <div id="control-demo-6" class="">
                            <select class="form-control" name="gallery_type">
                                <option <?php echo (isset($gallery_type) && $gallery_type == "image") ? "selected" : ""; ?> value="image">Image</option>
                                <option <?php echo (isset($gallery_type) && $gallery_type == "video") ? "selected" : ""; ?> value="video">Video</option>
                                <option <?php echo (isset($gallery_type) && $gallery_type == "file") ? "selected" : ""; ?> value="file">File</option>
                            </select>
                        </div>
                    </div><!-- .form-group -->


                    <?php if(isAllowedWriteModule()) { ?>
            <button type="submit" class="btn btn-primary btn-md btn-outline">Submit</button>
<?php } ?>
                    <a href="<?php echo base_url("galleries"); ?>" class="btn btn-md btn-danger btn-outline">Cancel</a>
                </form>
            </div><!-- .widget-body -->
        </div><!-- .widget -->
    </div><!-- END column -->
</div>