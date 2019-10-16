<?php

require_once 'NationalIdentity.php';

$algorithm = new NationalIdentity();
$algorithm->nationalIdentity = '99999999999';
$algorithm->name = 'Alimşah';
$algorithm->surname = 'YILDIRIM';
$algorithm->birthDate = '1995';

$algorithm->findFamilyNationalIdentities(20, false);
$foundedIdentites = $algorithm->getFoundedNationalIdentities();
$birthDates = array();

# names for brute force
$names = array
(
    'Osman',
    'Mehmet',
    'Osman',
    'Ali',
    'Simirna',
    'Selin',
    'Zeynep',
    'Yaren'
);

# generates birth dates from 1960 to 2000
for ($i = 1960; $i < 2000; $i++)
{
    array_push($birthDates, ''.$i);
}

$foundedPersons = array();

# Brute forcing 
for ($identityIndex = 0; $identityIndex < count($foundedIdentites); $identityIndex++)
{
    for ($nameIndex = 0; $nameIndex < count($names); $nameIndex++)
    {
        for ($dateIndex = 0; $dateIndex < count($birthDates); $dateIndex++)
        {
            $algorithm->nationalIdentity = $foundedIdentites[$identityIndex];
            $algorithm->name = $names[$nameIndex];
            $algorithm->birthDate = $birthDates[$dateIndex];
            
            if ($algorithm->verifyIdentity())
            {
                array_push($foundedPersons, array
                (
                    'name'      =>  $names[$nameIndex],
                    'surname'    =>  $algorithm->surname,
                    'birthDate' =>  $birthDates[$dateIndex],
                    'identity'  =>  $foundedIdentites[$identityIndex]
                ));
            }
            sleep(10);
        }
    }
}

# printing founded persons
foreach ($foundedPersons as $p)
{
    echo '<p>Name: '.$p['name'].'</p>';
    echo '<p>Surname: '.$p['surname'].'</p>';
    echo '<p>Identity: '.$p['identity'].'</p>';
    echo '<p>Birth Date: '.$p['birthDate'].'</p>';
    echo '<p></p>';
    echo '<p>-------------------------------------</p>';
}
echo '<p>'.count($foundedPersons).' person founded</p>';
