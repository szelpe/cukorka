<div class="footer_box m_right">
    <div class="footer_bottom"></div>
    <h4>Előadások</h4>
    <div class="footer_box_content">
        <p>A tanfolyamhoz tartozó előadások:</p>
        <div class="cleaner_h10"></div>
        <ol class="list_01">
            <?php foreach($course->Lectures as $lecture): ?>
            <li>
                    <?php echo link_to($lecture, 'lecture', array('course_url' => $course->url, 'lecture_url' => $lecture->url)); ?>
            </li>
            <?php endforeach; ?>
        </ol>
    </div>
</div>