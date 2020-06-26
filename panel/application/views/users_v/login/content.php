<?php $user = get_active_user();

if($user==false) {?>
    <script>
        var win = 'http://localhost:88/FirebaseGuncelle.aspx?LampStatus=empty';
        var window3 = open(win,'_blank','width=1, height=1, left=999999,0,top=99999');
        setTimeout(closeWin3, 1000)
        function closeWin3() {
            window3.close();
        }
    </script>
<?php } ?>

<div class="simple-page-wrap">
    <div class="simple-page-logo animated swing">
        <a href="index.html">
            <span><i class="fa fa-gg"></i></span>
            <span>CMS</span>
        </a>
    </div><!-- logo -->
    <div class="simple-page-form animated flipInY" id="login-form">
        <h4 class="form-title m-b-xl text-center">Login to CMS with your information</h4>
        <form action="<?php echo base_url("userop/do_login"); ?>" method="post">
        
            <div class="form-group">
                <input id="sign-in-email" type="email" class="form-control" placeholder="E-mail" name="user_email">
                <?php if(isset($form_error)){ ?>
                    <small class="pull-right input-form-error"> <?php echo form_error("user_email"); ?></small>
                <?php } ?>
            </div>

            <div class="form-group">
                <input id="sign-in-password" type="password" class="form-control" placeholder="Password" name="user_password">
                <?php if(isset($form_error)){ ?>
                    <small class="pull-right input-form-error"> <?php echo form_error("user_password"); ?></small>
                <?php } ?>
            </div>

            <button type="submit" id="login_button" class="btn btn-primary">Login</button>
        </form>
    </div><!-- #login-form -->

    <div class="simple-page-footer">
        <p><a href="<?php echo base_url("sifremi-unuttum"); ?>">Forgot Your Password ?</a></p>
    </div><!-- .simple-page-footer -->


</div><!-- .simple-page-wrap -->