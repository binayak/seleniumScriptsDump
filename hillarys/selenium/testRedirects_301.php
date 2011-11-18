<?php

include 'baseDef.php';

class testRedirects extends MainTest
{

	function testGetURLsFromFileAndRunCurlCommandThenAssertIfAllOfThemIsGiving301()
	{
		$this->readUrlsFromFile();
		//$this->curlThisUrl("http://qa.hillarys.sessiondigital.com/blinds/made-to-measure/640");
	}
	
	function curlAndAssertUrlHttpResponse($urlOnTest)
	{
	
		$cmd  = "/usr/bin/curl -I ". trim($urlOnTest);
		var_dump($cmd);
		$var = shell_exec("/usr/bin/curl -I ". trim($urlOnTest));
	
		$thisIsHttpRedirects = explode(" ",$var);
	
		try
		{
			$this->assertEquals("301",$thisIsHttpRedirects[1]);
			echo "The URL on Test is: ".$urlOnTest." and it returned ".$thisIsHttpRedirects[1]."\n";
		} 
		catch (PHPUnit_Framework_AssertionFailedError $e) 
		{
    	   array_push($this->verificationErrors, $e->toString());
    	   echo "The URL on Test is: ".$urlOnTest." and it returned ".$thisIsHttpRedirects[1]."\n";
	  	}

	}
	
	
	function readUrlsFromFile()
	{
		$lines = array();
	
		$fileWith404Urls = "404_Errors.txt";
		$fh = fopen($fileWith404Urls, 'r');
		$totalLinesInFile = count(file($fileWith404Urls));
		
		while(!feof($fh))
		{
			$this->curlAndAssertUrlHttpResponse(fgets($fh));
		}		
	}
}

?>

