<?php

require 'vendor/autoload.php';

use Person;

$person = new Person();
$person->setName('Mr. Anderson');
$person->setAge(33);
$person->setAddress(['Moscow']);

$binary = $person->serializeToString();

$newPerson = new Person();
$newPerson->mergeFromString($binary);
echo $newPerson->getName();