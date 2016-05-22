<?php
namespace Gressus\Tools;
require('../autoload.php');


$data = array(
    array('id' => '1', 'group' => 'Police',   'name' => 'Melanie',   'score' => 1, 'full_name' => 'Melanie Meyer'),
    array('id' => '2', 'group' => 'Police',   'name' => 'Kerstin',   'score' => 1, 'full_name' => 'Kerstin Meyer'),
    array('id' => '3', 'group' => 'Police',   'name' => 'Thomas',    'score' => 4, 'full_name' => 'Thomas Thiel'),
    array('id' => '5', 'group' => 'Gangster', 'name' => 'Hafti',     'score' => 10,),
    array('id' => '6', 'group' => 'Gangster', 'name' => 'Fler',      'score' => 0),
    array('id' => '7', 'group' => 'Press',    'name' => 'Steiger',   'score' => 0),
    array('id' => '8', 'group' => 'Press',    'name' => 'Sz',        'score' => 5),
    array('id' => '9', 'group' => 'Press',    'name' => 'Max',       'score' => 1),
    array('id' => '10','group' => 'Press',    'name' => 'Max',       'score' => 1),
);


$csvService = new CsvService();
$csvService
    ->setAssociatedArrayData($data)
    ->setFileName('../Data/example-data-write.csv')
    ->write();
