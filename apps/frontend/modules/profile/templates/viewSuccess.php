<?php slot('main'); ?>
<h1>Profil</h1>
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
<h2>Tanfolyamok, ahol előadást tart:</h2>
<ul>
    <?php foreach($user->CoursesProfess as $course) : ?>
    <li>
        <?php echo link_to($course->title, 'course', $course); ?>
    </li>
    <?php endforeach; ?>
</ul>
<h2>Tanfolyamok, melyeken részt vesz:</h2>
<ul>
    <?php foreach($user->CoursesAttend as $course) : ?>
    <li>
        <?php echo link_to($course->title, 'course', $course); ?>
    </li>
    <?php endforeach; ?>
</ul>
<?php end_slot(); ?>