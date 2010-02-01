<?php slot('main'); ?>
<form method="POST" action="<?php echo url_for('profile_action', array('id' => $user->id, 'action' => 'edit')); ?>">
    <table>
        <?php echo $form; ?>
        <tr>
            <td colspan="2">
                <input type="submit" />
            </td>
        </tr>
    </table>
</form>
<?php end_slot(); ?>