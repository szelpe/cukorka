<?php use_helper('I18N') ?>
<?php if(isset($loginForm)) : ?>
<form action="<?php echo preg_replace('/http/', 'https', url_for('@sf_guard_signin', true)) ?>" method="post">
    
        <?php foreach($loginForm as $field) : ?>
        <?php if(!$field->isHidden()) { echo __($field->renderLabel()); } echo ' ' . $field->render(); ?>
        <?php endforeach; ?>
    

    <input type="submit" value="<?php echo __('sign in') ?>" />
    <a href="<?php echo url_for('@register') ?>"><?php echo __('Register') ?></a>
</form>
<?php else : ?>
<?php echo $user->username . ' ' . link_to('Logout', '@sf_guard_signout') ?>
<?php endif; ?>