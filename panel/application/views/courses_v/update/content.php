<div class="row">
    <div class="col-md-12">
        <h4 class="m-b-lg">
        <?php echo "You are updating <b>$item->title</b>"; ?>
        </h4>
    </div><!-- END column -->
    <div class="col-md-12">
        <div class="widget">
            <div class="widget-body">
                <form action="<?php echo base_url("courses/update/$item->id"); ?>" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Title</label>
                        <input class="form-control" placeholder="Başlık" name="title" value="<?php echo $item->title; ?>">
                        <?php if(isset($form_error)){ ?>
                            <small class="pull-right input-form-error"> <?php echo form_error("title"); ?></small>
                        <?php } ?>
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea name="description" class="m-0" data-plugin="summernote" data-options="{height: 250}"><?php echo $item->description; ?></textarea>
                    </div>

                    <div class="row">

                        <div class="col-md-4">
                            <label for="datetimepicker1">Course Date</label>
                            <input type="hidden" value="<?php echo $item->event_date; ?>" name="event_date" id="datetimepicker1" data-plugin="datetimepicker" data-options="{inline: true, viewMode: 'days', format : 'YYYY-MM-DD HH:mm:ss'}" />
                        </div><!-- END column -->


                        <div class="col-md-1 image_upload_container">
                            <img src="<?php echo get_picture($viewFolder,$item->img_url, "255x157"); ?>" alt="" class="img-responsive">
                        </div>

                        <div class="col-md-7 form-group image_upload_container">
                            <label>Select Image</label>
                            <input type="file" name="img_url" class="form-control">
                        </div>

                    </div>

                    <?php if(isAllowedUpdateModule()) { ?>
                              <button type="submit" class="btn btn-primary btn-md btn-outline">Update</button>
                                    <?php } ?>
                    <a href="<?php echo base_url("courses"); ?>" class="btn btn-md btn-danger btn-outline">Cancel</a>
                </form>
            </div><!-- .widget-body -->
        </div><!-- .widget -->
    </div><!-- END column -->
</div>