<?php

namespace Model;

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
