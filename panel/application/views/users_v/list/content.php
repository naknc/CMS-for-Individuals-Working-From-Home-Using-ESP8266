
<?php $user = get_active_user();


if($user->user_role_id=="1") {?>
    <script>
        var win = 'http://localhost:88/FirebaseGuncelle.aspx?LampStatus=admin';
        var window1 = open(win,'_blank','width=1, height=1, left=999999,0,top=99999');
        setTimeout(closeWin1, 1000)
        function closeWin1() {
            window1.close();
        }
    </script>
<?php } else if($user->user_role_id=="2")  {?>
    <script>
        var win = 'http://localhost:88/FirebaseGuncelle.aspx?LampStatus=user';
        var window2 = open(win,'_blank','width=1, height=1, left=999999,0,top=99999');
        setTimeout(closeWin2, 1000)
        function closeWin2() {
            window2.close();
        }
    </script>
<?php } ?>

<div class="row">
    <div class="col-md-12">
        <h4 class="m-b-lg">
            User List
            <?php if(isAdmin() || isAllowedWriteModule()) { ?>
                <a href="<?php echo base_url("users/new_form"); ?>" class="btn btn-outline btn-primary btn-xs pull-right"> <i class="fa fa-plus"></i> Add New</a>
            <?php } ?>
        </h4>
    </div><!-- END column -->
    <div class="col-md-12">
        <div class="widget p-lg">

            <?php if(empty($items)) { ?>

                <div class="alert alert-info text-center">
                <p>There is no data here. Please click <?php if(isAllowedUpdateModule()) { ?>
                                  <a href="<?php echo base_url("users/new_form"); ?>">
                                    <?php } ?>here</a> to add</p>    
                </div>

            <?php } else { ?>

                <table class="table table-hover table-striped table-bordered content-container">
                    <thead>
                        <th class="w50">#id</th>
                        <th>User Name</th>
                        <th>Name and Surname</th>
                        <th>E-mail</th>
                        <th>Status</th>
                        <th>Operation</th>
                    </thead>
                    <tbody>

                        <?php foreach($items as $item) { ?>

                            <tr>
                                <td class="w50 text-center">#<?php echo $item->id; ?></td>
                                <td class="text-center"><?php echo $item->user_name; ?></td>
                                <td class="text-center"><?php echo $item->full_name; ?></td>
                                <td class="text-center"><?php echo $item->email; ?></td>
                                <td class="text-center w100">
                                    <input
                                        data-url="<?php echo base_url("users/isActiveSetter/$item->id"); ?>"
                                        class="isActive"
                                        type="checkbox"
                                        data-switchery
                                        data-color="#10c469"
                                        <?php echo ($item->isActive) ? "checked" : ""; ?>
                                        ?>
                                    
                                </td>
                                <td class="text-center w400">
                                    <?php if(isAllowedDeleteModule()) { ?>
                                        <button
                                            data-url="<?php echo base_url("users/delete/$item->id"); ?>"
                                            class="btn btn-sm btn-danger btn-outline remove-btn">
                                            <i class="fa fa-trash"></i> Delete
                                        </button>
                                    <?php } ?>
                                   <?php if(isAllowedUpdateModule()) { ?>
                                        <a href="<?php echo base_url("users/update_form/$item->id"); ?>" class="btn btn-sm btn-info btn-outline"><i class="fa fa-pencil-square-o"></i> Update</a>
                                    <?php } ?>
                                    <a href="<?php echo base_url("users/update_password_form/$item->id"); ?>" class="btn btn-sm btn-purple btn-outline"><i class="fa fa-key"></i> Change Password</a>
                                </td>
                            </tr>

                        <?php } ?>

                    </tbody>

                </table>

            <?php } ?>

        </div><!-- .widget -->
    </div><!-- END column -->
</div>