<form method="POST" enctype="multipart/form-data" action="<?php echo url_for('lecture', array('lecture_url' => $lecture->url,'course_url' => $course->url)) ?>">
    <fieldset>
        <legend>Házifeladat feltöltése</legend>
        <p>Bármennyiszer tölhetsz fel házifeladatot, az újonnan feltöltött felülírja a korábbit.</p>
        <p>Engedélyezett típusok: .zip, .rar, .tar.gz</p>
        <p>Maximális méret: 200000 Byte</p>
        <?php echo $form; ?>
        <input type="submit" value="Feltöltés" />
    </fieldset>
</form>