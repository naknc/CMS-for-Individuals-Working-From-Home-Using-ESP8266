<?php if(empty($item_images)) { ?>

    <div class="alert alert-info text-center">
        <p>There are no pictures here.</a></p>
    </div>

<?php } else { ?>

    <table class="table table-bordered table-striped table-hover pictures_list">
        <thead>
        <th class="order"><i class="fa fa-reorder"></i></th>
        <th>#id</th>
        <th>Image</th>
        <th>Image Name</th>
        <th>Status</th>
        <?php if(isAdmin()) { ?>
            <th>Cover</th>
        <?php } ?>
        <th>Operation</th>
        </thead>
        <tbody class="sortable" data-url="<?php echo base_url("portfolio/imageRankSetter"); ?>">

        <?php foreach($item_images as $image){ ?>

            <tr id="ord-<?php echo $image->id; ?>">
                <td class="order"><i class="fa fa-reorder"></i></td>
                <td class="w50 text-center">#<?php echo $image->id; ?></td>
                <td class="w100 text-center">
                    <img width="30"
                         src="<?php echo get_picture($viewFolder, $image->img_url, "255x157"); ?>"
                         alt="<?php echo $image->img_url; ?>"
                         class="img-responsive">
                </td>
                <td><?php echo $image->img_url; ?></td>
                <td class="w100 text-center">
                    <input
                        data-url="<?php echo base_url("portfolio/imageIsActiveSetter/$image->id"); ?>"
                        class="isActive"
                        type="checkbox"
                        data-switchery
                        data-color="#10c469"
                        <?php echo ($image->isActive) ? "checked" : ""; ?>
                    />
                </td>
                <?php if(isAdmin()) { ?>
                    <td class="w100 text-center">
                        <input
                            data-url="<?php echo base_url("portfolio/isCoverSetter/$image->id/$image->portfolio_id"); ?>"
                            class="isCover"
                            type="checkbox"
                            data-switchery
                            data-color="#ff5b5b"
                            <?php echo ($image->isCover) ? "checked" : ""; ?>
                        />
                    </td>
                <?php } ?>
                <td class="w100 text-center">
                    <?php if(isAllowedDeleteModule()) { ?>
                                   <button
                        data-url="<?php echo base_url("portfolio/imageDelete/$image->id/$image->portfolio_id"); ?>"
                        class="btn btn-sm btn-danger btn-outline remove-btn btn-block">
                        <i class="fa fa-trash"></i> Delete
                    </button>
                                    <?php } ?>
                </td>
            </tr>

        <?php } ?>

        </tbody>

    </table>
<?php } ?>