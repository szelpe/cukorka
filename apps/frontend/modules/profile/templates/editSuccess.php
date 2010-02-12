<?php slot('main'); ?>
<h2>Felhasználó adatai</h2>
<form method="POST" action="<?php echo $action; ?>">
    <table>
        <?php echo $form; ?>
        <tr>
            <td colspan="2">
                <input type="submit" value="Mehet" />
            </td>
        </tr>
    </table>
</form>
<?php end_slot(); ?>

<?php slot('sidebar') ?>
<div class="footer_box m_right">
    <div class="footer_bottom"></div>
    <h4>Adatok megadása</h4>
    <div class="footer_box_content">
        <p>Ezen az oldalon állíthatod be az adataidat.</p>
        <p>Minden mező kitöltése kötelező!</p>
        <div class="cleaner_h10"></div>
    </div>
</div>
<?php end_slot() ?>