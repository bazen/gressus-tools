<?php

require('../autoload.php');


$csvService = new \Gressus\Tools\CsvService();

$csvService->read('../Data/example-data.csv');

print_r($csvService->getAssociatedArrayData());
