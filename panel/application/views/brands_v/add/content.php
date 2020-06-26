<div class="row">
    <div class="col-md-12">
        <h4 class="m-b-lg">
            Add New Brand
        </h4>
    </div><!-- END column -->
    <div class="col-md-12">
        <div class="widget">
            <div class="widget-body">
                <form action="<?php echo base_url("brands/save"); ?>" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Title</label>
                        <input class="form-control" placeholder="Title" name="title">
                        <?php if(isset($form_error)){ ?>
                            <small class="pull-right input-form-error"> <?php echo form_error("title"); ?></small>
                        <?php } ?>
                    </div>

                    <div class="form-group image_upload_container">
                        <label>Select Image</label>
                        <input type="file" name="img_url" class="form-control">
                    </div>

                    <button type="submit" class="btn btn-primary btn-md btn-outline">Save</button>
                    <a href="<?php echo base_url("brands"); ?>" class="btn btn-md btn-danger btn-outline">Cancel</a>
                </form>
            </div><!-- .widget-body -->
        </div><!-- .widget -->
    </div><!-- END column -->
</div>