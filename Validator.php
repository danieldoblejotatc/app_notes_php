<?php
// Validator.php
class Validator
{
    public static function string($value, $min = 1, $max = 255)
    {
        $values = trim($value);
        return mb_strlen($values) >= $min && mb_strlen($values) <= $max;
    }

    public static function email($value)
    {
        return filter_var($value, FILTER_VALIDATE_EMAIL);
    }
}
