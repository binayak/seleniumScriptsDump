<?php

//require_once 'PHPUnit/Extensions/SeleniumTestCase.php';
include 'baseDef.php';


class MenuNavTest extends MainTest
{
    
  public function testMenuNav()
  { 
    //main menu top buttons test   
    
    $this->openAndWait("/");
    $this->clickAndWait("link=Blinds"); 
    
    $this->assertEquals("Blackout Blinds and Window Blinds Directly from Web-Blinds",$this->getTitle());
    $this->assertElementNotPresent("//p[@id='footer-right']/a");
    
    $this->clickAndWait("link=Curtains"); 
    $this->assertEquals("Curtains, Curtain Fabric, Ready made Curtains",$this->getTitle());
    $this->assertElementNotPresent("//p[@id='footer-right']/a");
    
    $this->clickAndWait("link=Cushions");
    $this->assertEquals("Shop Cushions",$this->getTitle());
    $this->assertElementNotPresent("//p[@id='footer-right']/a");
    
    $this->clickAndWait("link=Free samples"); 
    $this->assertEquals("Free samples",$this->getTitle());
    $this->assertElementNotPresent("//p[@id='footer-right']/a");
    
    $this->clickAndWait("link=Fabric by the metre"); 
    $this->assertEquals("Fabric by the metre",$this->getTitle());
    $this->assertElementNotPresent("//p[@id='footer-right']/a");
    
    $this->clickAndWait("link=Parts and accessories");
    $this->assertEquals("Parts & Accessories",$this->getTitle());
    $this->assertElementNotPresent("//p[@id='footer-right']/a");
    
    $this->clickAndWait("link=Awnings");
	try
	{ 
 	   $this->assertEquals("Patio and Garden Awnings for Sale – Web-Blinds",$this->getTitle());
 	   $this->assertElementNotPresent("//p[@id='footer-right']/a");
  	}
	catch(PHPUnit_Framework_AssertionFailedError $e)
	{
		array_push($this->verificationErrors, $e->toString());
		echo"\n Title is not matched\n";
	}
     
    $this->clickAndWait("link=Inspiration & Advice"); 
    $this->assertEquals("Inspiration",$this->getTitle());
    $this->assertElementNotPresent("//p[@id='footer-right']/a");
    
    $this->clickAndWait("link=How To Measure & Fit"); 
    $this->assertEquals("How To Measure & Fit",$this->getTitle());
    $this->assertElementNotPresent("//p[@id='footer-right']/a");
    
    $this->clickAndWait("link=Offers"); 
    $this->assertEquals("Offers",$this->getTitle());
    $this->assertElementNotPresent("//p[@id='footer-right']/a");
    
    //blinds submenu test
    
    $this->openAndWait("/");
    //$js_code = "this.browserbot.getCurrentWindow().document.getElementById('nav').childNodes[1].childNodes[3].getAttribute('class').match(/shown-sub$/)";
    $this->mouseOver("xpath=//div[@class='nav-container']/ul/li[1]");
    //$this->waitForCondition("var pattern = /shown-sub$/; pattern.test(window.document.getElementById('nav').childNodes[1].childNodes[3].getAttribute('class'))", "10000");
    $this->waitForElementPresent("class=top-menu-row shown-sub");
    $this->clickAndWait("xpath=//ul[@id='sub-level-6']/li[1]/a"); 
    $this->assertEquals("Vertical Blinds - Made-to-measure Vertical blinds - Web Blinds",$this->getTitle());
    $this->assertElementNotPresent("//p[@id='footer-right']/a");
    
    $this->goBackAndWait();
    $this->mouseOver("xpath=//div[@class='nav-container']/ul/li[1]");
    $this->waitForElementPresent("class=top-menu-row shown-sub");
    $this->clickAndWait("xpath=//ul[@id='sub-level-6']/li[2]/a");
    $this->assertEquals("Venetian Blinds - Made-to-measure Venetian blinds - Web Blinds",$this->getTitle());
    $this->assertElementNotPresent("//p[@id='footer-right']/a");
    
    $this->goBackAndWait();
    $this->mouseOver("xpath=//div[@class='nav-container']/ul/li[1]");
    $this->waitForElementPresent("class=top-menu-row shown-sub");
    $this->clickAndWait("xpath=//ul[@id='sub-level-6']/li[3]/a");
    $this->assertEquals("Wooden Venetian blinds - Made-to-measure Wooden Venetian blinds - Web Blinds",$this->getTitle());
    $this->assertElementNotPresent("//p[@id='footer-right']/a");
    
    $this->goBackAndWait();
    $this->mouseOver("xpath=//div[@class='nav-container']/ul/li[1]");
    $this->waitForElementPresent("class=top-menu-row shown-sub");
    $this->clickAndWait("xpath=//ul[@id='sub-level-6']/li[4]/a");
    $this->assertEquals("Roller Blinds - Made-to-measure Roller blinds - Web Blinds",$this->getTitle());
    $this->assertElementNotPresent("//p[@id='footer-right']/a");
    
    $this->goBackAndWait();
    $this->mouseOver("xpath=//div[@class='nav-container']/ul/li[1]");
    $this->waitForElementPresent("class=top-menu-row shown-sub");
    $this->clickAndWait("xpath=//ul[@id='sub-level-6']/li[5]/a");
    $this->assertEquals("Roman Blinds - Made-to-measure Roman blinds - Web Blinds",$this->getTitle());
    $this->assertElementNotPresent("//p[@id='footer-right']/a");
    
    $this->goBackAndWait();
    $this->mouseOver("xpath=//div[@class='nav-container']/ul/li[1]");
    $this->waitForElementPresent("class=top-menu-row shown-sub");
    $this->clickAndWait("xpath=//ul[@id='sub-level-6']/li[6]/a");
    $this->assertEquals("Woodweave Blinds - Made-to-measure Woodweave blinds - Web Blinds",$this->getTitle());
    $this->assertElementNotPresent("//p[@id='footer-right']/a");
    
    $this->goBackAndWait();
    $this->mouseOver("xpath=//div[@class='nav-container']/ul/li[1]");
    $this->waitForElementPresent("class=top-menu-row shown-sub");
    $this->clickAndWait("xpath=//ul[@id='sub-level-6']/li[7]/a");
    $this->assertEquals("Panel Blinds - Made-to-measure Panel blinds - Web Blinds",$this->getTitle());
    $this->assertElementNotPresent("//p[@id='footer-right']/a");
    
    $this->goBackAndWait();
    $this->mouseOver("xpath=//div[@class='nav-container']/ul/li[1]");
    $this->waitForElementPresent("class=top-menu-row shown-sub");
    $this->clickAndWait("xpath=//ul[@id='sub-level-6']/li[8]/a");
    $this->assertEquals("Pleated Blinds - Made-to-measure Pleated blinds - Web Blinds",$this->getTitle());
    $this->assertElementNotPresent("//p[@id='footer-right']/a");
    
    $this->goBackAndWait();
    $this->mouseOver("xpath=//div[@class='nav-container']/ul/li[1]");
    $this->waitForElementPresent("class=top-menu-row shown-sub");
    $this->clickAndWait("xpath=//ul[@id='sub-level-15']/li[1]/a");
    $this->assertEquals("Skylight Roller Blinds - Web Blinds",$this->getTitle());
    $this->assertElementNotPresent("//p[@id='footer-right']/a");
    
    $this->goBackAndWait();
    $this->mouseOver("xpath=//div[@class='nav-container']/ul/li[1]");
    $this->waitForElementPresent("class=top-menu-row shown-sub");
    $this->clickAndWait("xpath=//ul[@id='sub-level-17']/li[1]/a");
    $this->assertEquals("Perfect fit Venetian blinds - Shop Blinds - Blinds",$this->getTitle());
    $this->assertElementNotPresent("//p[@id='footer-right']/a");
    
    $this->goBackAndWait();
    $this->mouseOver("xpath=//div[@class='nav-container']/ul/li[1]");
    $this->waitForElementPresent("class=top-menu-row shown-sub");
    $this->clickAndWait("xpath=//ul[@id='sub-level-21']/li[1]/a");
    $this->assertEquals("Ready made Venetian blinds - Shop Blinds - Blinds",$this->getTitle());
    $this->assertElementNotPresent("//p[@id='footer-right']/a");
    
    $this->goBackAndWait();
    $this->mouseOver("xpath=//div[@class='nav-container']/ul/li[1]");
    $this->waitForElementPresent("class=top-menu-row shown-sub");
    $this->clickAndWait("xpath=//ul[@id='sub-level-21']/li[2]/a");
    $this->assertEquals("Ready made Roller blinds - Shop Blinds - Blinds",$this->getTitle());
    $this->assertElementNotPresent("//p[@id='footer-right']/a");
    
    $this->goBackAndWait();
    $this->mouseOver("xpath=//div[@class='nav-container']/ul/li[1]");
    $this->waitForElementPresent("class=top-menu-row shown-sub");
    $this->clickAndWait("link=Design your own blind");
    $this->assertEquals("Print your own Digital blind - Blinds",$this->getTitle());
    $this->assertElementNotPresent("//p[@id='footer-right']/a");
    
    $this->goBackAndWait();
    $this->mouseOver("xpath=//div[@class='nav-container']/ul/li[1]");
    $this->waitForElementPresent("class=top-menu-row shown-sub");
    $this->clickAndWait("xpath=//ul[@id='sub-level-37']/li[1]/a");
    $this->assertEquals("Print your own Digital blind - Blinds",$this->getTitle());
    $this->assertElementNotPresent("//p[@id='footer-right']/a");
    
    $this->goBackAndWait();
    $this->mouseOver("xpath=//div[@class='nav-container']/ul/li[1]");
    $this->waitForElementPresent("class=top-menu-row shown-sub");
    $this->clickAndWait("xpath=//ul[@id='sub-level-37']/li[2]/a");
    $this->assertEquals("Print your own Digital blind - Blinds",$this->getTitle());
    $this->assertElementNotPresent("//p[@id='footer-right']/a");
    
    $this->goBackAndWait();
    $this->mouseOver("xpath=//div[@class='nav-container']/ul/li[1]");
    $this->waitForElementPresent("class=top-menu-row shown-sub");
    $this->clickAndWait("link=Blind types explained");
    $this->assertEquals("Blind types explained - Blinds",$this->getTitle());
    $this->assertElementNotPresent("//p[@id='footer-right']/a");
    
    $this->goBackAndWait();
    $this->mouseOver("xpath=//div[@class='nav-container']/ul/li[1]");
    $this->waitForElementPresent("class=top-menu-row shown-sub");
    $this->clickAndWait("link=Replacement louvres");
    $this->assertEquals("Parts & Accessories",$this->getTitle());
    $this->assertElementNotPresent("//p[@id='footer-right']/a");
    
    $this->goBackAndWait();
    $this->mouseOver("xpath=//div[@class='nav-container']/ul/li[1]");
    $this->waitForElementPresent("class=top-menu-row shown-sub");
    $this->clickAndWait("link=Temporary Blinds");
    $this->assertEquals("temporary blinds - Blinds",$this->getTitle());
    $this->assertElementNotPresent("//p[@id='footer-right']/a");
    
    //curtains submenu test
    
    $this->goBackAndWait();
    $this->mouseOver("xpath=//div[@class='nav-container']/ul/li[2]");
    $this->waitForElementPresent("class=top-menu-row shown-sub");
    $this->clickAndWait("link=Ready-made curtains");
    $this->assertEquals("Curtains (Ready Made) - Curtains",$this->getTitle());
    $this->assertElementNotPresent("//p[@id='footer-right']/a");
    
    $this->goBackAndWait();
    $this->mouseOver("xpath=//div[@class='nav-container']/ul/li[2]");
    $this->waitForElementPresent("class=top-menu-row shown-sub");
    $this->clickAndWait("link=Made-to-measure");
    $this->assertEquals("Curtains - Curtains",$this->getTitle());
    $this->assertElementNotPresent("//p[@id='footer-right']/a");
    
    //free samples submenu test
    
    $this->goBackAndWait();
    $this->mouseOver("xpath=//div[@class='nav-container']/ul/li[4]");
    $this->waitForElementPresent("class=top-menu-row shown-sub");
    $this->clickAndWait("link=Vertical");
    $this->assertContains("Vertical",$this->getText("xpath=//h1[@class='sub-category-header']"));
    $this->assertElementNotPresent("//p[@id='footer-right']/a");
    
    $this->goBackAndWait();
    $this->mouseOver("xpath=//div[@class='nav-container']/ul/li[4]");
    $this->waitForElementPresent("class=top-menu-row shown-sub");
    $this->clickAndWait("link=Venetian & Venetian Perfect Fit");
    $this->assertContains("Venetian & Venetian Perfect Fit",$this->getText("xpath=//h1[@class='sub-category-header']"));
    $this->assertElementNotPresent("//p[@id='footer-right']/a");
    
    $this->goBackAndWait();
    $this->mouseOver("xpath=//div[@class='nav-container']/ul/li[4]");
    $this->waitForElementPresent("class=top-menu-row shown-sub");
    $this->clickAndWait("link=Wood Venetian");
    $this->assertContains("Wood Venetian",$this->getText("xpath=//h1[@class='sub-category-header']"));
    $this->assertElementNotPresent("//p[@id='footer-right']/a");
    
    $this->goBackAndWait();
    $this->mouseOver("xpath=//div[@class='nav-container']/ul/li[4]");
    $this->waitForElementPresent("class=top-menu-row shown-sub");
    $this->clickAndWait("link=Roller & Panel");
    $this->assertContains("Roller & Panel",$this->getText("xpath=//h1[@class='sub-category-header']"));
    $this->assertElementNotPresent("//p[@id='footer-right']/a");
    
    $this->goBackAndWait();
    $this->mouseOver("xpath=//div[@class='nav-container']/ul/li[4]");
    $this->waitForElementPresent("class=top-menu-row shown-sub");
    $this->clickAndWait("link=Roman");
    $this->assertContains("Roman",$this->getText("xpath=//h1[@class='sub-category-header']"));
    $this->assertElementNotPresent("//p[@id='footer-right']/a");
    
    $this->goBackAndWait();
    $this->mouseOver("xpath=//div[@class='nav-container']/ul/li[4]");
    $this->waitForElementPresent("class=top-menu-row shown-sub");
    $this->clickAndWait("link=Woodweave");
    $this->assertContains("Woodweave",$this->getText("xpath=//h1[@class='sub-category-header']"));
    $this->assertElementNotPresent("//p[@id='footer-right']/a");
    
    $this->goBackAndWait();
    $this->mouseOver("xpath=//div[@class='nav-container']/ul/li[4]");
    $this->waitForElementPresent("class=top-menu-row shown-sub");
    $this->clickAndWait("link=Pleated");
    $this->assertContains("Pleated",$this->getText("xpath=//h1[@class='sub-category-header']"));
    $this->assertElementNotPresent("//p[@id='footer-right']/a");
    
    $this->goBackAndWait();
    $this->mouseOver("xpath=//div[@class='nav-container']/ul/li[4]");
    $this->waitForElementPresent("class=top-menu-row shown-sub");
    $this->clickAndWait("link=Curtain and cushion fabric");
    $this->assertContains("Curtain and cushion fabric",$this->getText("xpath=//h1[@class='sub-category-header']"));
    $this->assertElementNotPresent("//p[@id='footer-right']/a");
    
    //inspiration submenu test
    
    $this->goBackAndWait();
    $this->mouseOver("xpath=//div[@class='nav-container']/ul/li[8]");
    $this->waitForElementPresent("class=top-menu-row shown-sub");
    $this->clickAndWait("link=Inspiration");
    $this->assertEquals("Inspiration",$this->getTitle());
    $this->assertElementNotPresent("//p[@id='footer-right']/a");
    
    $this->goBackAndWait();
    $this->mouseOver("xpath=//div[@class='nav-container']/ul/li[8]");
    $this->waitForElementPresent("class=top-menu-row shown-sub");
    $this->clickAndWait("xpath=//ul[@id='nav']/li[8]/div/div/div/ul/li/ul/li[1]/a/span");
    $this->assertEquals("Inspirational Looks",$this->getTitle());
    $this->assertElementNotPresent("//p[@id='footer-right']/a");
    
    $this->goBackAndWait();
    $this->mouseOver("xpath=//div[@class='nav-container']/ul/li[8]");
    $this->waitForElementPresent("class=top-menu-row shown-sub");
    $this->clickAndWait("xpath=//ul[@id='nav']/li[8]/div/div/div/ul/li/ul/li[2]/a/span");
    $this->assertEquals("Latest Trends",$this->getTitle());
    $this->assertElementNotPresent("//p[@id='footer-right']/a");
    
//    $this->goBackAndWait();
//    $this->mouseOver("xpath=//div[@class='nav-container']/ul/li[8]");
//    $this->waitForElementPresent("class=top-menu-row shown-sub");
//    $this->clickAndWait("xpath=(//ul[@class='child-cats']/li/a/span[text()='Inspirational Looks'])[1]");
//    $this->assertEquals("Making the most of neutrals",$this->getTitle());
//    $this->assertElementNotPresent("//p[@id='footer-right']/a");
    
    
    $this->goBackAndWait();
    $this->mouseOver("xpath=//div[@class='nav-container']/ul/li[8]");
    $this->waitForElementPresent("class=top-menu-row shown-sub");
    $this->clickAndWait("link=Design Tips");
    $this->assertEquals("Design Tips",$this->getTitle());
    $this->assertElementNotPresent("//p[@id='footer-right']/a");

    //howtomeasure submenu test
    
    $this->goBackAndWait();
    $this->mouseOver("xpath=//div[@class='nav-container']/ul/li[9]");
    $this->waitForElementPresent("class=top-menu-row shown-sub");
    $this->clickAndWait("link=Advice");
    $this->assertEquals("How To Measure & Fit",$this->getTitle());
    $this->assertElementNotPresent("//p[@id='footer-right']/a");
    
    $this->goBackAndWait();
    $this->mouseOver("xpath=//div[@class='nav-container']/ul/li[9]");
    $this->waitForElementPresent("class=top-menu-row shown-sub");
    $this->clickAndWait("link=How to Measure");
    $this->assertEquals("How To Measure",$this->getTitle());
    $this->assertElementNotPresent("//p[@id='footer-right']/a");
    
    $this->goBackAndWait();
    $this->mouseOver("xpath=//div[@class='nav-container']/ul/li[9]");
    $this->waitForElementPresent("class=top-menu-row shown-sub");
    $this->clickAndWait("link=How to Fit");
    $this->assertEquals("How To Fit",$this->getTitle());
        
  }
    
}

?>
