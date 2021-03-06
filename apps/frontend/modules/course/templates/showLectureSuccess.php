<?php slot('main'); ?>
<div class="section_w590">
    <h2><?php echo $lecture->title; ?></h2>
    <span id="navi"><?php echo link_to($course->title, 'course', array('url' => $course->url)) ?> > <?php echo $lecture->title ?></span>
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
        <?php if($lecture->displayHomeworkForm() == true): ?>
        <div id="homework_form">
                <?php include_partial('homeworkForm', array('form' => $form, 'lecture' => $lecture, 'course' => $course)); ?>
        </div>
        <?php endif; ?>
    </div>
    <div id="aid">
        <h3>Segédanyagok</h3>
        <ul>
            <?php foreach($lecture->Aids as $aid) : ?>
            <li>
                <?php echo link_to($aid->title, preg_replace('/\./', ':', $aid->getFileURL())) ?>
            </li>
            <?php endforeach; ?>
        </ul>
        <?php if($lecture->displayAidForm() == true): ?>
        <?php include_partial('aidForm', array('aidForm' => $aidForm)) ?>
        <?php endif; ?>
    </div>
</div>
<div class="cleaner"></div>
<?php end_slot(); ?>