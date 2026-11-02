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

$mohamed = new Users();
$mohamed->name = "mohamed";
$mohamed->email = "moh@m.com";
$mohamed->password = "1256666";


$taha = new Users();
$taha->name = "taha";
// $taha->email = "taha@taha.com";
// $taha->image = "taha.com";
// $taha->password = "244445";

echo $taha->printName();

echo "<pre>";
var_dump($taha);
echo "</pre>";


echo "<pre>";
var_dump($mohamed);
echo "</pre>";

$car = new Cars();
echo "<pre>";
var_dump($car);
echo "</pre>";
