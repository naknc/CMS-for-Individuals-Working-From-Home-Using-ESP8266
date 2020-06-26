<div class="row">
    <div class="col-md-12">
        <h4 class="m-b-lg">
        <?php echo "You are updating <b>$item->title</b>"; ?>
        </h4>
    </div><!-- END column -->
    <div class="col-md-12">
        <div class="widget">
            <div class="widget-body">
                <form action="<?php echo base_url("portfolio/update/$item->id"); ?>" method="post">

                    <div class="row">

                        <div class="form-group col-md-6">
                            <label>Title</label>
                            <input
                                class="form-control"
                                placeholder="Header information describing the job"
                                name="title"
                                value="<?php echo (isset($form_error)) ? set_value("title") : $item->title; ?>"
                            >
                            <?php if(isset($form_error)){ ?>
                                <small class="pull-right input-form-error"> <?php echo form_error("title"); ?></small>
                            <?php } ?>
                        </div>


                        <div class="form-group col-md-6">
                            <label>Category</label>

                            <select name="category_id" class="form-control">
                                <?php foreach($categories as $category) { ?>
                                    <?php $category_id = isset($form_error) ? set_value("category_id") : $item->category_id; ?>
                                    <option
                                        <?php echo ($category->id === $category_id) ? "selected" : ""; ?>
                                        value="<?php echo $category->id; ?>"><?php echo $category->title; ?></option>
                                <?php } ?>
                            </select>

                            <?php if(isset($form_error)){ ?>
                                <small class="pull-right input-form-error"> <?php echo form_error("category_id"); ?></small>
                            <?php } ?>
                        </div>

                    </div>


                    <div class="row">

                        <div class="col-md-4">
                            <label for="datetimepicker1">Date of Completion</label>
                            <input
                                type="hidden"
                                name="finishedAt"
                                id="datetimepicker1"
                                data-plugin="datetimepicker"
                                data-options="{inline: true, viewMode: 'days', format : 'YYYY-MM-DD HH:mm:ss'}"
                                value="<?php echo (isset($form_error)) ? set_value("finishedAt") : $item->finishedAt; ?>"
                            />
                        </div>

                        <div class="col-md-8">

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Client</label>
                                        <input
                                            class="form-control"
                                            placeholder="The customer you do business with"
                                            name="client"
                                            value="<?php echo (isset($form_error)) ? set_value("client") : $item->client; ?>"
                                        >
                                        <?php if(isset($form_error)){ ?>
                                            <small class="pull-right input-form-error"> <?php echo form_error("client"); ?></small>
                                        <?php } ?>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Location</label>
                                        <input
                                            class="form-control"
                                            placeholder="Location information where you do business"
                                            name="place"
                                            value="<?php echo (isset($form_error)) ? set_value("place") : $item->place; ?>"
                                        >
                                        <?php if(isset($form_error)){ ?>
                                            <small class="pull-right input-form-error"> <?php echo form_error("place"); ?></small>
                                        <?php } ?>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Link of Work Done (Url)</label>
                                        <input
                                            class="form-control"
                                            placeholder="The link of the work done on the internet"
                                            name="portfolio_url"
                                            value="<?php echo (isset($form_error)) ? set_value("portfolio_url") : $item->portfolio_url; ?>"
                                        >
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
                        <textarea name="description" class="m-0" data-plugin="summernote" data-options="{height: 250}">
                            <?php echo (isset($form_error)) ? set_value("description") : $item->description; ?>
                        </textarea>
                    </div>
                    <?php if(isAllowedUpdateModule()) { ?>
                                  <button type="submit" class="btn btn-primary btn-md btn-outline">Update</button>
                                    <?php } ?>
                    <a href="<?php echo base_url("portfolio"); ?>" class="btn btn-md btn-danger btn-outline">Cancel</a>
                </form>
            </div><!-- .widget-body -->
        </div><!-- .widget -->
    </div><!-- END column -->
</div>