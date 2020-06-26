<div class="row">
    <div class="col-md-12">
        <h4 class="m-b-lg">
        Portfolio Category List
            <?php if(isAllowedWriteModule()) { ?>
                <a href="<?php echo base_url("portfolio_categories/new_form"); ?>" class="btn btn-outline btn-primary btn-xs pull-right"> <i class="fa fa-plus"></i> Add New</a>
            <?php } ?>
        </h4>
    </div><!-- END column -->
    <div class="col-md-12">
        <div class="widget p-lg">

            <?php if(empty($items)) { ?>

                <div class="alert alert-info text-center">
                <p>There is no data here. Please click 
                    <?php if(isAllowedUpdateModule()) { ?>
                        <a href="<?php echo base_url("portfolio_categories/new_form"); ?>">
                    <?php } ?>here</a> 
                    to add
                </p>    
                </div>

            <?php } else { ?>

                <table class="table table-hover table-striped table-bordered content-container">
                    <thead>
                        <th class="w50">#id</th>
                        <th>Title</th>
                        <th>Status</th>
                        <th>Operation</th>
                    </thead>
                    <tbody>

                        <?php foreach($items as $item) { ?>

                            <tr>
                                <td class="w50 text-center">#<?php echo $item->id; ?></td>
                                <td class="text-center"><?php echo $item->title; ?></td>
                                <td class="text-center w100">
                                    <input
                                        data-url="<?php echo base_url("portfolio_categories/isActiveSetter/$item->id"); ?>"
                                        class="isActive"
                                        type="checkbox"
                                        data-switchery
                                        data-color="#10c469"
                                        <?php echo ($item->isActive) ? "checked" : ""; ?>
                                    />
                                </td>
                                <td class="text-center w200">
                                    <?php if(isAllowedDeleteModule()) { ?>
                                        <button
                                            data-url="<?php echo base_url("portfolio_categories/delete/$item->id"); ?>"
                                            class="btn btn-sm btn-danger btn-outline remove-btn">
                                            <i class="fa fa-trash"></i> Delete
                                        </button>
                                    <?php } ?>
                                   <?php if(isAllowedUpdateModule()) { ?>
                                        <a href="<?php echo base_url("portfolio_categories/update_form/$item->id"); ?>" class="btn btn-sm btn-info btn-outline"><i class="fa fa-pencil-square-o"></i> Update</a>
                                    <?php } ?>
                                </td>
                            </tr>

                        <?php } ?>

                    </tbody>

                </table>

            <?php } ?>

        </div><!-- .widget -->
    </div><!-- END column -->
</div>