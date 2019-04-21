<?php
namespace Core\Service;

trait IsDate
{
    public function isFrenchDate($value)
    {
        $isDate = false;
        // Is not an object
        if(!is_object($value)) {
            $match = preg_match('/(\d{2})\/(\d{2})\/(\d{4})/', $value, $matches);
            if($match) {
                $isDate = checkdate($matches[2], $matches[1], $matches[3]);
            }
        // Id DateTime
        } else if (get_class($value) === 'DateTime'){
            $isDate = true;
        }
        return $isDate;
    }

}