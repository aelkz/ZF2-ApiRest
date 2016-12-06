<?php

namespace Course\Inputfilter;

use Zend\InputFilter\InputFilter;

class CourseAddFIlter extends InputFilter
{
    public function __construct()
	{
        $this->add(array(
			'name'       => 'name',
			'required'   => false,
			'allowEmpty' => false,
			'filters'    => array(
				array('name' => 'StringTrim'),
			),
			'validators' => array(
				array(
					'name'    => 'StringLength',
					'options' => array(
						'min' => 5,
						'max' => 30,
					),
				),
			),
		));

		$this->add(array(
			'name'       => 'description',
			'required'   => false,
			'allowEmpty' => false,
			'filters'    => array(
				array('name' => 'StringTrim'),
			),
			'validators' => array(
				array(
					'name'    => 'StringLength',
					'options' => array(
						'min' => 5,
						'max' => 200,
					),
				),
			),
		));
    }
}
