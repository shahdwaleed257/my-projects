<?php

class  Users
{
    // خصائص الكلاس 
    private $name;
    private $email;
    private $image;
    private $password;

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }
}


$mohamed = new Users();
$mohamed->setName('mohamed');

echo $mohamed->getName();
echo "<pre>";
var_dump($mohamed);
echo "</pre>";

// echo $taha->printName();

// echo "<pre>";
// var_dump($taha);
// echo "</pre>";
