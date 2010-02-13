<form method="POST" action="<?php echo $sf_request->getUri() ?>" enctype="multipart/form-data">
    <table>
        <caption>Segédanyag feltöltése</caption>
        <?php echo $aidForm; ?>
    </table>
    <input type="submit" value="Feltöltés" />
</form>