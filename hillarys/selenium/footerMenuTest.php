<?php

require_once 'PHPUnit/Extensions/SeleniumTestCase.php';
include 'baseDef.php';

class FooterMenuTest extends MainTest
{
    
  public function testFooterMenu()
  { 
    $this->openAndWait("/");
    $this->clickAndWait("link=How to Order");
    $this->assertEquals("How to Order",$this->getTitle());
    
    $this->goBackAndWait();
    $this->clickAndWait("link=Delivery Information");
    $this->assertEquals("Delivery Information",$this->getTitle());
    
    $this->goBackAndWait();
    $this->clickAndWait("link=Refunds & Returns");
    $this->assertEquals("Refunds & Returns",$this->getTitle());
    
    $this->goBackAndWait();
    $this->clickAndWait("link=FAQs");
    $this->assertEquals("FAQs",$this->getTitle());
    
    $this->goBackAndWait();
    $this->clickAndWait("link=Contact Us");
    $this->assertEquals("Contact Us",$this->getTitle());
    
    $this->goBackAndWait();
    $this->clickAndWait("link=Company Information");
    $this->assertEquals("Company Information",$this->getTitle());
    
    $this->goBackAndWait();
    $this->clickAndWait("link=Testimonials");
    $this->assertEquals("Testimonials",$this->getTitle());
    
    $this->goBackAndWait();
    $this->clickAndWait("link=Privacy Policy");
    $this->assertEquals("Privacy Policy",$this->getTitle());
    
    $this->goBackAndWait();
    $this->clickAndWait("link=Terms & Conditions");
    $this->assertEquals("Terms & Conditions",$this->getTitle());
    
    $this->goBackAndWait();
    $this->clickAndWait("link=Site Security");
    $this->assertEquals("Site Security",$this->getTitle());
    
    $this->goBackAndWait();
    $this->clickAndWait("link=Site map");
    $this->assertEquals("Site map",$this->getTitle());
    
    $this->goBackAndWait();
    $this->assertTrue($this->isElementPresent("css=a[href='http://twitter.com/webblinds']"));
    $this->assertTrue($this->isElementPresent("css=a[href='http://www.facebook.com/pages/web-blindscom/140881070481']"));
    
    //Offers By Email Test
    $rand = rand(100,30000);
    $email = "superluglor+".$rand."@gmail.com";
    $this->type("email", $email);
    $this->highlight("xpath=//div[@class='form-subscribe']/button");
    $this->clickAndWait("xpath=//div[@class='form-subscribe']/button");       
  }
    
}

?>