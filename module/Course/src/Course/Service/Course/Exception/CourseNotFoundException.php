<?php

namespace Course\Service\Course\Exception;

class CourseNotFoundException extends \Exception
{
    public $message = 'Course not found';
}
