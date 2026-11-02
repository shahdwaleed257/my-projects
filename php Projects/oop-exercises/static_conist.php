<?php

class  Users
{
    // خصائص الكلاس 
    public static $name;

    public const city = "alx";

    public function printName()
    {
        return "welcom " . " " . self::$name;

        self::$name;
        self::city;
    }
}

Users::$name = "taha";


echo Users::city;

// var_dump($taha);
// echo "</pre>";
