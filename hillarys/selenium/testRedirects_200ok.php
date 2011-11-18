<?php

include 'baseDef.php';

class testRedirects extends MainTest
{
	
	function testGetURLsFromFileAndRunCurlCommandThenAssertIfAllOfThemIsGiving200()
	{
		$this->readUrlsFromFile();
		//$this->curlThisUrl("http://qa.hillarys.sessiondigital.com/blinds/made-to-measure/640");
	}
	
	function curlAndAssertUrlHttpResponse($urlOnTest,$trackItCounter)
	{
		
		$cmd  = "/usr/bin/curl -I ". trim($urlOnTest);
		var_dump($cmd);
		$var = shell_exec("/usr/bin/curl -I ". trim($urlOnTest));
	
		$thisIsHttpRedirects = explode(" ",$var);
	
		try
		{
			/*$this->assertEquals("200",$thisIsHttpRedirects[1]);
			echo $trackItCounter.". The URL on Test is: ".$urlOnTest." and it returned ".$thisIsHttpRedirects[1]."\n";
			$trackItCounter++;*/
		echo $trackItCounter;
		$error_string =  $trackItCounter.". The URL on Test is: ".$urlOnTest." and it returned ".$thisIsHttpRedirects[1]."\n";
		$this->assertEquals("200",$thisIsHttpRedirects[1], $error_string);
		

		} 
		catch (PHPUnit_Framework_AssertionFailedError $e) 
		{
    	   array_push($this->verificationErrors, $e->toString());
	  	}

	}
	
	
	function readUrlsFromFile()
	{
		$track = 0;
		$lines = array();
		$fileWith302Urls = "302_Redirects.txt";
		$fh = fopen($fileWith302Urls, 'r');
		$totalLinesInFile = count(file($fileWith302Urls));
		
		while(!feof($fh))
		{
			$this->curlAndAssertUrlHttpResponse(fgets($fh),$track);
			$track++;
		}		
	}
}

?>

