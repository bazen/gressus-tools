<?php

require('../autoload.php');


$dataMapperService = new Gressus\Tools\DataMapperService(
    array(
        'Identifier' => 'id',
        'Group + Name' => new Gressus\Tools\Mapper\Concat(array('group',new Gressus\Tools\Mapper\FirstNotEmpty(array('full_name','name')))),
        'Counter' => new Gressus\Tools\Mapper\Counter(),
        'FirstChar' => new Gressus\Tools\Mapper\FirstChar('name'),
        'Name' => new Gressus\Tools\Mapper\FirstNotEmpty(array('full_name','name')),
        'Hash' => new Gressus\Tools\Mapper\All(),
        'Weapons' => new Gressus\Tools\Mapper\ArrayPath('special/weapons'),
    ),
    array(
          new Gressus\Tools\Converter\Serialize('Hash'),
          new Gressus\Tools\Converter\Md5('Hash'),
          new Gressus\Tools\Converter\Implode('Weapons'),
    ),
    array(
        array('score',new \Gressus\Tools\Filter\GreaterThanFilter(0)),
    ),
    array(
        array('Counter',new \Gressus\Tools\Filter\GreaterThanFilter(1)),
    )
);



$data = array(
    array('id' => '1', 'group' => 'Police',   'name' => 'Melanie',   'score' => 1, 'full_name' => 'Melanie Meyer', 'special' => array('weapons' => array('Walter','Tonfa'))),
    array('id' => '2', 'group' => 'Police',   'name' => 'Kerstin',   'score' => 1, 'full_name' => 'Kerstin Meyer', 'special' => array('weapons' => array('Walter','Tonfa'))),
    array('id' => '3', 'group' => 'Police',   'name' => 'Thomas',    'score' => 4, 'full_name' => 'Thomas Thiel', 'special' => array('weapons' => array('Walter','Tonfa'))),
    array('id' => '5', 'group' => 'Gangster', 'name' => 'Hafti',     'score' => 10, 'special' => array('weapons' => array('Knife','AKAI 47'))),
    array('id' => '6', 'group' => 'Gangster', 'name' => 'Fler',      'score' => 0),
    array('id' => '7', 'group' => 'Press',    'name' => 'Steiger',   'score' => 0),
    array('id' => '8', 'group' => 'Press',    'name' => 'Sz',        'score' => 5),
    array('id' => '9', 'group' => 'Press',    'name' => 'Max',       'score' => 1),
    array('id' => '10','group' => 'Press',    'name' => 'Max',       'score' => 1),
);


$mappedData = $dataMapperService->map($data);

print_r($mappedData);


$csvService = new \Gressus\Tools\CsvService();

$csvService->setAssociatedArrayData($mappedData)->setFileName('../Data/example-data.csv')->write();
