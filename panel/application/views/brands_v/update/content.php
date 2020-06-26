<div class="row">
    <div class="col-md-12">
        <h4 class="m-b-lg">
            <?php echo "You are updating <b>$item->title</b>"; ?>
        </h4>
    </div><!-- END column -->
    <div class="col-md-12">
        <div class="widget">
            <div class="widget-body">
                <form action="<?php echo base_url("brands/update/$item->id"); ?>" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Title</label>
                        <input class="form-control" placeholder="Title" name="title" value="<?php echo $item->title; ?>">
                        <?php if(isset($form_error)){ ?>
                            <small class="pull-right input-form-error"> <?php echo form_error("title"); ?></small>
                        <?php } ?>
                    </div>

                    <div class="row">

                        <div class="col-md-1 image_upload_container">
                            <img src="<?php echo get_picture($viewFolder, $item->img_url, "350x216"); ?>" alt="" class="img-responsive">
                        </div>

                        <div class="col-md-9 form-group image_upload_container">
                            <label>Select Image</label>
                            <input type="file" name="img_url" class="form-control">
                        </div>

                    </div>

                    <?php if(isAllowedUpdateModule()) { ?>
                                <button type="submit" class="btn btn-primary btn-md btn-outline">Update</button>
                                    <?php } ?>
                    <a href="<?php echo base_url("brands"); ?>" class="btn btn-md btn-danger btn-outline">Cancel</a>
                </form>
            </div><!-- .widget-body -->
        </div><!-- .widget -->
    </div><!-- END column -->
</div>