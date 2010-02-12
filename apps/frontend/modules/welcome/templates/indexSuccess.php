<?php slot('main'); ?>
<h2>Tanfolyamok listája</h2>
<dl>
    <?php foreach($courses as $course) : ?>
    <dt><?php echo link_to($course->title, 'course', $course); ?></dt>
    <dd><?php echo $course->description; ?></dd>
    <?php endforeach; ?>
</dl>
<?php end_slot(); ?>

<?php slot('sidebar') ?>
<div class="footer_box m_right">
    <div class="footer_bottom"></div>
    <h4>Üdvözletem</h4>
    <div class="footer_box_content">
        <p>Üdvözöllek a KSZK Webteam házifeladat feltöltő és motivációs oldalán!</p>
        <p>Kérlek válassz tanfolyamaink közül!</p>
        <div class="cleaner_h10"></div>
    </div>
</div>
<?php end_slot() ?>