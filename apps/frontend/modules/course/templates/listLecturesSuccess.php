<?php slot('main'); ?>
<h2><?php echo $course->title; ?></h2>
<div id="description">
    <?php echo $course->description; ?>
</div>
<div id="users">
    <div id="lecturers">
        <p>A tanfolyam előadói:</p>
        <ul>
            <?php foreach($course->Lecturers as $lecturer): ?>
            <li><?php echo link_to($lecturer->Profile->full_name, 'profile_view', array('id' => $lecturer->id)); ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
    <div id="students">
        <p>A tanfolyam résztvevői:</p>
        <ul>
            <?php foreach($course->Students as $student): ?>
            <li><?php echo link_to($student->Profile->full_name, 'profile_view', array('id' => $student->id)); ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>
<?php end_slot(); ?>