<?php

namespace Course\InputFilter;

use Course\InputFilter\CourseAddFilter;

class CourseEditFilter extends CourseAddFilter
{
    public function __construct()
    {
        parent::__construct();

        $this->add(array(
            'name'       => 'id',
            'required'   => false,
            'allowEmpty' => false,
            'filters'    => array(
            ),
            'validators' => array(
            ),
        ));
    }
}

