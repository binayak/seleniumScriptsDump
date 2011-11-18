<?php
require_once 'PHPUnit/Extensions/SeleniumTestCase.php';
include 'baseDef.php';
class requestSample extends MainTest
{

	public function goToRandomBlindSampleAndAddASampleToTheBasket()
	{				
		$this->openAndWait("/");
		echo "\nAdding Sample Item To the Basket.";
		$this->mouseOver("xpath=//div[@class='nav-container']/ul/li[4]");
		$this->waitForElementPresent("class=shown-sub-inner-right");
		$randomOption = rand(1,6);
		$this->clickAndWait("//div[@class='nav-container']/ul[@id='nav']/li[4]//li[1]/ul[1]/li[".$randomOption."]/a[1]/span[1]");
		$this->click("xpath=//li[@class='item first']/div[@class='product-shop']/a/span");
		sleep(3);
		$this->waitForElementPresent("css=#cboxLoadedContent");
		//$this->waitForCondition("selenium.browserbot.getCurrentWindow().document.getElementById('shopping-cart-table').className.match('data-table cart-table');",30000);
		$this->assertEquals("Added to Basket",$this->getText("//div[@id='cboxLoadedContent']/div[@class='cart']/h1"));
		$this->clickAndWait("//button[@class='button']/span/span[text()='Your Basket']");
		sleep(2);
		$this->assertEquals("Your Basket",$this->getText("//div[@class='page-title title-buttons']/h1"));
		$this->assertEquals("£0.00",$this->getText("xpath=//td[@class='a-right cart-subtotal']/span[@class='price']"));
		$this->assertEquals("£0.00",$this->getText("//td[@class='a-right grand-total']//span[@class='price']"));
		$this->assertElementPresent("xpath=//button[@class='button-grey btn-continue']");
		
		echo "\nSample Added in the basket.";
		
	}
	
	public function freeCheckoutSampleInYourBasket()
	{
		
		//**********************************
		//Checkout Begins Here
		//**********************************

		echo "\nNow going through checkout";
		$this->assertElementPresent("//button[@class='btn-proceed-checkout button']");
		$this->clickAndWait("//button[@class='btn-proceed-checkout button']");		

		$this->waitForCondition("selenium.browserbot.getCurrentWindow().document.getElementById('opc-login').className.match(/allow/);",10000);
		echo"\nCheckout begins Here!!";
		$this->assertEquals("Checkout",$this->getTitle());
		$this->assertEquals("Checkout",$this->getText("//div[@class='page-title']/h1"));
		$this->assertEquals("New or Returning Customer?",$this->getText("//ol[@id='checkoutSteps']/li[@id='opc-login']/div/h2"));
		
		$this->assertEquals("New Customer",$this->getText("//div[@class='col2-set']/div[@class='col-1']/h2"));
		$this->assertEquals("Returning Customer",$this->getText("//div[@class='col2-set']/div[@class='col-2']/h2"));
		$this->assertElementPresent("//div[@class='input-box']/input[@id='login-email']");
		$this->assertElementPresent("//div[@class='input-box']/input[@id='login-password']");
		$this->assertElementPresent("//div[@class='buttons-set form-buttons btn-only']/button[@class='button-tick']");
		$this->assertElementPresent("//li[@id='opc-billing']/div[@class='step-title']/h2");
		$this->assertElementPresent("//li[@id='opc-shipping']/div[@class='step-title']/h2");
		$this->assertElementPresent("//li[@id='opc-shipping_method']/div[@class='step-title']/h2");
		$this->assertElementPresent("//li[@id='opc-payment']/div[@class='step-title']/h2");
		$this->assertElementPresent("//li[@id='opc-review']/div[@class='step-title']/h2");
		
		$this->click("//li[@class='control']/input[@id='login:guest']");
		echo " --- Checking Out As Guest!";
		$this->click("//div[@class='buttons-set']/button[@class='button-tick']");
	}	
	
