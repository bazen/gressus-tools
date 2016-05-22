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
class CsvService {
    /**
     * @var string
     */
    protected $toEncoding = 'utf-8';
    /**
     * String
     * @var string|false
     */
    protected $forceUtf8EncodeFrom = false;

    /**
	 * Filename (complete path)
	 * @var string
	 */
	protected $fileName;
	/**
	 * CSV-Data
	 * @var array
	 */
	protected $data = array();
	/**
	 * Associated Array
	 * @var array
	 */
	protected $associatedArrayData;
	/**
	 * Do Replace LineBreaks?
	 * @var bool
	 */
	protected $replaceLineBreaks = false;
	/**
	 * Header Column
	 * @var array
	 */
	protected $headerColumn;

	/**
	 * reset
	 * @return CsvService
	 */
	public function reset() {
        $this->headerColumn = null;
		$this->fileName = null;
		$this->data = array();
		$this->associatedArrayData = null;
		return $this;
	}

    /**
     * @return string
     */
    public function getToEncoding() {
        return $this->toEncoding;
    }

    /**
     * @param string $toEncoding
     */
    public function setToEncoding($toEncoding) {
        $this->toEncoding = $toEncoding;
    }

    /**
     * @return boolean|string
     */
    public function getForceUtf8EncodeFrom() {
        return $this->forceUtf8EncodeFrom;
    }

    /**
     * @param $forceUtf8EncodeFrom
     * @return $this
     */
    public function setForceUtf8EncodeFrom($forceUtf8EncodeFrom) {
        $this->forceUtf8EncodeFrom = $forceUtf8EncodeFrom;
        return $this;
    }
	/**
	 * Set Filename
	 * @param string $fileName
	 * @return CsvService
	 */
	public function setFileName($fileName) {
		$this->fileName = $fileName;
		return $this;
	}

	/**
	 * Get Filename
	 * @return string
	 */
	public function getFileName() {
		return $this->fileName;
	}

	/**
	 * Count rows
	 * @param null $fileName
	 * @return int
	 * @throws \Exception
	 */
    public function countRows($fileName = null){
        if (null !== $fileName) {
            $this->setFileName($fileName);
        }
        if (!$this->fileName) {
            throw new \Exception('No filename is set');
        }
        if (!file_exists($this->fileName)) {
            throw new \Exception(sprintf('File %s does not exist', $this->fileName));
        }
        $lines = file($this->fileName);
        return count($lines);
    }

	/**
	 * Read CSV
	 * @param string $fileName
	 * @param array $csvOptions
	 * @return CsvService
	 * @throws \Exception
	 */
	public function read($fileName = null, $csvOptions = null) {
        ini_set("auto_detect_line_endings", "1");
		if (null !== $fileName) {
			$this->setFileName($fileName);
		}
		if (!$this->fileName){
            throw new \Exception('No filename is set');
        }
		if (!file_exists($this->fileName)){
            throw new \Exception(sprintf('File %s does not exist', $this->fileName));
        }

		if (null === $csvOptions) {
			$csvOptions = $this->analyzeCsv();
		}
		if (!isset($csvOptions['delimiter']) || !isset($csvOptions['enclosure'])) {
            throw new \Exception('CSV-Options not correctly set. ' . print_r($csvOptions, true));
        }

		$handle = fopen($this->fileName, "r");
		if ($handle === FALSE) {
			throw new \Exception('No Handle');
		}


		$this->data = array();
		while (($columnData = fgetcsv($handle, 0, $csvOptions['delimiter'], $csvOptions['enclosure'])) !== FALSE) {

            if (count(array_filter($columnData)) !== 0) {
                $this->data[] = $columnData;
            }

		}
		fclose($handle);
		if (count($this->data) <= 1) {
			return $this;
		}

		if($this->headerColumn === null){
			$headerColumn = $this->data[0];
            // filter empty columns in the end
            $reversedHeader = array_reverse($headerColumn);
            $filteredReversedHeader = array();
            foreach($reversedHeader as $k => $v){
                if(!$v && count($filteredReversedHeader) === 0){
                    continue;
                }
                $filteredReversedHeader[] = $v;
            }
            $headerColumn = array_reverse($filteredReversedHeader);

            $this->headerColumn = $headerColumn;

            $existing = array();
            foreach($headerColumn as $index => $name){
                $originalName = $name;
                $i = 0;
                while(in_array($name,$existing)){
                    $i++;
                    $name = $originalName.' #'.$i;
                    if($i >100){
                        break;
                    }
                }
                $headerColumn[$index] = $name;
                $existing[] = $name;
            }

			array_shift($this->data);
		} else{
			$headerColumn = $this->headerColumn;
		}
		foreach ($this->data as $index => $data) {
			$associatedData = array();

			foreach ($headerColumn as $headerIndex => $headerTitle) {
				if (isset($data[$headerIndex])) {
					$associatedData[$headerTitle] = $data[$headerIndex];
				}
			}
			$this->associatedArrayData[] = $associatedData;
		}

        $encoding = $this->detectEncoding();
        if (strtolower($encoding) !== $this->toEncoding) {
            $this->convertFromEncoding($encoding);
        }

		return $this;
	}

