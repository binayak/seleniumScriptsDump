<?php

include 'baseDef.php';


class SanityURLTests extends MainTest
{

	function testURLSIfTheyAreWorking ()
	{
	
		$this->openAndWait("/");
		
		$this->topLevelBreadCrumAndURL();
		$this->secondLevelMenuItemsURLTest();
		$this->footerLinksURLTest();
	
	}
	
		
	function topLevelBreadCrumAndURL()
	{
		//************************************************************************************
		// Testing the breadcrums text & URL for the top level navigation.
		//************************************************************************************
		$urlExpectedArray = array
							(
							"",
							"blinds",
							"curtains",
							"cushions",
							"samples",
							"fabric-by-the-metre",
							"parts-accessories",
							"awnings",
							"inspiration",
							"how-to-measure-and-fit",
							"offers"
							);
		
		
		for	($i=1;$i<=10;$i++)
		{
		
			if ($i<=5)
			{
				$this->clickAndWait("//div[@class='nav-container']/ul/li[contains(@class,'level0 nav-$i')]/a/span");
				$spanContains = $this->getText("//div[@class='nav-container']/ul/li[contains(@class,'level0 nav-$i')]/a/span");
				
				
				try 
				{
                                    $this->assertContains($spanContains,$this->getText("//div[@class='breadcrumbs']/ul/li[contains(@class,'category')]/strong"));
                                    $urlActual = $this->getLocation();
                                    $urlActual = explode("/",$urlActual);
                                    $this->assertEquals($urlActual[3],$urlExpectedArray[$i]);
			    	
				} 
				catch (PHPUnit_Framework_AssertionFailedError $e) 
				{
					array_push($this->verificationErrors, $e->toString());
					echo "\nCheck if Title and URL of this page should be : ".$this->getTitle()." and ".$this->getLocation()."?\n";
  				}
  				
  				$this->assertEquals("You are here:",$this->getText("//div[@class='breadcrumbs']/ul/li[1]"));
				$this->assertEquals("Home",$this->getText("//div[@class='breadcrumbs']/ul/li[2]/a"));
			
			}
			
			elseif ($i==6)
			{
				$this->clickAndWait("//div[@class='nav-container']/ul/li[contains(@class,'level0 nav-$i')]/a/span");
				
				try 
				{
			    	$this->assertContains("Parts & Accessories",$this->getText("//div[@class='breadcrumbs']/ul/li[contains(@class,'category')]/strong"));
			    	$urlActual = $this->getLocation();
					$urlActual = explode("/",$urlActual);
					$this->assertEquals($urlActual[3],$urlExpectedArray[$i]);
				} 
				catch (PHPUnit_Framework_AssertionFailedError $e) 
				{
					array_push($this->verificationErrors, $e->toString());
					echo "\nCheck if Title and URL of this page should be : ".$this->getTitle()." and ".$this->getLocation()."?\n";
  				}
			
				$i = $i + 1;
				
			}
			
			elseif ($i==7)
			{
				$this->clickAndWait("//div[@class='nav-container']/ul/li[contains(@class,'level0 nav-$i')]/a/span");
				$spanContains = $this->getText("//div[@class='nav-container']/ul/li[contains(@class,'level0 nav-$i')]/a/span");
				
				try 
				{
			    	$this->assertContains($spanContains,$this->getText("//div[@class='breadcrumbs']/ul/li[contains(@class,'category')]/strong"));
			    	$urlActual = $this->getLocation();
					$urlActual = explode("/",$urlActual);
					$this->assertEquals($urlActual[3],$urlExpectedArray[$i]);
				} 
				catch (PHPUnit_Framework_AssertionFailedError $e) 
				{
					array_push($this->verificationErrors, $e->toString());
					echo "\nCheck if Title and URL of this page should be : ".$this->getTitle()." and ".$this->getLocation()."?\n";
  				}
				
				$this->assertEquals("You are here:",$this->getText("//div[@class='breadcrumbs']/ul/li[1]"));
				$this->assertEquals("Home",$this->getText("//div[@class='breadcrumbs']/ul/li[2]/a"));
			}
			
			else
			{
				$this->clickAndWait("//div[@class='nav-container']/ul[@id='nav']/li[$i]/a");
				$menuLabel = $this->getText("//div[@class='nav-container']/ul[@id='nav']/li[$i]/a");
				
				try 
				{
			    	$this->assertContains($this->getText("//div[5]/div/div[@class='breadcrumbs']/ul/li[@class='cms_page']/strong"),$menuLabel);
			    	$urlActual = $this->getLocation();
					$urlActual = explode("/",$urlActual);
					$this->assertEquals($urlActual[3],$urlExpectedArray[$i]);
				
				} 
				catch (PHPUnit_Framework_AssertionFailedError $e) 
				{
					array_push($this->verificationErrors, $e->toString());
					echo "\nCheck if Title and URL of this page should be : ".$this->getTitle()." and ".$this->getLocation()."?\n";
  				}
								
				$this->assertEquals("You are here:",$this->getText("//div[@class='breadcrumbs']/ul/li[1]"));
				$this->assertEquals("Home",$this->getText("//div[@class='breadcrumbs']/ul/li[2]/a"));
				
			
			}
			
		}
	
	}