	public function billingAddress() 
	{
	
		//**********************************
		//filling in the billing information.
		//**********************************		
		$this->waitForCondition("selenium.browserbot.getCurrentWindow().document.getElementById('opc-billing').className.match(/allow/);",10000);
		echo "\nEntering Billing Address!";
		$this->waitForElementPresent("css=#checkout-step-billing");
		$this->assertEquals("Billing Information",$this->getText("//li[2]/div[1]/h2"));

		
		$this->assertElementPresent("//select[@id='billing:country_id']");
		$this->assertSelectedLabel("//select[@id='billing:country_id']","United Kingdom");

		$this->assertElementPresent("//input[@id='billing:postcode']");
		$this->type("//input[@id='billing:postcode']","DA16 2BN");
		
		$this->assertElementPresent("//li[@id='billing-new-address-form']/div[1]/ul/li[2]//button");
		$this->click("//li[@id='billing-new-address-form']/div[1]/ul/li[2]//button");
		sleep(10);
		
		/*//Wait for condition loop
		for ($second = 0; ; $second++) 
		{
       		if ($second >= 60) $this->fail("timeout");
       		try 
       		{
           	if ($this->isElementPresent("//select[@id='billing:autoaddress']")) break;
		    }
		    catch (Exception $e) {}
	       sleep(1);
   		}
		sleep(3);*/
		
		$this->waitForCondition("selenium.browserbot.getCurrentWindow().document.getElementById('billing:autoaddress')",10000);
		$this->select("//select[@id='billing:autoaddress']",$this->getText("//select[@id='billing:autoaddress']/option[1]"));

		$this->assertElementPresent("//input[@id='billing:city']");
		/*try{
			$this->assertEquals("London", $this->getText("//input[@id='billing:city']"));
			}
		catch (PHPUnit_Framework_AssertionFailedError $e)
			{
			array_push($this->verificationErrors, $e->toString());
			$this->type("//input[@id='billing:city']","London");
			echo "\n Assertion Failed but it is corrected! \n";
			}
		*/
		$this->assertElementPresent("//input[@id='billing:region']");
		$this->type("//input[@id='billing:region']","Greenwich");

		$this->assertElementPresent("//input[@id='billing:email']");
		$this->type("//input[@id='billing:email']","bsilwal+guestcheckout@ibuildings.com");

		$this->assertElementPresent("//select[@id='billing:prefix']");
		$prefix = explode(" ",$this->getText("//select[@id='billing:prefix']"));
		$this->assertEquals("Mr",$prefix[0]);

		$this->assertElementPresent("//input[@id='billing:firstname']");
		$this->type("//input[@id='billing:firstname']","Binayak_Billing_Address");

		$this->assertElementPresent("//input[@id='billing:lastname']");
		$this->type("//input[@id='billing:lastname']","Silwal_Billing_Address");

		$this->assertElementPresent("//input[@id='billing:telephone']");
		$this->type("//input[@id='billing:telephone']","0123123123");

		$this->assertElementPresent("css=div[id='billing-buttons-container']>button");
		$this->click("css=div[id='billing-buttons-container']>button");
		
	}
	
	public function fillInDeliveryInfo()
	{
	
		//**********************************
		//filling in the Delivery information.
		//**********************************		
		$this->waitForCondition("selenium.browserbot.getCurrentWindow().document.getElementById('opc-shipping').className.match(/allow/);",10000);
		echo"\nEntering Delivery Address";
		$this->waitForElementPresent("css=#checkout-step-shipping");
		$this->assertEquals("Delivery Information",$this->getText("//li[3]/div[1]/h2"));
		
		$this->assertElementPresent("//input[@id='shipping:same_as_billing']");
		$this->assertEquals("Deliver to billing address",$this->getText("//form[@id='co-shipping-form']//li/h4[1]"));
		$this->assertEquals("Enter new address",$this->getText("//fieldset/h4"));
		$this->assertElementPresent("//input[@id='shipping:enter_new_address']");
		$this->click("//input[@id='shipping:enter_new_address']");
		$this->waitForElementPresent("//input[@id='shipping:telephone']");
		
		$this->assertElementPresent("//select[@id='shipping:country_id']");
		//$this->assertEquals("United Kingdom", $this->getText("//select[@id='shipping:country_id']"));
		
		
		
		$this->assertElementPresent("//input[@id='shipping:postcode']");
		$this->type("//input[@id='shipping:postcode']","se7 8sy");
		$this->assertElementPresent("//button[@id='new-address-continue']");
		$this->click("//li[@id='shipping-new-address-form']//div[@class='input-box validation-passed']//button[@id='new-address-continue']");
		//$this->waitForElementPresent("//select[@id='shipping:autoaddress']");
		sleep(10);
		
		
		$this->waitForCondition("selenium.browserbot.getCurrentWindow().document.getElementById('shipping:autoaddress')",10000);
		$this->select("//select[@id='shipping:autoaddress']",$this->getText("//select[@id='shipping:autoaddress']/option[5]"));

		
		//$this->waitForCondition("selenium.browserbot.getCurrentWindow().document.getElementById('billing:autoaddress')",10000);
		//$this->select("//select[@id='billing:autoaddress']",$this->getText("//select[@id='billing:autoaddress']/option[1]"));

		
		$this->assertElementPresent("//input[@id='shipping:street1']");
		$this->assertElementPresent("//input[@id='shipping:city']");
		$this->type("//input[@id='shipping:city']","London");
		$this->assertElementPresent("//input[@id='shipping:region']");
		$this->type("//input[@id='shipping:region']","Greenwich");
		
		$this->assertElementPresent("//select[@id='shipping:prefix']");
		$prefix_ship = explode(" ",$this->getText("//select[@id='shipping:prefix']"));
		$this->assertEquals("Mr",$prefix_ship[0]);
		
		$this->assertElementPresent("//input[@id='shipping:firstname']");
		$this->type("//input[@id='shipping:firstname']","Binayak_Shipping_Address");

		$this->assertElementPresent("//input[@id='shipping:lastname']");
		$this->type("//input[@id='shipping:lastname']","Silwal_Shipping_Address");

		$this->assertElementPresent("//input[@id='shipping:telephone']");
		$this->type("//input[@id='shipping:telephone']","0123123123");

		$this->assertElementPresent("//button[@id='new-address-continue']");
		$this->click("//div[@id='shipping-buttons-container']/button");
		
	
	}
	
