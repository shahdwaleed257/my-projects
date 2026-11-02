<?php

class Users
{
    private $name;
    private $email;
    private $image;
    private $password;

    public function __construct($name, $email, $password, $image = "url")
    {
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->image = $image;
    }
}


$ahmed = new Users("ahmed", "com", "12345", "hhhhhh");

echo "<pre>";
var_dump($ahmed);
echo "</pre>";