	function secondLevelMenuItemsURLTest()
	{
	
		//************************************************************************************
		// Checking if arrayed URLpage has 404 or bad request - Second Level Menu Items.
		//************************************************************************************
		$expectedUrlForSubMenuItems = array
									(
									"",
									"blinds/made-to-measure/vertical-blinds",
									"blinds/made-to-measure/venetian-blinds",
									"blinds/made-to-measure/wooden-venetian-blinds",
									"blinds/made-to-measure/roller-blinds",
									"blinds/made-to-measure/roman-blinds",
									"blinds/made-to-measure/woodweave-blinds",
									"blinds/made-to-measure/panel-blinds",
									"blinds/made-to-measure/pleated-blinds",
									"blinds/skylight/roller-blinds",
									"blinds/perfect-fit/venetians",
									"blinds/perfect-fit/pleated",
									"blinds/ready-made/venetians",
									"blinds/ready-made/rollers",
									"blinds/digital-blinds/rm-digital-blind",
									"blinds/digital-blinds/own-image-digital",
									"blinds/blind-types-explained",
									"blinds/replacement-louvres",
									"blinds/temporary-blinds",
									"curtains/shop-all-curtains/shop-curtains-ready-made",
									"curtains/shop-all-curtains/shop-curtains-made-to-measure",
									"samples/blind-samples/vertical",
									"samples/blind-samples/venetian",
									"samples/blind-samples/wood-venetian",
									"samples/blind-samples/roller",
									"samples/blind-samples/roman",
									"samples/blind-samples/woodweave",
									"samples/blind-samples/pleated",
									"samples/curtains-cushion-fabric-samples/curtains",
									"inspiration/inspirational-looks/inspirational-looks",
									"inspiration/latest-trends",
									"inspiration/design-tips",
									"how-to-measure-and-fit/how-to-measure",
									"how-to-measure-and-fit/how-to-fit",
									);
	
		foreach($expectedUrlForSubMenuItems as $pageOnTest)
		{
	
			$this->open($pageOnTest);
			$this->assertFalse($this->isTextPresent("Bad Request"));
        	$this->assertNotSame("404 Not Found 1", $this->getTitle());	

		}

	}
	
	function  footerLinksURLTest()
	{

		//************************************************************************************
		// Checking if arrayed URLpage has 404 or bad request - Footer Links.
		//************************************************************************************
	
		$expectedUrlForFooterItems = array(
											"customer-service/how-to-order",
											"customer-service/delivery-information",
											"customer-service/refunds-and-returns",
											"customer-service/FAQs",
											"customer-service/contact-us",
											"about-web-blinds/company-information",
											"about-web-blinds/testimonials",
											"about-web-blinds/privacy-policy",
											"about-web-blinds/terms-and-conditions",
											"about-web-blinds/site-security",
											"sitemap",
											);
		foreach($expectedUrlForFooterItems as $pageOnTest)
		{
	
			$this->open($pageOnTest);
			$this->assertFalse($this->isTextPresent("Bad Request"));
        	$this->assertNotSame("404 Not Found 1", $this->getTitle());	

		}

	
	}

}
?>