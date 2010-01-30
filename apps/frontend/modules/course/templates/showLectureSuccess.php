<?php slot('main'); ?>
<h2><?php echo $lecture->title; ?></h2>
<div id="description">
    <?php echo $lecture->description; ?>
</div>
<div id="homework">
    <h3>Házi feladat</h3>
    <?php echo $lecture->homeworktask; ?>
    <div id="uploaded_homeworks">
        <p>Beadott házifeladatok:</p>
        <table>
            <thead>
                <tr>
                    <td>
                        Név
                    </td>
                    <td>
                        Fájl
                    </td>
                    <td>
                        Értékelés
                    </td>
                </tr>
            </thead>
            <tbody>
                <?php foreach($lecture->Homeworks as $homework) : ?>
                <tr>
                    <td>
                            <?php echo link_to($homework->User->Profile->full_name, 'profile_view', array('id' => $homework->User->Profile->id)); ?>
                    </td>
                    <td>
                            <?php echo $homework->filename; ?>
                    </td>
                    <td>
                            <?php echo $homework->rate; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div id="homework_form">
        <form method="POST" enctype="multipart/form-data" action="<?php echo url_for('lecture', array('lecture_url' => $lecture->url,'course_url' => $course->url)) ?>">
        <?php echo $form; ?>
            <input type="submit" />
        </form>
    </div>
</div>
<?php end_slot(); ?>