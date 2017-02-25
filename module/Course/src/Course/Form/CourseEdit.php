<?php
namespace Course\Form;

use Course\Form\CourseAdd;

class CourseEdit extends CourseAdd
{
    public function __construct($name = 'course', $options = array())
    {
        parent::__construct($name, $options);

        $this->add(array(
            'name' => 'id',
            'options' => array(
            ),
            'attributes' => array(
                'type' => 'hidden'
            )
        ));
    }
}
