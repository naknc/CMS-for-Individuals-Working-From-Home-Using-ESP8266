<div class="row">
    <div class="col-md-12">
        <h4 class="m-b-lg">
            News List
            <?php if(isAllowedWriteModule()) { ?>
                <a href="<?php echo base_url("news/new_form"); ?>" class="btn btn-outline btn-primary btn-xs pull-right"> <i class="fa fa-plus"></i> Add New</a>
            <?php } ?>
        </h4>
    </div><!-- END column -->
    <div class="col-md-12">
        <div class="widget p-lg">

            <?php if(empty($items)) { ?>

                <div class="alert alert-info text-center">
                <p>There is no data here. Please click 
                    <?php if(isAllowedUpdateModule()) { ?>
                        <a href="<?php echo base_url("news/new_form"); ?>">
                    <?php } ?>here</a> 
                    to add
                </p>                        
                </div>

            <?php } else { ?>

                <table class="table table-hover table-striped table-bordered content-container">
                    <thead>
                        <th class="order"><i class="fa fa-reorder"></i></th>
                        <th class="w50">#id</th>
                        <th>Title</th>
                        <th>Url</th>
                        <th>News Type</th>
                        <th>Image</th>
                        <th>Status</th>
                        <th>Operation</th>
                    </thead>
                    <tbody class="sortable" data-url="<?php echo base_url("news/rankSetter"); ?>">

                        <?php foreach($items as $item) { ?>

                            <tr id="ord-<?php echo $item->id; ?>">
                                <td class="order"><i class="fa fa-reorder"></i></td>
                                <td class="w50 text-center">#<?php echo $item->id; ?></td>
                                <td class="w300 text-center"><?php echo $item->title; ?></td>
                                <td class="w100 text-center"><?php echo $item->url; ?></td>
                                <td class="w100 text-center"><?php echo $item->news_type; ?></td>
                                <td class="w200 text-center ">
                                    <?php if($item->news_type == "image") { ?>

                                        <img width="100"
                                             src="<?php echo get_picture($viewFolder, $item->img_url, "513x289"); ?>"
                                             alt=""
                                             class="img-rounded">

                                    <?php } else if($item->news_type == "video") { ?>

                                        <iframe
                                            width="100" height="60"
                                            src="<?php echo $item->video_url; ?>"
                                            frameborder="0"
                                            gesture="media"
                                            allow="encrypted-media"
                                            allowfullscreen>

                                        </iframe>

                                    <?php } ?>
                                </td>
                                <td class="text-center w100">
                                    <input
                                        data-url="<?php echo base_url("news/isActiveSetter/$item->id"); ?>"
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
                                            data-url="<?php echo base_url("news/delete/$item->id"); ?>"
                                            class="btn btn-sm btn-danger btn-outline remove-btn">
                                            <i class="fa fa-trash"></i> Delete
                                        </button>
                                    <?php } ?>
                                   <?php if(isAllowedUpdateModule()) { ?>
                                        <a href="<?php echo base_url("news/update_form/$item->id"); ?>" class="btn btn-sm btn-info btn-outline"><i class="fa fa-pencil-square-o"></i> Update</a>
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