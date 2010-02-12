<?php slot('main'); ?>
<div class="section_w590">
<h2><?php echo $course->title; ?></h2>
<div id="description">
    <p><?php echo $course->description; ?></p>
</div>
<div id="users">
    <div id="lecturers">
        <h3>A tanfolyam előadói:</h3>
        <ul>
            <?php foreach($course->Lecturers as $lecturer): ?>
            <li><?php echo link_to($lecturer->Profile->full_name, 'profile_view', array('id' => $lecturer->id)); ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
    <div id="students">
        <h3>A tanfolyam résztvevői:</h3>
        <ul>
            <?php foreach($course->Students as $student): ?>
            <li><?php echo link_to($student->Profile->full_name, 'profile_view', array('id' => $student->id)); ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>
</div>
<div class="cleaner"></div>
<?php end_slot(); ?>