<?php

class  Users
{
    // خصائص الكلاس 

    private $properties;

    public function __set($name, $value)
    {
        $this->properties[$name] = $value;
    }

    public function __get($name)
    {
        if (array_key_exists($name, $this->properties)) {
            return $this->properties[$name];
        } else {
            return null;
        }
    }
}


$mohamed = new Users();

$mohamed->name = " mohamed";

$mohamed->email = " taha@.com";

$mohamed->image = "url.com";


echo "<pre>";
var_dump($mohamed);
echo "</pre>";

// echo $taha->printName();

// echo "<pre>";
// var_dump($taha);
// echo "</pre>";
