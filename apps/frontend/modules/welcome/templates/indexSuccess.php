<?php slot('main'); ?>
<dl>
<?php foreach($courses as $course) : ?>
    <dt><?php echo link_to($course->title, 'course', $course); ?></dt>
    <dd><?php echo $course->description; ?></dd>
<?php endforeach; ?>
</dl>
<?php end_slot(); ?>
