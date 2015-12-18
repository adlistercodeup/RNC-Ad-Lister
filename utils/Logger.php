<?php

// date.timezone = "US/Central";

date_default_timezone_set("US/Central");

class Log {
	
	protected $fileName;

	protected $handle;

	// public function __construct($prefix = 'log') {

	// 	$today = date('o-m-d');

	// 	$fileName = "{$prefix}-{$today}.log";

	// 	$this->setFileName($fileName);

	// 	$this->handle = fopen($this->fileName, 'a');

	// }

	// public function setFileName($fileName) {

	// 	if (is_string($fileName)) {

	// 		if (touch($fileName) && is_writable($fileName)) {

	// 			$this->$fileName = $fileName;
				
	// 		}
			
	// 	}

	// }

	public function __construct()
	{
		$this->setFilename();
		$this->setHandle();
	}

	protected function setFilename($prefix = 'log'){
		$this->fileName= "../utils/data/" . $prefix . date('Y-m-d'). ".log";
	}

	public function setHandle() {

		$this->handle = fopen($this->fileName, 'a');
	}

	public function getFileName() {

		return $this->fileName;
	}

	public function getHandle() {

		$this->handle = fopen(getFileName($prefix = 'log'), 'a');

		return $this->handle;
	}



	public function logMessage($logLevel, $message) {

		$today = date('o-m-d');

		$time = date('G-i-s');

	    $data = "{$today} {$time} [{$logLevel}] {$message}";

		fwrite($this->handle, $data . PHP_EOL);

	}

	public function info($message) {

		$this->logMessage("INFO", $message);

	}

	public function error($message) {

		$this->logMessage("ERROR", $message);
	}




	public function __destruct() {

	    fclose($this->handle);
		
	}

}
?> 