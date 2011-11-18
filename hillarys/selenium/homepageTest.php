<?php

require_once 'PHPUnit/Extensions/SeleniumTestCase.php';
include 'baseDef.php';

class HomepageTest extends MainTest
{
    
//    public function testCurrencyChange()
//    {
//        $this->deleteAllVisibleCookies();
//        $this->openAndWait("/");
//        
//        $this->assertEquals("http://uat.hillarys.sessiondigital.com/media//product_strip_wood_uk.jpg", $this->getAttribute("xpath=//div[@id='home-product-strip']/ul/li[1]/a/img/@src"));
//        
//        $this->clickAndWait("ireland-flag");
//        
//        $this->assertEquals("http://uat.hillarys.sessiondigital.com/media//product_strip_wood_euro.jpg", $this->getAttribute("xpath=//div[@id='home-product-strip']/ul/li[1]/a/img/@src"));
//        
//        $this->deleteCookie("store");
//        $this->deleteAllVisibleCookies();
//        $this->openAndWait("/");
//        
//        $this->assertEquals("http://uat.hillarys.sessiondigital.com/media//product_strip_wood_uk.jpg", $this->getAttribute("xpath=//div[@id='home-product-strip']/ul/li[1]/a/img/@src"));
//        
//    }
    
    public function testQuickShopFilterTest()
    {
        $this->select("category_id","Vertical");
        $this->select("color-1","Blue");
        $this->clickAndWait("xpath=//form[@id='quick-search-1']/fieldset/button");
        
        $this->assertEquals("Made to Measure Blinds - Window Blinds - Web Blinds", $this->getTitle());
        $this->assertTrue($this->isChecked("category_4"));
        $this->assertTrue($this->isChecked("colour_28"));
        
        $this->goBackAndWait("/");
        
        $this->select("color-2","Blue");
        $this->clickAndWait("xpath=//form[@id='quick-search-2']/fieldset/button");
        
        $this->assertEquals("Curtains, Curtain Fabric, Ready made Curtains", $this->getTitle());
        $this->assertTrue($this->isChecked("colour_28"));
               
    }
    
    public function testQuickLogin()
    {
        $this->openAndWait("/");
        $this->quickShopFilterTest();
        $this->logIn("bsilwal@ibuildings.com", "password");
        $this->clickAndWait("link=My Account");
        $this->clickAndWait("link=My Saved Measurements");
        $this->testQuickShopFilterTest();
        $this->logOut();   
    }
 
}
?>