    /**
     *
     * @return string
     * @throws \Exception
     */
    public function detectEncoding() {

        if($this->forceUtf8EncodeFrom !== false){
            return $this->forceUtf8EncodeFrom;
        }
        if(!is_callable('mb_detect_encoding')){
            throw new \Exception('Could not call required method "mb_detect_encoding".');
        }
        $encoding = mb_detect_encoding (file_get_contents($this->getFileName()));

        return $encoding;
    }

    /**
     * Convert encoding of Csv-data -
     * @param $encoding
     * @return $this
     * @throws \Exception
     */
    public function convertFromEncoding($encoding) {
        if(!is_callable('mb_convert_encoding')){
            throw new \Exception('Could not call required method "mb_convert_encoding".');
        }
        foreach ($this->data as $index => $data) {
            foreach ($data as $key => $value) {
                $value = $this->data[$index][$key];
                $this->data[$index][$key] = mb_convert_encoding($value, $this->toEncoding, $encoding);
            }
        }

        foreach ($this->associatedArrayData as $index => $data) {
            foreach ($data as $key => $value) {
                $value = $this->associatedArrayData[$index][$key];
                $this->associatedArrayData[$index][$key] = mb_convert_encoding($value, $this->toEncoding, $encoding);
            }
        }
        return $this;
    }

	/**
	 * Write CSV
	 * @param bool $append  Append Data to Existing File?
	 * @return CsvService
	 * @throws \Exception
	 */
	public function write($append = false) {

		if (!$this->fileName){
            throw new \Exception('No filename is set');
        }
        if($this->headerColumn === null){
            $headerCols = array();
            foreach ($this->associatedArrayData as $row) {
                foreach ($row as $k => $v) {
                    if (!in_array($k, $headerCols)) {
                        $headerCols[] = $k;
                    }
                }

            }
        }else{
            $headerCols = $this->headerColumn;
        }

		if (!$append || !file_exists($this->fileName)) {
			$this->data[] = $headerCols;
		}

		foreach ($this->associatedArrayData as $row) {

			$insertData = array();
			foreach ($headerCols as $headerCol) {
				$insertData[] = isset($row[$headerCol]) ? $row[$headerCol] : null;
			}
			$this->data[] = $insertData;
		}

		$fp = fopen($this->fileName, $append ? 'a' : 'w');

        if(!$fp){
            throw new \Exception('Could not create file handle '.getcwd().' .. '.$this->fileName);
        }

		foreach ($this->data as $data) {
			if ($this->getReplaceLineBreaks()) {

				foreach ($data as $k => $v) {
					$data[$k] = str_replace(array("\n", "\r"), '', $v);
				}
			}

			fputcsv($fp, $data);
		}

		fclose($fp);
		return $this;
	}


	/**
	 * Set Associated Array data
	 * @param $associatedArrayData
	 * @return CsvService
	 */
	public function setAssociatedArrayData($associatedArrayData) {
		$this->associatedArrayData = $associatedArrayData;
		return $this;
	}

	/**
	 * Get Associated Array Data
	 * @return array
	 */
	public function getAssociatedArrayData() {
		return $this->associatedArrayData;
	}

	/**
	 * Set Data
	 * @param $data
	 * @return CsvService
	 */
	public function setData($data) {
		$this->data = $data;
		return $this;
	}

	/**
	 * Get Data
	 * @return array
	 */
	public function getData() {
		return $this->data;
	}

	/**
	 * Set Replace Line Breaks
	 * @param bool $replaceLineBreaks
	 */
	public function setReplaceLineBreaks($replaceLineBreaks) {
		$this->replaceLineBreaks = $replaceLineBreaks;
	}

	/**
	 * Get Replace Line Breaks
	 * @return bool
	 */
	public function getReplaceLineBreaks() {
		return $this->replaceLineBreaks;
	}

	/**
	 * Set Header Column by hand, if Your CSV has no header Column
	 * @param array $headerColumn
	 * @return $this
	 */
	public function setHeaderColumn($headerColumn) {
		$this->headerColumn = $headerColumn;
		return $this;
	}

	/**
	 * Get Header Column
	 * @return array
	 */
	public function getHeaderColumn() {
		return $this->headerColumn;
	}


    /**
     * Analyze CSV (detecting enclosure and delimiter)
     *
     * only checks for ',", and ",",";"
     *
     * @return array
     */
    protected function analyzeCsv() {
        $options = array(
            'delimiter' => ',',
            'enclosure' => '"'
        );
        $possibleDelimiters = array(
            '"',
            "'"
        );
        $contents = file_get_contents($this->fileName);
        $firstChar = substr($contents, 0, 1);

        if (in_array($firstChar, $possibleDelimiters)) {
            $options['enclosure'] = $firstChar;
        }

        if (substr_count($contents, ';') > substr_count($contents, ',')) {
            $options['delimiter'] = ';';
        }
        return $options;

    }

}