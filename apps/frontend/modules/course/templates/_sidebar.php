<p>A tanfolyamhoz tartozó előadások:</p>
<ul>
<?php foreach($course->Lectures as $lecture): ?>
    <li>
        <?php echo link_to($lecture, 'lecture', array('course_url' => $course->url, 'lecture_url' => $lecture->url)); ?>
    </li>
<?php endforeach; ?>
</ul>