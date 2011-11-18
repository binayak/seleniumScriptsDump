<?php
//require_once 'PHPUnit/Extensions/SeleniumTestCase.php';
require_once 'baseDef.php';
require_once 'placeOrderTest.php';


/*******************************************************
 * The plan is to buy products which are 
 * less than £50 - When $options = 0
 * equals to £50 - When $options = 1
 * more than £50 - When $options = 2
 * more than £50 with different product combinations.
 */



class freeShippingTest extends MainTest
{
	
        
     public function testGoThroughCheckout()
	{
            $this->open("/");
            $orderObject = new placeOrderTest($this);
            $options = "";
            //for ($options = 0; $options <1 ; $options++)
            //{
              
            try
            {
                $this->purchaseCombinations($options);
                $orderObject->checkoutBeginsHere();
                $orderObject->checkoutBeginsHere();
		$orderObject->billingAddress();
		$orderObject->fillInDeliveryInfo();
		$orderObject->chooseDeliveryMethod();
		$orderObject->paymentInformation();
		$orderObject->orderVerification();
		$orderObject->orderSuccessPage();
		sleep(5);
            }
            catch (PHPUnit_Framework_AssertionFailedError $e) 
            {
                array_push($this->verificationErrors, $e->toString());
            }
                
                
            //}
        
	}
    
    
    public function buildYourBlind()
        {
                $this->select("//div[@class='sorter']/div[@class='sort-by']/select","Price Low To High");
                
                sleep(5);
                
                $this->clickAndWait("//div[@class='category-products-inner']/ul[2]/li[2]/div/a");
                $this->assertEquals("Product Summary",$this->getText("//div[@class='block-title']/h3"));
                    
                $this->assertEquals("1",$this->getText("//p[@id='progress-text']//span[@id='step-number']"));
                $this->assertEquals("4",$this->getText("//p[@id='progress-text']//span[@id='count-steps']"));
                
                $heading = array ("","Set Your Measurements","Slat","Add Control Sides","Set Quantity & Optional Info");
                
                /*for ($i = 1; $i < 5 ; $i++)
                {
                    $this->assertEquals($heading[$i],"//div[@class='step-title']/h2[@id='heading-step-{$i}']");
                }*/
                
                try
                {

                    //Set Your Measurements
                    $this->assertElementPresent("//div[@id='measurement-block']");
                    $this->check("//div[@id='measurement-block']/input[@id='measurement-3']");
                    $this->type("//div[@id='width_input-block']/input[@id='width_input']","24");
                    $this->type("//div[@id='drop_input-block']/input","24");
                    $this->assertElementPresent("//div[@id='recess_exact_option-block']");
                    $this->select("//div[@id='recess_exact_option-block']/select","Exact - fitting your blind outside the window");
                    $this->assertElementPresent("//button[@id='nextbtn-1']");
                    $this->click("//button[@id='nextbtn-1']");
                    echo "Set Your Measurement Complete \n";
                    sleep(3);
                    
                    //Slat
                    $this->waitForCondition("selenium.browserbot.getCurrentWindow().document.getElementById('step-title-2').className.match(/step-title/);", "10000");
                    //$this->assertEquals("2",$this->getText("//p[@id='progress-text']//span[@id='step-number']"));
                    $this->assertElementPresent("//div[@id='frontlabel-louvre_slat_width']");
                    $this->click("//button[@id='nextbtn-2']");
                    echo "Slat \n";


                    //Add Control Sides
                    $this->waitForCondition("selenium.browserbot.getCurrentWindow().document.getElementById('step-title-3').className.match(/step-title/);", "10000");
                    //$this->assertEquals("3",$this->getText("//p[@id='progress-text']//span[@id='step-number']"));
                    $this->assertElementPresent("//div[@class='step a-item']");
                    $this->assertElementPresent("//input[@id='control_fitted_side-510']");
                    $this->check("//input[@id='control_fitted_side-510']");
                    $this->assertElementPresent("//input[@id='bunch_fitted_side-48']");
                    $this->check("//input[@id='bunch_fitted_side-48']");
                    $this->click("//button[@id='nextbtn-3']");
                    echo "Adding Control Sides \n";
                    sleep(3);

                    //Set Quantity & Optional Info.
                    $this->waitForCondition("selenium.browserbot.getCurrentWindow().document.getElementById('step-title-4').className.match(/step-title/);", "10000");
                    $this->assertElementPresent("//div[@id='qty-field']");
                    $this->assertElementPresent("//div[@id='child_safety-block']");
                    $this->assertElementPresent("//div[@id='mmp-block']");
                    $this->assertElementPresent("//div[@id='guarantee-block']");
                    $this->click("//button[@id='nextbtn-4']");
                    echo "Set QTY and Optional Info\n";
                    sleep(3);
                    
                    //Add to Basket
                    echo "Added To the Basket! \n";
                    $this->waitForCondition("selenium.browserbot.getCurrentWindow().document.getElementById('add-to-cart-btn').className.match(/btn-cart/);", "10000");
                    $this->click("//button[@id='add-to-cart-btn']");
                    $this->waitForElementPresent("css=#cboxLoadedContent");
                    sleep(5);
		
                    $this->assertEquals("Added to Basket",$this->getText("//div[@id='cboxLoadedContent']/div[@class='cart']/h1"));
                    $this->clickAndWait("//button[@class='button']/span/span[text()='Your Basket']");
                           
                    sleep(3);
                }
                catch (PHPUnit_Framework_AssertionFailedError $e) 
                {
                    array_push($this->verificationErrors, $e->toString());
                }
                
        }
       
      
        
        
        public function purchaseCombinations($options)
        {
            //if ($options == 0) //less than £50 - When $options = 0
            //{
                $this->mouseOver("xpath=//div[@class='nav-container']/ul/li[1]");
                $this->waitForElementPresent("class=top-menu-row shown-sub");
                $this->clickAndWait("link=Vertical blinds");
                $this->assertElementPresent("//div[@id='category-content-right']/p/a[@class='button']");
                $this->clickAndWait("//div[@id='category-content-right']/p/a[@class='button']");
                $this->assertEquals("Made to Measure Blinds - Window Blinds - Web Blinds", $this->getTitle());
                
                //sort and build your own blind. Make this a function.
                $this->buildYourBlind();
            //}
        
        }
}
        