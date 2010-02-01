<?php if($lecture->Homeworks->count()): ?>
    <table>
        <thead>
            <tr>
                <td>
                    Név
                </td>
                <td>
                    Fájl
                </td>
                <td>
                    Értékelés
                </td>
            </tr>
        </thead>
        <tbody>
            <?php foreach($lecture->Homeworks as $homework) : ?>
            <tr>
                <td>
                        <?php echo link_to($homework->User->Profile->full_name, 'profile_view', array('id' => $homework->User->Profile->id)); ?>
                </td>
                <td>
                        <?php echo link_to($homework->filename, '/uploads/homeworks/' . $course->url . '/' . $lecture->url . '/' . $homework->User->username . '/' . $homework->filename); ?>
                </td>
                <td>
                        <?php if($user && $user->isLecturer($course)): ?>
                            <select name="rateselector" id="{ homework : <?php echo $homework->id ?> }">
                                <option value="0">nincs értékelve</option>
                                <?php for($i = 1; $i <= 10; $i++): ?>
                                    <option value="<?php echo $i ?>" <?php if($homework->rate == $i) echo 'selected="selected"' ?>><?php echo $i ?></option>
                                <?php endfor; ?>
                            </select>
                        <?php else : ?>
                            <?php if($homework->rate): ?>
                                <?php echo $homework->rate; ?>
                            <?php else: ?>
                                nincs értékelve
                            <?php endif; ?>
                        <?php endif; ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <p> Még nincs beadva házifeladat </p>
<?php endif; ?>