<?php use_helper('I18N') ?>
<?php if(isset($loginForm)) : ?>
<form action="<?php echo url_for('@sf_guard_signin') ?>" method="post">
    <table>
        <?php echo $loginForm ?>
    </table>

    <input type="submit" value="<?php echo __('sign in') ?>" />
    <a href="<?php echo url_for('@sf_guard_password') ?>"><?php echo __('Forgot your password?') ?></a>
</form>
<?php else : ?>
<?php echo link_to('Logout', '@sf_guard_signout') ?>
<?php endif;; ?>