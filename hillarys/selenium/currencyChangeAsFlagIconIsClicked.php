<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'baseDef.php';

class currencyChangeAsFlagIconIsClicked extends MainTest
{
    


 public function testCurrencyChange()
    {
        $this->deleteAllVisibleCookies();
        $this->openAndWait("/");
        
        $this->assertEquals("http://uat.hillarys.sessiondigital.com/media//product_strip_wood_uk.jpg", $this->getAttribute("xpath=//div[@id='home-product-strip']/ul/li[1]/a/img/@src"));
        $this->assertNotCookie("store");
        $this->clickAndWait("ireland-flag");
        
        $this->assertEquals("http://uat.hillarys.sessiondigital.com/media//product_strip_wood_euro.jpg", $this->getAttribute("xpath=//div[@id='home-product-strip']/ul/li[1]/a/img/@src"));
        
        //$this->deleteCookie("store");
        
        $this->deleteAllVisibleCookies();
        $this->openAndWait("/");
        $this->assertEquals("http://uat.hillarys.sessiondigital.com/media//product_strip_wood_uk.jpg", $this->getAttribute("xpath=//div[@id='home-product-strip']/ul/li[1]/a/img/@src"));
        
        $this->deleteAllVisibleCookies();
        $this->openAndWait("blinds/perfect-fit/venetians");
        $this->assertTextPresent("£");
        $this->assertTextNotPresent("€");
        //$this->assertNotSame("ireland",$this->getCookieByName("store"));
        //$this->assertNotCookie("store");
        
        $this->clickAndWait("ireland-flag");
        $this->assertTextPresent("€");
        $this->assertTextNotPresent("£");
        //$this->assertEquals("ireland",$this->getCookieByName("store"));
        
        
    }
}
?>
