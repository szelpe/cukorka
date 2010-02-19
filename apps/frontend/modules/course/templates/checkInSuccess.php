<?php slot('main') ?>
<h2>Jelentkezés</h2>
<br />
<?php if(!$course->isStudentCheckedIn()) : ?>
<p>Az alábbi űrlap kitöltésével regisztrálhatsz az oldalra, és egyben jelentkezel is az adott tanfolyamra.</p>
<form method="post" action="<?php echo $sf_request->getUri() ?>">
    <table>
<?php echo $form ?>
    </table>
    <input type="submit" value="Jelentkezek!" />
</form>
<?php else : ?>
<p>Már jelentkeztél a tanfolyamra. Hamarosan értesítünk levélben.</p>
<?php endif; ?>
<?php end_slot() ?>