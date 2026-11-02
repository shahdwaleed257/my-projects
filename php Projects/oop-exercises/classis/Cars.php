<?php

namespace news;


require 'User.php';


class Cars extends User {}


$car = new Cars();

echo "<pre>";
var_dump($car);
echo "</pre>";