	public function chooseDeliveryMethod ()
	{
		
		
		//**********************************
		//Choosing Delivery Method.
		//**********************************	
		sleep(6);
		$this->waitForCondition("selenium.browserbot.getCurrentWindow().document.getElementById('opc-shipping_method').className.match(/allow/);",10000);
		
		echo "\nFree Delivery Method";
		
		$this->assertEquals ("Delivery Method", $this->getText("//li[@id='opc-shipping_method']/div[@class='step-title']/h2"));
		$this->assertElementPresent("//dl[@class='sp-methods']");
		$this->assertElementPresent("//form[@id='co-shipping-method-form']");
		$this->assertEquals("Free Shipping",$this->getText("//form[@id='co-shipping-method-form']//dl[@class='sp-methods']/dt"));
		$this->assertElementPresent("css=div[id='checkout-step-shipping_method']");
		$this->assertChecked("css=input[id='s_method_freeshipping_freeshipping']");
		sleep(2);
		$this->assertElementPresent("//div[@class='delivery-info']");
		$this->assertElementPresent("//div[@class='delivery-links']");
		//$this->assertElementPresent("//div[@class='delivery-table']");
		//$this->assertElementPresent("//table[@id='my-products-table']");
		//$this->assertElementPresent("//a[@class='product-image']");
		//$this->assertElementPresent("//div[@id='delivery_date_curtain_0']");
		//$this->assertElementPresent("//div[@class='delivery-date']");
		//$this->assertElementPresent("//div[@class='delivery-date-inner']");
		//$this->assertElementPresent("//input[@id='another_date_curtain_0']");
		//$this->assertElementPresent("//img[@id='calendar-trigger_curtain_0']");
		$this->assertElementPresent("//div[@id='delivery-instructions']");
		$this->type ("//div[@id='delivery-instructions']","Selenium Automated Tests");
		$this->assertElementPresent("//textarea[@name='delivery_instructions']");
		$this->assertEquals("30", $this->getAttribute("//textarea[@name='delivery_instructions']/@maxlength"));
		$this->assertElementPresent("css=div[id='shipping-method-buttons-container']>button");
		$this->click("css=div[id='shipping-method-buttons-container']>button");
				
	}
	
	
	public function paymentInformation()
	{
			
		
		//**********************************
		//Payment information.
		//**********************************	
		sleep(3);
		$this->waitForCondition("selenium.browserbot.getCurrentWindow().document.getElementById('opc-payment').className.match(/allow/);",10000);
		$this->waitForElementPresent("css=li[id='opc-payment']");
		echo"\nFree Payment Information";
	
		$this->assertElementPresent("css=input[id='p_method_free']");
	
		$this->assertChecked("css=input[id='p_method_free']");
		
		$this->assertElementPresent("css=div[id='payment-buttons-container']>button");
		$this->click("css=div[id='payment-buttons-container']>button");
		sleep(10);
	
	}
	
