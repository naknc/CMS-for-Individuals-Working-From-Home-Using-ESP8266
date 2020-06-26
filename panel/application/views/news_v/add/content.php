<div class="row">
    <div class="col-md-12">
        <h4 class="m-b-lg">
            Add New News
        </h4>
    </div><!-- END column -->
    <div class="col-md-12">
        <div class="widget">
            <div class="widget-body">
                <form action="<?php echo base_url("news/save"); ?>" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Title</label>
                        <input class="form-control" placeholder="Title" name="title">
                        <?php if(isset($form_error)){ ?>
                            <small class="pull-right input-form-error"> <?php echo form_error("title"); ?></small>
                        <?php } ?>
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea name="description" class="m-0" data-plugin="summernote" data-options="{height: 250}"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="control-demo-6" class="">News Type</label>
                        <div id="control-demo-6" class="">
                            <select class="form-control news_type_select" name="news_type">
                                <option <?php echo (isset($news_type) && $news_type == "image") ? "selected" : ""; ?> value="image">Image</option>
                                <option <?php echo (isset($news_type) && $news_type == "video") ? "selected" : ""; ?> value="video">Video</option>
                            </select>
                        </div>
                    </div><!-- .form-group -->

                    <?php if(isset($form_error)){ ?>

                        <div class="form-group image_upload_container" style="display: <?php echo ($news_type == "image") ? "block" : "none"; ?>">
                            <label>Select Image</label>
                            <input type="file" name="img_url" class="form-control">
                        </div>

                        <div class="form-group video_url_container" style="display: <?php echo ($news_type == "video") ? "block" : "none"; ?>">
                            <label>Video Url</label>
                            <input class="form-control" placeholder="Paste the video link here" name="video_url">
                            <?php if(isset($form_error)){ ?>
                                <small class="pull-right input-form-error"> <?php echo form_error("video_url"); ?></small>
                            <?php } ?>
                        </div>


                    <?php } else { ?>

                        <div class="form-group image_upload_container">
                            <label>Select Image</label>
                            <input type="file" name="img_url" class="form-control">
                        </div>

                        <div class="form-group video_url_container">
                            <label>Video Url</label>
                            <input class="form-control" placeholder="Paste the video link here" name="video_url">
                        </div>


                    <?php } ?>

                    <?php if(isAllowedUpdateModule()) { ?>
     <button type="submit" class="btn btn-primary btn-md btn-outline">Submit</button>
<?php } ?>
                    <a href="<?php echo base_url("news"); ?>" class="btn btn-md btn-danger btn-outline">Cancel</a>
                </form>
            </div><!-- .widget-body -->
        </div><!-- .widget -->
    </div><!-- END column -->
</div>