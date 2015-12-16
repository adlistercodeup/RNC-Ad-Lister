<?php

// date.timezone = "US/Central";

date_default_timezone_set("US/Central");

class Log {
	
	protected $fileName;

	protected $handle;

	public function __construct($prefix = 'log') {

		$today = date('o-m-d');

		$filename = "{$prefix}-{$today}.log";

		$this->setFileName($filename);

		$this->handle = fopen($this->fileName, 'a');

	}

	public function setFileName($fileName) {

		if (is_string($filename)) {

			if (touch($fileName) && is_writable($fileName)) {

				$this->$fileName = $filename;
				
			}
			
		}

	}

	public function getFileName() {

		return $this->fileName;
	}

	public function setHandle($handle) {

		$this->$handle = trim(fopen(getFileName($prefix = 'log'), 'a'));
	}


	public function getHandle() {

		$this->handle = fopen(getFileName($prefix = 'log'), 'a');

		return $this->handle;
	}



	public function logMessage($logLevel, $message) {

		$today = date('o-m-d');

		$time = date('G-i-s');

	    $data = "{$today} {$time} [{$logLevel}] {$message}";

		fwrite($this->handle, $data . PHP_EOL );

	}

	public function info($message) {

		$this->logMessage("INFO", $message);

	}

	public function error($message) {

		$this->logMessage("ERROR", $message);
	}



}
	public function __destruct() {

	    fclose($this->handle);
		
	}
?> 