	public function orderVerification()
	{
	
		
		//**********************************
		//Order Verification Page Testing
		//**********************************	
		sleep(5);
		echo "\nVerifying Order.";
		$this->waitForCondition("selenium.browserbot.getCurrentWindow().document.getElementById('opc-review').className.match(/allow/);",10000);
		$this->waitForElementPresent("css=li[id='opc-review']");
	
		$this->assertEquals("Complete Order",$this->getText("css=li[id='opc-review']>div[class='step-title']>h2"));
		$this->assertEquals("You are about to complete your order on web-blinds.com, please take some time to check all the details below are correct.", $this->getText("css=div[id='checkout-review-table-wrapper']>p"));
		$this->assertElementPresent("css=div[id='checkout-review-table-wrapper']>button[class='button btn-checkout']");
		$this->assertElementPresent("css=table[id='checkout-review-table']");
	
		$this->assertEquals("Item(s)",$this->getText("//table[@id='checkout-review-table']/thead/tr/th[1]"));
		$this->assertEquals("Delivery Details",$this->getText("//table[@id='checkout-review-table']/thead/tr/th[2]"));
		$this->assertEquals("Price",$this->getText("//table[@id='checkout-review-table']/thead/tr/th[3]"));
		$this->assertEquals("Discount",$this->getText("//table[@id='checkout-review-table']/thead/tr/th[4]"));
		$this->assertEquals("Subtotal",$this->getText("//table[@id='checkout-review-table']/thead/tr/th[5]"));
	
		$this->assertElementPresent("css=span[class='product-image']");
		$this->assertElementPresent("css=table[id='checkout-review-totals']");
		$this->assertEquals("Subtotal",$this->getText("css=td[class='a-right cart-subtotal']"));
		$this->assertElementPresent("css=td[class='a-right grand-total']");
		
		$this->assertEquals("£0.00",$this->getText("css=td[class='a-right cart-subtotal']>span[class='price']"));
		$this->assertEquals("£0.00",$this->getText("css=td[class='a-right']>span[class='price']"));
		$this->assertEquals("£0.00",$this->getText("css=td[class='a-right grand-total']>strong>span[class='price']"));
		
		$this->assertElementPresent("css=//li[@id='opc-review']/div/div[2]/div/button[@title='Place Order']");
		$this->click("xpath=//li[@id='opc-review']/div/div[2]/div/button[@title='Place Order']");
	
	}
	
	public function orderSuccessPage()
	{
	
		
		//**********************************
		//Order Success Page Check
		//**********************************	
		sleep(5);
		$this->waitForPageToLoad(90000);
		//$this->waitForCondition("selenium.browserbot.getCurrentWindow().document.getElementById('my-orders-table').className.match('data-table');",40000);
		echo"\nOrder Success Page";
		$this->assertEquals("Your order has been received",$this->getText("css=div[class='page-title']>h1"));
		$this->assertElementPresent("css=a[class='print']");
		$this->assertElementPresent("css=div[class='order-page']>p[class='order-number']");
		$this->assertElementPresent("css=div[class='order-page']>p[class='order-date']");
		$this->assertElementPresent("css=div[class='order-page']>p[class='order-status']");
	
		$this->assertEquals("Shipping Address",$this->getText("xpath=//div[@class='col-1']/div[@class='info-box']/h4[1]"));
		$this->assertEquals("Billing Address",$this->getText("xpath=//div[@class='col-2']/div[@class='info-box']/h4[1]"));
		$this->assertEquals("Delivery Information",$this->getText("xpath=//div[@class='col-3']/div[@class='info-box']/h4[1]"));
	
		$this->assertEquals("Items Ordered",$this->getText("css=div[class='order-details']>h2[class='table-caption']"));
	
		$this->assertEquals("Item",$this->getText("xpath=//table[@id='my-orders-table']/thead/tr/th[1]"));
		$this->assertEquals("Delivery Details",$this->getText("xpath=//table[@id='my-orders-table']/thead/tr/th[2]"));
		$this->assertEquals("Price",$this->getText("xpath=//table[@id='my-orders-table']/thead/tr/th[3]"));
		$this->assertEquals("Discount",$this->getText("xpath=//table[@id='my-orders-table']/thead/tr/th[4]"));
		$this->assertEquals("Subtotal",$this->getText("xpath=//table[@id='my-orders-table']/thead/tr/th[5]"));
	
		$this->assertElementPresent("css=div[class='payment-inner']");
	
		$this->assertElementPresent("css=table[id='my-orders-totals']");
		$this->assertElementPresent("css=button[title='Continue Shopping']");
		$this->assertEquals("£0.00",$this->getText("xpath=//table[@id='my-orders-totals']//strong/span[@class='price']"));
		$orderDetails = $this->getText("css=p[class='order-number']");
		echo"\nYour ".$orderDetails;
		
		
	
	}
	
	public function testRequestSample()
	{
	
		$this->goToRandomBlindSampleAndAddASampleToTheBasket();
		$this->freeCheckoutSampleInYourBasket();
		$this->billingAddress();
		$this->fillInDeliveryInfo();
		$this->chooseDeliveryMethod();
		$this->paymentInformation();
		$this->orderVerification();
		$this->orderSuccessPage();
		
		
	
	}
}
?>