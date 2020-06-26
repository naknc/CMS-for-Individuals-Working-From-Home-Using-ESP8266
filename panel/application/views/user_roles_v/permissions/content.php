<?php $permissions = json_decode($item->permissions); ?>

<div class="row">
    <div class="col-md-12">
        <h4 class="m-b-lg">
            <?php echo "You are changing the privileges of the <b>$item->title</b>"; ?>
        </h4>
    </div><!-- END column -->
    <div class="col-md-12">
        <div class="widget">
            <div class="widget-body">
                <form action="<?php echo base_url("user_roles/update_permissions/$item->id"); ?>" method="post">

                    <table class="table table-bordered table-striped table-hover">
                        <thead>
                            <th>Module Name</th>
                            <th>Read</th>
                            <th>Write</th>
                            <th>Update</th>
                            <th>Delete</th>
                        </thead>
                        <tbody>
                        <?php foreach (getControllerList() as $controllerName) { ?>
                                <tr>
                                    <td><?php echo $controllerName; ?></td>
                                    <td class="w50 text-center">
                                        <input
                                                <?php echo (isset($permissions->$controllerName) && isset($permissions->$controllerName->read)) ? "checked" : ""; ?>
                                                name="permissions[<?php echo $controllerName; ?>][read]" type="checkbox" data-switchery data-color="#10c469"/>
                                    </td>
                                    <td class="w50 text-center">
                                        <input
                                                <?php echo (isset($permissions->$controllerName) && isset($permissions->$controllerName->write)) ? "checked" : ""; ?>
                                                name="permissions[<?php echo $controllerName; ?>][write]" type="checkbox" data-switchery data-color="#10c469"/>
                                    </td>
                                    <td class="w50 text-center">
                                        <input
                                                <?php echo (isset($permissions->$controllerName) && isset($permissions->$controllerName->update)) ? "checked" : ""; ?>
                                                name="permissions[<?php echo $controllerName; ?>][update]" type="checkbox" data-switchery data-color="#10c469"/>
                                    </td>
                                    <td class="w50 text-center">
                                        <input
                                                <?php echo (isset($permissions->$controllerName) && isset($permissions->$controllerName->delete)) ? "checked" : ""; ?>
                                                name="permissions[<?php echo $controllerName; ?>][delete]" type="checkbox" data-switchery data-color="#10c469"/>
                                    </td>
                                </tr>
                        <?php } ?>

                        </tbody>
                    </table>

                    <hr>

                    <?php if(isAllowedUpdateModule()) { ?>
     <button type="submit" class="btn btn-primary btn-md btn-outline">Update</button>
<?php } ?>
                    <a href="<?php echo base_url("user_roles"); ?>" class="btn btn-md btn-danger btn-outline">Cancel</a>
                </form>
            </div><!-- .widget-body -->
        </div><!-- .widget -->
    </div><!-- END column -->
</div>