<div role="tabpanel" class="tab-pane in active fade" id="tab-1">

    <div class="row">

        <div class="form-group col-md-8">
            <label>Company Name</label>
            <input class="form-control" placeholder="Company or Site name"
                   name="company_name"
                   value="<?php echo isset($form_error) ? set_value("company_name") : ""; ?>">
            <?php if (isset($form_error)) { ?>
                <small
                    class="pull-right input-form-error"> <?php echo form_error("company_name"); ?></small>
            <?php } ?>
        </div>


    </div>

    <div class="row">

        <div class="form-group col-md-4">
            <label>Phone 1</label>
            <input class="form-control" placeholder="Your phone number"
                   name="phone_1"
                   value="<?php echo isset($form_error) ? set_value("phone_1") : ""; ?>">
            <?php if (isset($form_error)) { ?>
                <small
                    class="pull-right input-form-error"> <?php echo form_error("phone_1"); ?></small>
            <?php } ?>
        </div>

        <div class="form-group col-md-4">
            <label>Phone 2</label>
            <input class="form-control" placeholder="Your other phone number (optional)" name="phone_2">
        </div>

    </div>

    <div class="row">
        <div class="form-group col-md-4">
            <label>Fax 1</label>
            <input class="form-control" placeholder="Fax number"
                   name="fax_1">
        </div>

        <div class="form-group col-md-4">
            <label>Fax 2</label>
            <input class="form-control" placeholder="Your other fax number (optional)" name="fax_2">
        </div>
    </div>

</div><!-- .tab-pane  -->