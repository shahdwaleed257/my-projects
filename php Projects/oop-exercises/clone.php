<?php

class  Cars
{
    public $model;
    public $color;
    public $speed;
}



$car1 = new Cars();


$car1->model = "1990";
$car1->color = "red";
$car1->speed = "250";


echo "<pre>";
var_dump($car1);
echo "</pre>";

// $car2 = $car1;  // بيكون نفس الكائن 
$car2 = clone $car1;

$car2->model = "2001";

echo "<br>car2";

echo "<pre>";
var_dump($car2);
echo "</pre>";

echo "<br>car1";

echo "<pre>";
var_dump($car1);
echo "</pre>";
