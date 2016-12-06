<?php
namespace Course\Form;

use Zend\Form\Form;
use Zend\Debug\Debug as ZDebug;

class CourseAdd extends Form
{
    public function __construct($name = 'course', $options = array())
	{
		parent::__construct($name, $options);
        				
		$this->add(array(
			'name' => 'name',
			'type' => 'Text',
			'attributes' => array(
				'class' => 'Name',	
			),
			'options' => array(
				'label' => 'Name',
			),
		));	    
	    
	    $this->add(array(
			'name' => 'description',
			'type' => 'Textarea',
			'attributes' => array(
				'class' => 'Description',	
			),
			'options' => array(
				'label' => 'Description',
			),
		));	
	   
/*
   		$this->add(array(
		    'type' => 'Zend\Form\Element\Csrf',
		    'name' => 'courseAddCsrf',
		    'options' => array(
		        'csrf_options' => array(
		            'timeout' => 600
		        ),
		    ),
		));
*/

    }
}