<div class="row">
    <div class="col-md-12">
        <h4 class="m-b-lg">
        <?php echo "You are updating <b>$item->title</b>"; ?>
        </h4>
    </div><!-- END column -->
    <div class="col-md-12">
        <div class="widget">
            <div class="widget-body">
                <form action="<?php echo base_url("testimonials/update/$item->id"); ?>" method="post" enctype="multipart/form-data">

                    <div class="form-group">
                        <label>Name and Surname</label>
                        <input class="form-control" placeholder="name and surname" name="full_name" value="<?php echo $item->full_name; ?>">
                        <?php if(isset($form_error)){ ?>
                            <small class="pull-right input-form-error"> <?php echo form_error("full_name"); ?></small>
                        <?php } ?>
                    </div>
                    <div class="form-group">
                        <label>Company Name</label>
                        <input class="form-control" placeholder="company Name" name="company" value="<?php echo $item->company; ?>">
                        <?php if(isset($form_error)){ ?>
                            <small class="pull-right input-form-error"> <?php echo form_error("company"); ?></small>
                        <?php } ?>
                    </div>

                    <div class="form-group">
                        <label>Title</label>
                        <input class="form-control" placeholder="title" name="title" value="<?php echo $item->title; ?>">
                        <?php if(isset($form_error)){ ?>
                            <small class="pull-right input-form-error"> <?php echo form_error("title"); ?></small>
                        <?php } ?>
                    </div>

                    <div class="form-group">
                        <label>Message</label>
                        <textarea class="form-control" name="description" placeholder="Message about us..." cols="30" rows="10"><?php echo $item->description; ?></textarea>
                        <?php if(isset($form_error)){ ?>
                            <small class="pull-right input-form-error"> <?php echo form_error("description"); ?></small>
                        <?php } ?>
                    </div>

                    <div class="row">

                        <div class="col-md-1 image_upload_container">
                            <img src="<?php echo get_picture($viewFolder, $item->img_url, "90x90"); ?>" alt="" class="img-responsive">
                        </div>

                        <div class="col-md-9 form-group image_upload_container">
                            <label>Select Image</label>
                            <input type="file" name="img_url" class="form-control">
                        </div>

                    </div>

                    <?php if(isAllowedUpdateModule()) { ?>
         <button type="submit" class="btn btn-primary btn-md btn-outline">Update</button>
        <?php } ?>
                    <a href="<?php echo base_url("testimonials"); ?>" class="btn btn-md btn-danger btn-outline">İptal</a>
                </form>
            </div><!-- .widget-body -->
        </div><!-- .widget -->
    </div><!-- END column -->
</div>