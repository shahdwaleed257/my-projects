<?php

class  Users
{
    // خصائص الكلاس 
    public $name;
    public $email;
    public $image;
    public $password;

    public function printName()
    {
        return "welcom " . " " . $this->name;
    }
}


class Cars extends Users
{
    public $color;
    public $speed;
    public $model;
}




$user = new Users();

echo "<pre>";
var_dump($user);
echo "</pre>";

$car = new Cars();


echo "<pre>";
var_dump($car);
echo "</pre>";
