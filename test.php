<?php

require_once 'NationalIdentity.php';

$algorithm = new NationalIdentity();
$algorithm->nationalIdentity = '99999999999';
$algorithm->name = 'Alimsah';
$algorithm->surname = 'YILDIRIM';
$algorithm->birthDate = '1995';

var_dump($algorithm->checkAlgorithm()); # verifies is $nationalIdentity contains valid identity.
$algorithm->findFamilyNationalIdentites(120); # finds family members identity numbers (up to 120)
