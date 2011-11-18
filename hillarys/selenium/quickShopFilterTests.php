<?php

require_once 'PHPUnit/Extensions/SeleniumTestCase.php';
include 'baseDef.php';

class quickShopFilterTests extends MainTest
{

	public function testBlindsQuickShop(){ 
	
		$this->openAndWait("/");
		
		//asserting if the elements are present or not.
		$this->assertElementPresent("//form[@id='quick-search-1']");
		$this->assertElementPresent("css=select[id='category_id']");
		$this->assertElementPresent("css=select[id='color-1']");

		//counting available blind types and colors.		
		$blindTypeCount = $this->getXpathCount("//div[@class='field']//select[@id='category_id']/option");
		$colorCount = $this->getXpathCount("//div[@class='field']//select[@id='color-1']/option");

		//displaying available blind types
		
		//string compilation for blind types.
		$xpathBlind1 = "//div[@class='field']//select[@id='category_id']/option[";
		$xpathBlind2 = "]";
		
		for ($i=2;$i<=$blindTypeCount;$i++)
		{
			$blindType[$i] = $this->getText($xpathBlind1.$i.$xpathBlind2);
		}
		
		//displaying available color
			
		//string compilation for color types
		$xpathColor1 = "//div[@class='field']//select[@id='color-1']/option[";
		$xpathColor2 = "]";

		for ($i=2;$i<=$colorCount;$i++)
		{
			$colorType[$i] = $this->getText($xpathColor1.$i.$xpathColor2);
		}
		
			
		for ($k=3;$k<$blindTypeCount && $k<$colorCount ; $k++)
		{
			$this->openAndWait("/");
			$this->select("css=select[id='category_id']","index=${k}");
			$this->select("css=select[id='color-1']","index=${k}");
			$this->clickAndWait("xpath=//form[@id='quick-search-1']//button");
			$this->assertTextPresent("Category");
			$this->assertTextPresent("Colour");
			$this->assertChecked("//ul[@id='narrow-by-list']//ul[1]//div[2]/div/ul/li[${k}]/input");
			
			$category_is_colour_present = $this->getText("//ul[@id='narrow-by-list']//ul[1]//div[2]/div/ul/li[${k}]/label");
			
			//checking if colors are selected or not.
			/*try {
       			$this->assertChecked("//ul[@id='narrow-by-list']//ul[2]//div[2]/div/ul/li[${k}]/input");
				} 
			catch (PHPUnit_Framework_AssertionFailedError $e) {
		    	array_push($this->verificationErrors, $e->toString());
		    	echo "\n Check if the Color Exists for ".$category_is_colour_present;
   				}
   			*/
		}
                
                
            }   
                
            public function testCurtainsQuickShop()
            {
                $this->openAndWait("/");
		
		//asserting if the elements are present or not.
		$this->assertElementPresent("//form[@id='quick-search-2']");
                $this->assertElementPresent("css=select[id='color-2']");
                $this->assertElementPresent("//form[@id='quick-search-2']/fieldset/button");
                
                $colorCount = $this->getXpathCount("//div[@class='field']//select[@id='color-2']/option");
		
                $xpathColor1 = "//div[@class='field']//select[@id='color-2']/option[";
		$xpathColor2 = "]";
                
                for ($i=2;$i<=$colorCount;$i++)
		{
			$colorType[$i] = $this->getText($xpathColor1.$i.$xpathColor2);
		}
		
                
                try{
                        $colorTicked = "";
                        $colorSelected = "";
                        $temp = "";
                        for ($k=1 ; $k<$colorCount ; $k++)
                        {
                            $this->openAndWait("/");
                            $this->select("css=select[id='color-2']","index=${k}");
                            sleep(1);
                            $colorSelected = $this->getSelectedLabel("//select[@id='color-2']");
                            echo "The Selected Color is \"".$colorSelected."\"\n";
                            $this->clickAndWait("xpath=//form[@id='quick-search-2']//button");
                            
                            for ($q=1;$q<10;$q++)
                            {
                                
                                if ($this->isChecked("//ul[@id='narrow-by-list']//ul[3]//div[2]/div/ul/li[${q}]/input")==True)
                                {
                                    $colorTicked = $this->getText("//ul[@id='narrow-by-list']/li/ul[3]/li/div[2]/div/ul/li[${q}]/label");
                                    $this->assertEquals($colorTicked,$colorSelected);
                                    echo "\nExpected is\"".$colorSelected."\" = Actual is \"".$colorTicked."\"\n";
                                }
                                
                            }
                              
                        }
                        
                        
//                      
//                       
//                          
//                            $this->clickAndWait("xpath=//form[@id='quick-search-2']//button");
//                            $this->assertTextPresent("Category");
//                            $this->assertTextPresent("Colour");
//                            $k = $k + 2;
//                            //$this->assertChecked("//ul[@id='narrow-by-list']//ul[3]//div[2]/div/ul/li[${k}]/input");
//                            $this->assertEquals($colorTicked,$this->getText("//ul[@id='narrow-by-list']/li/ul[3]/li/div[2]/div/ul/li[${k}]/label"));
//                            $k = $k - 2;
//
//                        }
                    }
                    
                catch (PHPUnit_Framework_AssertionFailedError $e) 
                    {
                        array_push($this->verificationErrors, $e->toString());
                    } 
             }   
	
}

?>