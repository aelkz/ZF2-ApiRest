<?php 
namespace Course\Service\Course\Exception;

class InvalidDataException extends \Exception 
{
    public $message = 'Not valid data';
}