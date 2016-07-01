<?php
namespace Gressus\Tools;
/***************************************************************
 *  Copyright notice
 *
 *  (c) 2016
 *  All rights reserved
 *
 *  GRESSUS
 *
 * @category Gressus
 * @package Gressus_Tools
 ***************************************************************/


/**
 * Csv Service
 *
 * @category Gressus
 * @package Gressus_Tools
 * @author Felix Krüger <f3l1x@gressus.de>
 */
class CsvStreamReaderService {

	protected $fileHandle;
	protected $csvOptions = array(
		'delimiter' => ',',
		'enclosure' => '"',
	);

	protected $headerColumn = array();

	public function init($fileName,$csvOptions = null,$headerColumn = null){
		if(!file_exists($fileName)){
			throw new \Exception('File '.$fileName.' does not exist');
		}
		if(null !== $csvOptions){
			$this->csvOptions = $csvOptions;
		}

		$this->fileHandle = fopen($fileName, "r");
		if ($this->fileHandle === FALSE) {
			throw new \Exception('No Handle');
		}
		if(is_array($headerColumn)){
			$this->headerColumn = $headerColumn;

		}else{
			$this->headerColumn =  fgetcsv($this->fileHandle, 0, $this->csvOptions['delimiter'], $this->csvOptions['enclosure']);
		}
	}

	/**
	 * Get Row
	 * @return array
	 */
	public function getRow(){
		$columnData = fgetcsv($this->fileHandle, 0, $this->csvOptions['delimiter'], $this->csvOptions['enclosure']);
		if($columnData === false){
			fclose($this->fileHandle);
			return false;
		}
		$associatedData = array();
		foreach ($this->headerColumn  as $headerIndex => $headerTitle) {
			if (isset($columnData[$headerIndex])) {
				$associatedData[$headerTitle] = $columnData[$headerIndex];
			}
		}

		return $associatedData;
	}

	/**
	 * Is an empty Row
	 * @param $row
	 * @return bool
	 */
	public function isEmpty($row){
		return count(array_filter($row)) === 0;
	}

}