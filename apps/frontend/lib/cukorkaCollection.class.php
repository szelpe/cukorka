<?php
/**
 * This is my extension for Doctrine_Collection
 * 
 * @see frontendConfiguration.class.php
 * @author szelpe
 */
class cukorkaCollection extends Doctrine_Collection {

    /**
     *
     * @example
     *      $course = Doctrine::getTable('Course')->findOneById(3);
     *      $user->CoursesAttend->contains($course);
     * @param sfDoctrineRecord $values
     * @return bool Whether the collection contains the values
     */
    public function contains($values) {

        //get keys
        $ids = $this->_table->getIdentifierColumnNames();

        foreach($this->data as $data) {
            $has_same_ids = true;
            foreach($ids as $id) {
                if($values[$id] != $data[$id]) {
                    $has_same_ids = false;
                }
            }
            if($has_same_ids)
                return true;
        }
        return false;
    }
}
?>
