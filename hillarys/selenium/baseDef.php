<?php

require_once 'PHPUnit/Extensions/SeleniumTestCase.php'; 
date_default_timezone_set('Europe/London'); 


class MainTest extends PHPUnit_Extensions_SeleniumTestCase 
{

 
 protected $captureScreenshotOnFailure = TRUE;
 protected $screenshotPath = '/Users/bsilwal/Pictures/selenium_screenshot';
 protected $screenshotUrl = 'http://localhost/screenshots';
      /*
   public static $browsers = array(
      array(
        'name'    => 'Firefox on Linux',
        'browser' => '*firefox',
        'host'    => 'my.linux.box',
        'port'    => 4444,
        'timeout' => 30000,
      ),
      array(
        'name'    => 'Safari on MacOS X',
        'browser' => '*safari',
        'host'    => 'my.macosx.box',
        'port'    => 4444,
        'timeout' => 30000,
      ),
      array(
        'name'    => 'Safari on Windows XP',
        'browser' => '*custom C:\Program Files\Safari\Safari.exe -url',
        'host'    => 'my.windowsxp.box',
        'port'    => 4444,
        'timeout' => 30000,
      ),
      array(
        'name'    => 'Internet Explorer on Windows XP',
        'browser' => '*iexplore',
        'host'    => 'my.windowsxp.box',
        'port'    => 4444,
        'timeout' => 30000,
      )
    );*/

    public function setUp() 
    {
        $this->setBrowser("*firefox");
        $this->setBrowserUrl("http://uat.hillarys.sessiondigital.com/");
        $this->setSpeed(5);
       
    }
    
    //some selenium custom methods here
    
    protected function clickAndWait($locator)
    {
        $this->click($locator);
        $this->waitForPageToLoad("30000");
    }
    
    protected function openAndWait($url)
    {
        $this->open($url);
        $this->waitForPageToLoad("30000");
    }
    
    protected function goBackAndWait()
    {
        $this->goBack();
        $this->waitForPageToLoad("30000");
    }
    
    //some magento common methods here
    
    public function logOut()
    {
        $this->open("/");
        $this->waitForPageToLoad("30000");
        if($this->isElementPresent("link=Log Out"))
        {
            $this->clickAndWait("link=Log Out");
            $this->deleteAllVisibleCookies();
            $this->openAndWait("/");
        }   
    }
    
    public function logIn($email, $password)
    {
        $this->openAndWait("/");
        if($this->isElementPresent("link=Log Out")){
            $this->logOut();
        }
        $this->clickAndWait("link=Log In/Register");
        $this->type("email",$email);
        $this->type("pass",$password);
        $this->clickAndWait("send2");
        $this->assertTrue($this->isElementPresent("link=Log Out"));
    }
    

}

?>

