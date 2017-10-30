<?php
/**
 * Created by PhpStorm.
 * User: bpeeten
 * Date: 30/10/17
 * Time: 21:40
 */

class ModelException extends \Exception
{
    public function __construct(
        $message,
        $code = 0,
        \Exception $previous = null
    )
    {

        parent::__construct($message, $code, $previous);
    }
}