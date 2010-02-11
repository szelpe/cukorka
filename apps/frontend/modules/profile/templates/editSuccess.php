<?php slot('main'); ?>
<form method="POST" action="<?php echo $action; ?>">
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