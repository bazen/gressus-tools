<?php
namespace Gressus\Tools;
require('../autoload.php');


$csvService = new CsvService();

$csvService->read('../Data/example-data.csv');

print_r($csvService->getAssociatedArrayData());
