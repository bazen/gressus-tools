<?php
namespace Gressus\Tools;
require('../autoload.php');


$csvService = new CsvStreamReaderService();

$csvService->init('../Data/example-data.csv');
while($csvService->getRow()){
    print_r($csvService->getRow());
}
 
