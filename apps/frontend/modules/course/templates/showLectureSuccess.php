<?php slot('main'); ?>
<div class="section_w590">
    <h2><?php echo $lecture->title; ?></h2>
    <div id="description">
        <p><?php echo $lecture->description; ?></p>
    </div>
    <div id="homework">
        <h3>Házi feladat</h3>
        <p><?php echo $lecture->homeworktask; ?></p>
        <div id="uploaded_homeworks">
            <h3>Beadott házifeladatok:</h3>
            <?php include_partial('homeworkTable', array('course' => $course,'lecture' => $lecture, 'user' => $user)) ?>
        </div>
        <?php if($user && $user->isStudent($course)): ?>
        <div id="homework_form">
                <?php include_partial('homeworkForm', array('form' => $form, 'lecture' => $lecture, 'course' => $course)); ?>
        </div>
        <?php endif; ?>
    </div>
    <div id="aid">
        <?php //echo $aidForm; ?>
    </div>
</div>
<div class="cleaner"></div>
<?php end_slot(); ?>