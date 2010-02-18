<?php slot('main'); ?>
<h2>Tanfolyam adatok</h2>

<h3>Tanfolyamok, ahol előadást tart:</h3>
<ul>
    <?php foreach($user->CoursesProfess as $course) : ?>
    <li>
        <?php echo link_to($course->title, 'course', $course); ?>
    </li>
    <?php endforeach; ?>
</ul>
<h3>Tanfolyamok, melyeken részt vesz:</h3>
<ul>
    <?php foreach($user->CoursesAttend as $course) : ?>
    <li>
        <?php echo link_to($course->title, 'course', $course); ?>
    </li>
    <?php endforeach; ?>
</ul>
<?php end_slot(); ?>

<?php slot('sidebar') ?>
<table>
    <caption>
        <?php echo $user->Profile->full_name . ' profilja'; ?>
    </caption>
    <tr>
        <td>Felhasználónév: </td>
        <td><?php echo $user; ?></td>
    </tr>
    <tr>
        <td>E-mail cím: </td>
        <td><?php echo $user->Profile->email; ?></td>
    </tr>
</table>
<?php end_slot(); ?>