<div class="row">
    <div class="col-md-12">
        <h4 class="m-b-lg">
            Add New Testimonial
        </h4>
    </div><!-- END column -->
    <div class="col-md-12">
        <div class="widget">
            <div class="widget-body">
                <form action="<?php echo base_url("testimonials/save"); ?>" method="post" enctype="multipart/form-data">

                    <div class="form-group">
                        <label>Name and Surname</label>
                        <input class="form-control" placeholder="Name and Surname" name="full_name">
                        <?php if(isset($form_error)){ ?>
                            <small class="pull-right input-form-error"> <?php echo form_error("full_name"); ?></small>
                        <?php } ?>
                    </div>

                    <div class="form-group">
                        <label>Company Name</label>
                        <input class="form-control" placeholder="Company Name" name="company">
                        <?php if(isset($form_error)){ ?>
                            <small class="pull-right input-form-error"> <?php echo form_error("company"); ?></small>
                        <?php } ?>
                    </div>

                    <div class="form-group">
                        <label>Title</label>
                        <input class="form-control" placeholder="Title" name="title">
                        <?php if(isset($form_error)){ ?>
                            <small class="pull-right input-form-error"> <?php echo form_error("title"); ?></small>
                        <?php } ?>
                    </div>

                    <div class="form-group">
                        <label>Message</label>
                        <textarea class="form-control" name="description" placeholder="Message about us..." cols="30" rows="10"></textarea>
                        <?php if(isset($form_error)){ ?>
                            <small class="pull-right input-form-error"> <?php echo form_error("description"); ?></small>
                        <?php } ?>
                    </div>

                    <div class="form-group image_upload_container">
                        <label>Select Image</label>
                        <input type="file" name="img_url" class="form-control">
                    </div>

                    <?php if(isAllowedWriteModule()) { ?>
                                       <button type="submit" class="btn btn-primary btn-md btn-outline">Submit</button>
                                    <?php } ?>
                    <a href="<?php echo base_url("testimonials"); ?>" class="btn btn-md btn-danger btn-outline">Cancel</a>
                </form>
            </div><!-- .widget-body -->
        </div><!-- .widget -->
    </div><!-- END column -->
</div>