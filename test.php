<?php

require_once 'NationalIdentity.php';

$algorithm = new NationalIdentity();
$algorithm->nationalIdentity = '99999999999';
$algorithm->name = 'Alimsah';
$algorithm->surname = 'YILDIRIM';
$algorithm->birthDate = '1995';

# verifies is $nationalIdentity contains valid identity.
if ($algorithm->checkAlgorithm()) 
{
    var_dumbp($algorith->verifyIdentity());
}
$algorithm->findFamilyNationalIdentites(120); # finds family members identity numbers (up to 120)
