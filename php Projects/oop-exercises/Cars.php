<?php

namespace Model;

require 'User.php';

// use Model\Users as Users;

class Cars extends Users {}
$car = new Cars();
echo "<pre>";
var_dump($car);
echo "</pre>";
