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
        <?php include_partial('homeworkTable', array('course' => $course,'lecture' => $lecture, 'user' => $user)) ?>
    </div>
    <?php if($user && $user->isStudent($course)): ?>
        <div id="homework_form">
            <?php include_partial('homeworkForm', array('form' => $form, 'lecture' => $lecture, 'course' => $course)); ?>
        </div>
    <?php endif; ?>
</div>
<?php end_slot(); ?>