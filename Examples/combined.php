<?php
namespace Gressus\Tools;

require('../autoload.php');


$csvService = new CsvService();

$csvService->read('../Data/example-data.csv');

$csvData = $csvService->getAssociatedArrayData();

print_r($csvData);

$dataMapperService = new DataMapperService(
    array(
        'id' => 'Identifier',
        'name' => 'Name',
        'first char' => 'FirstChar',
        'Group + Name' => new Mapper\Concat(array(
            'group',
            new Mapper\FirstNotEmpty(array('full_name','name'))
        )),
        'id+count' => new Mapper\Sum(array('Identifier','Counter')),
        'first char of hash' => new Mapper\FirstChar('Hash'),
        'source' => new Mapper\StaticValue('CSV Import'),
        'date' => new Mapper\StaticValue('1.1.2016'),
    ),
    array(
          new Converter\ToMysqlDate('date'),
          new Converter\ToFloat('id+count'),
    ),
    array(
        array('Identifier',new Filter\GreaterThanFilter(3)),
    ),
    array(
        array('first char of hash',new Filter\LowerThanFilter('d')),
    )
);


$mappedData = $dataMapperService->map($csvData);

print_r($mappedData);



$reducer = new ReducerService(
    'first char of hash',
    array(
        'id+count' => new Reducer\ConcatReducer(),
        'id+count-sum' => new Reducer\SumReducer(null,'id+count'),
        'name' => new Reducer\ConcatReducer(array('distinct' => true)),
    ),
    array(
        array('id+count',new Filter\GreaterThanFilter(5)),
    )
);

$reducedData = $reducer->reduce($mappedData);

print_r($reducedData);

$csvService = new CsvService();

$csvService->setAssociatedArrayData($reducedData)
    ->setFileName('../Data/example-data-mapped-and-reduced.csv')
    ->write();
