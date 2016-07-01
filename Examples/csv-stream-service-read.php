<?php
namespace Gressus\Tools;
require('../autoload.php');


$csvService = new CsvStreamReaderService();

$csvService->init('../Data/example-data.csv');
while(($row = $csvService->getRow()) !== FALSE){
    if(!$csvService->isEmpty($row)){
        print_r($row);
    }
}
