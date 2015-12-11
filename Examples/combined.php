<?php

require('../autoload.php');


$csvService = new \Gressus\Tools\CsvService();

$csvService->read('../Data/example-data.csv');

$csvData = $csvService->getAssociatedArrayData();

print_r($csvData);

$dataMapperService = new Gressus\Tools\DataMapperService(
    array(
        'id' => 'Identifier',
        'name' => 'Name',
        'first char' => 'FirstChar',
        'Group + Name' => new Gressus\Tools\Mapper\Concat(array('group',new Gressus\Tools\Mapper\FirstNotEmpty(array('full_name','name')))),
        'id+count' => new Gressus\Tools\Mapper\Sum(array('Identifier','Counter')),
        'first char of hash' => new Gressus\Tools\Mapper\FirstChar('Hash'),
        'source' => new Gressus\Tools\Mapper\StaticValue('CSV Import'),
        'date' => new Gressus\Tools\Mapper\StaticValue('1.1.2016'),
    ),
    array(
          new Gressus\Tools\Converter\ToMysqlDate('date'),
          new Gressus\Tools\Converter\ToFloat('id+count'),
    ),
    array(
        array('Identifier',new \Gressus\Tools\Filter\GreaterThanFilter(3)),
    ),
    array(
        array('first char of hash',new \Gressus\Tools\Filter\LowerThanFilter('d')),
    )
);


$mappedData = $dataMapperService->map($csvData);

print_r($mappedData);



$reducer = new Gressus\Tools\ReducerService(
    'first char of hash',
    array(
        'id+count' => new Gressus\Tools\Reducer\ConcatReducer(),
        'id+count-sum' => new Gressus\Tools\Reducer\SumReducer(null,'id+count'),
        'name' => new Gressus\Tools\Reducer\ConcatReducer(array('distinct' => true)),
    ),
    array(
        array('id+count',new \Gressus\Tools\Filter\GreaterThanFilter(5)),
    )
);

$reducedData = $reducer->reduce($mappedData);

print_r($reducedData);

$csvService = new \Gressus\Tools\CsvService();

$csvService->setAssociatedArrayData($reducedData)
    ->setFileName('../Data/example-data-mapped-and-reduced.csv')
    ->write();
