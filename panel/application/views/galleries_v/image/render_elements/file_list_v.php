<?php if(empty($items)) { ?>

    <div class="alert alert-info text-center">
        <p><a>There is no picture here. </a></p>
    </div>

<?php } else { ?>

    <table class="table table-bordered table-striped table-hover pictures_list">
        <thead>
        <th class="order"><i class="fa fa-reorder"></i></th>
        <th>#id</th>
        <th>Image</th>
        <th>File Path / Name</th>
        <th>Status</th>
        <th>Operation</th>
        </thead>
        <tbody class="sortable" data-url="<?php echo base_url("galleries/fileRankSetter/$gallery_type"); ?>">

        <?php foreach($items as $item){ ?>

            <tr id="ord-<?php echo $item->id; ?>">
                <td class="order"><i class="fa fa-reorder"></i></td>
                <td class="w50 text-center">#<?php echo $item->id; ?></td>
                <td class="w100 text-center">
                    <?php if($gallery_type == "image"){ ?>
                        <img
                                width="100"
                                src="<?php echo get_picture("galleries_v/images/$folder_name",$item->url,"252x156") ?>"
                                alt="<?php echo $item->url; ?>"
                                class="img-responsive">
                    <?php } else if($gallery_type == "file") { ?>
                        <i class="fa fa-folder fa-2x"></i>
                    <?php } ?>
                </td>
                <td><?php echo $item->url; ?></td>
                <td class="w100 text-center">
                    <input
                        data-url="<?php echo base_url("galleries/fileIsActiveSetter/$item->id/$gallery_type"); ?>"
                        class="isActive"
                        type="checkbox"
                        data-switchery
                        data-color="#10c469"
                        <?php echo ($item->isActive) ? "checked" : ""; ?>
                    />
                </td>

                <td class="w100 text-center">
                    <?php if(isAllowedDeleteModule()) { ?>
                                      <button
                        data-url="<?php echo base_url("galleries/fileDelete/$item->id/$item->gallery_id/$gallery_type"); ?>"
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