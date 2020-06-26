<div class="row">
    <div class="col-md-12">
        <h4 class="m-b-lg">
            Add New Portfolio
        </h4>
    </div><!-- END column -->
    <div class="col-md-12">
        <div class="widget">
            <div class="widget-body">
                <form action="<?php echo base_url("portfolio/save"); ?>" method="post">

                    <div class="row">

                        <div class="form-group col-md-6">
                            <label>Title</label>
                            <input class="form-control" placeholder="Header information describing the job" name="title">
                            <?php if(isset($form_error)){ ?>
                                <small class="pull-right input-form-error"> <?php echo form_error("title"); ?></small>
                            <?php } ?>
                        </div>


                        <div class="form-group col-md-6">
                            <label>Category</label>
                            <select name="category_id" class="form-control">
                                <?php foreach($categories as $category) { ?>
                                    <option value="<?php echo $category->id; ?>"><?php echo $category->title; ?></option>
                                <?php } ?>
                            </select>
                            <?php if(isset($form_error)){ ?>
                                <small class="pull-right input-form-error"> <?php echo form_error("client"); ?></small>
                            <?php } ?>
                        </div>

                    </div>


                    <div class="row">

                        <div class="col-md-4">
                            <label for="datetimepicker1">Date of Completion</label>
                            <input type="hidden" name="finishedAt" id="datetimepicker1" data-plugin="datetimepicker" data-options="{inline: true, viewMode: 'days', format : 'YYYY-MM-DD HH:mm:ss'}" />
                        </div>

                        <div class="col-md-8">

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Client</label>
                                        <input class="form-control" placeholder="The customer you do business with" name="client">
                                        <?php if(isset($form_error)){ ?>
                                            <small class="pull-right input-form-error"> <?php echo form_error("client"); ?></small>
                                        <?php } ?>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Location</label>
                                        <input class="form-control" placeholder="Location information where you do business" name="place">
                                        <?php if(isset($form_error)){ ?>
                                            <small class="pull-right input-form-error"> <?php echo form_error("place"); ?></small>
                                        <?php } ?>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Link of Work Done (Url)</label>
                                        <input class="form-control" placeholder="The link of the work done on the internet" name="portfolio_url">
                                        <?php if(isset($form_error)){ ?>
                                            <small class="pull-right input-form-error"> <?php echo form_error("portfolio_url"); ?></small>
                                        <?php } ?>
                                    </div>
                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="form-group">
                        <label>Description</label>
                        <textarea name="description" class="m-0" data-plugin="summernote" data-options="{height: 250}"></textarea>
                    </div>
                    <?php if(isAllowedWriteModule()) { ?>
                                       <button type="submit" class="btn btn-primary btn-md btn-outline">Submit</button>
                                    <?php } ?>
                    <a href="<?php echo base_url("portfolio"); ?>" class="btn btn-md btn-danger btn-outline">Cancel</a>
                </form>
            </div><!-- .widget-body -->
        </div><!-- .widget -->
    </div><!-- END column -->
</div>