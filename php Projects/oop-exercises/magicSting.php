<?php

class User
{

    // خصائص الكلاس 
    public $name;
    public $email;
    public $image;
    public $password;

    public function __toString()
    {
        return "Welcom To Users";
    }
}


$user = new User;

echo $user;
