<?php
require_once 'PHPUnit/Extensions/SeleniumTestCase.php';
require_once 'baseDef.php';

class placeOrderTest extends MainTest
{

protected $test;

public function __construct(PHPUnit_Extensions_SeleniumTestCase $test)
{
  $this->test = $test;
}

	public function addingItemToBasket()
	
	{
	
		//**********************************
		//Add Items to Your Bag
		//**********************************		

		echo "\nAdding Item To the Basket.";
		
		$this->test->mouseOver("xpath=//div[@class='nav-container']/ul/li[2]");
                $this->test->waitForElementPresent("class=top-menu-row shown-sub");
                $this->test->clickAndWait("link=Ready-made curtains");
                $this->test->assertEquals("Curtains (Ready Made) - Curtains",$this->test->getTitle());
		$this->test->assertEquals("Buy Now",$this->test->getText("//div[@id='results-view']/div[1]/div[2]/div/ul[1]/li[1]/div/a/span"));
		$this->test->clickAndWait("//div[@id='results-view']/div[1]/div[2]/div/ul[1]/li[1]/div/a/span");
		$this->test->assertElementPresent("//div[@class='product-essential']");
		$this->test->select("//select[@id='curtain_size']","index=2");
		$this->test->click("//button[@id='add-to-cart-btn']");
		$this->test->waitForElementPresent("css=#cboxLoadedContent");
		sleep(15);
		
		//$this->test->waitForCondition("selenium.browserbot.getCurrentWindow().document.getElementById('shopping-cart-table').className.match(/-table cart-/);", "10000");
                $this->test->assertEquals("Added to Basket",$this->test->getText("//div[@id='cboxLoadedContent']/div[@class='cart']/h1"));
		$this->test->clickAndWait("//button[@class='button']/span/span[text()='Your Basket']");
		sleep(2);
		$this->test->assertEquals("Your Basket",$this->test->getText("//div[@class='page-title title-buttons']/h1"));
		$this->test->assertElementPresent("//button[@class='btn-proceed-checkout button']");
		$this->test->clickAndWait("//button[@class='btn-proceed-checkout button']");
		
		
	
	}
	
	public function checkoutBeginsHere()
	{
	
		//**********************************
		//Checkout Begins Here
		//**********************************		

		
                //$this->test->openAndWait("checkout/cart/");
                
                try
                {
                    $this->test->assertTextNotPresent("Empty");
                }
                
                catch (PHPUnit_Framework_AssertionFailedError $e) 
                {
                    array_push($this->verificationErrors, $e->toString());
                }
                
                //$this->test->click("//button[@class='btn-proceed-checkout button']");
                $this->test->waitForCondition("selenium.browserbot.getCurrentWindow().document.getElementById('opc-login').className.match(/allow/);",10000);echo"\nCheckout begins Here!!";
		$this->test->assertEquals("Checkout",$this->test->getTitle());
		$this->test->assertEquals("Checkout",$this->test->getText("//div[@class='opc-wrapper']/div[@class='page-title']/h1"));
		$this->test->assertEquals("New or Returning Customer?",$this->test->getText("//ol[@id='checkoutSteps']/li[@id='opc-login']/div/h2"));
		
		$this->test->assertEquals("New Customer",$this->test->getText("//div[@class='col2-set']/div[@class='col-1']/h2"));
		$this->test->assertEquals("Returning Customer",$this->test->getText("//div[@class='col2-set']/div[@class='col-2']/h2"));
		$this->test->assertElementPresent("//div[@class='input-box']/input[@id='login-email']");
		$this->test->assertElementPresent("//div[@class='input-box']/input[@id='login-password']");
		$this->test->assertElementPresent("//div[@class='buttons-set form-buttons btn-only']/button[@class='button-tick']");
		$this->test->assertElementPresent("//li[@id='opc-billing']/div[@class='step-title']/h2");
		$this->test->assertElementPresent("//li[@id='opc-shipping']/div[@class='step-title']/h2");
		$this->test->assertElementPresent("//li[@id='opc-shipping_method']/div[@class='step-title']/h2");
		$this->test->assertElementPresent("//li[@id='opc-payment']/div[@class='step-title']/h2");
		$this->test->assertElementPresent("//li[@id='opc-review']/div[@class='step-title']/h2");
		
		$this->test->click("//li[@class='control']/input[@id='login:guest']");
		echo " --- Checking Out As Guest!";
		$this->test->click("//div[@class='buttons-set']/button[@class='button-tick']");
						
	}
	
	public function billingAddress() 
	{
	
		//**********************************
		//filling in the billing information.
		//**********************************		
		$this->test->waitForCondition("selenium.browserbot.getCurrentWindow().document.getElementById('opc-billing').className.match(/allow/);",10000);
		echo "\nEntering Billing Address!";
		$this->test->waitForElementPresent("css=#checkout-step-billing");
		$this->test->assertEquals("Billing Information",$this->test->getText("//li[2]/div[1]/h2"));

		
		$this->test->assertElementPresent("//select[@id='billing:country_id']");
		$this->test->assertSelectedLabel("//select[@id='billing:country_id']","United Kingdom");

		$this->test->assertElementPresent("//input[@id='billing:postcode']");
		$this->test->type("//input[@id='billing:postcode']","DA16 2BN");
		
		$this->test->assertElementPresent("//li[@id='billing-new-address-form']/div[1]/ul/li[2]//button");
		$this->test->click("//li[@id='billing-new-address-form']/div[1]/ul/li[2]//button");
		sleep(1);
		
		
		
                $this->test->waitForCondition("selenium.browserbot.getCurrentWindow().document.getElementById('addresses-please-wait').style='display: none';",10000);
                
                
                $this->test->waitForCondition("selenium.browserbot.getCurrentWindow().document.getElementById('billing:autoaddress').options.length >0;",10000);
		$this->test->select("//select[@id='billing:autoaddress']",$this->test->getText("//select[@id='billing:autoaddress']/option[1]"));

		$this->test->assertElementPresent("//input[@id='billing:city']");
		
		$this->test->assertElementPresent("//input[@id='billing:region']");
		$this->test->type("//input[@id='billing:region']","Greenwich");

		$this->test->assertElementPresent("//input[@id='billing:email']");
		$this->test->type("//input[@id='billing:email']","bsilwal+guestcheckout@ibuildings.com");

		$this->test->assertElementPresent("//select[@id='billing:prefix']");
		$prefix = explode(" ",$this->test->getText("//select[@id='billing:prefix']"));
		$this->test->assertEquals("Mr",$prefix[0]);

		$this->test->assertElementPresent("//input[@id='billing:firstname']");
		$this->test->type("//input[@id='billing:firstname']","Binayak_Billing_Address");

		$this->test->assertElementPresent("//input[@id='billing:lastname']");
		$this->test->type("//input[@id='billing:lastname']","Silwal_Billing_Address");

		$this->test->assertElementPresent("//input[@id='billing:telephone']");
		$this->test->type("//input[@id='billing:telephone']","0123123123");

		$this->test->assertElementPresent("css=div[id='billing-buttons-container']>button");
		$this->test->click("css=div[id='billing-buttons-container']>button");
		
	}
	
	public function fillInDeliveryInfo()
	
	{
	
		//**********************************
		//filling in the Delivery information.
		//**********************************		
		$this->test->waitForCondition("selenium.browserbot.getCurrentWindow().document.getElementById('opc-shipping').className.match(/allow/);",10000);
		echo"\nEntering Delivery Address";
		$this->test->waitForElementPresent("css=#checkout-step-shipping");
		$this->test->assertEquals("Delivery Information",$this->test->getText("//li[3]/div[1]/h2"));
		
		$this->test->assertElementPresent("//input[@id='shipping:same_as_billing']");
		$this->test->assertEquals("Deliver to billing address",$this->test->getText("//form[@id='co-shipping-form']//li/h4[1]"));
		$this->test->assertEquals("OR enter new address",$this->test->getText("//fieldset/h4"));
		$this->test->assertElementPresent("//input[@id='shipping:enter_new_address']");
		$this->test->click("//input[@id='shipping:enter_new_address']");
		$this->test->waitForElementPresent("//input[@id='shipping:telephone']");
		
		$this->test->assertElementPresent("//select[@id='shipping:country_id']");
		//$this->test->assertEquals("United Kingdom", $this->test->getText("//select[@id='shipping:country_id']"));
		
		
		
		$this->test->assertElementPresent("//input[@id='shipping:postcode']");
		$this->test->type("//input[@id='shipping:postcode']","se7 8sy");
		$this->test->assertElementPresent("//button[@id='new-address-continue']");
		$this->test->click("//li[@id='shipping-new-address-form']//div[@class='input-box validation-passed']//button[@id='new-address-continue']");
		//$this->test->waitForElementPresent("//select[@id='shipping:autoaddress']");
		
		$this->test->waitForCondition("selenium.browserbot.getCurrentWindow().document.getElementById('shipping:addresses-please-wait').style='display: none';",10000);
                $this->test->waitForCondition("selenium.browserbot.getCurrentWindow().document.getElementById('shipping:autoaddress').options.length >0;",10000);
		
		
		//THIS IS WORKING $this->test->waitForCondition("selenium.browserbot.getCurrentWindow().document.getElementById('shipping:autoaddress')",10000);
		$this->test->select("//select[@id='shipping:autoaddress']",$this->test->getText("//select[@id='shipping:autoaddress']/option[5]"));

		
		//$this->test->waitForCondition("selenium.browserbot.getCurrentWindow().document.getElementById('billing:autoaddress')",10000);
		//$this->test->select("//select[@id='billing:autoaddress']",$this->test->getText("//select[@id='billing:autoaddress']/option[1]"));

		
		$this->test->assertElementPresent("//input[@id='shipping:street1']");
		$this->test->assertElementPresent("//input[@id='shipping:city']");
		$this->test->type("//input[@id='shipping:city']","London");
		$this->test->assertElementPresent("//input[@id='shipping:region']");
		$this->test->type("//input[@id='shipping:region']","Greenwich");
		
		$this->test->assertElementPresent("//select[@id='shipping:prefix']");
		$prefix_ship = explode(" ",$this->test->getText("//select[@id='shipping:prefix']"));
		$this->test->assertEquals("Mr",$prefix_ship[0]);
		
		$this->test->assertElementPresent("//input[@id='shipping:firstname']");
		$this->test->type("//input[@id='shipping:firstname']","Binayak_Shipping_Address");

		$this->test->assertElementPresent("//input[@id='shipping:lastname']");
		$this->test->type("//input[@id='shipping:lastname']","Silwal_Shipping_Address");

		$this->test->assertElementPresent("//input[@id='shipping:telephone']");
		$this->test->type("//input[@id='shipping:telephone']","0123123123");

		$this->test->assertElementPresent("//button[@id='new-address-continue']");
		$this->test->click("//div[@id='shipping-buttons-container']/button");
		
	
	}
	
	public function chooseDeliveryMethod ()
	{
		
		
		//**********************************
		//Choosing Delivery Method.
		//**********************************	
		sleep(6);
		$this->test->waitForCondition("selenium.browserbot.getCurrentWindow().document.getElementById('opc-shipping_method').className.match(/allow/);",10000);
		
		echo "\nChoosing Delivery Method";
		echo " --- Assuming 3 Delivery methods are available \n	1. Standard\n	2. Morning\n	3. Saturday";
		
		$this->test->assertEquals ("Delivery Method", $this->test->getText("//li[@id='opc-shipping_method']/div[@class='step-title']/h2"));
		$this->test->assertElementPresent("//dl[@class='sp-methods']");
		$this->test->assertElementPresent("//form[@id='co-shipping-method-form']");
		$this->test->assertEquals("Select your delivery service",$this->test->getText("//form[@id='co-shipping-method-form']//dl[@class='sp-methods']/dt"));
		$this->test->assertElementPresent("css=div[id='checkout-step-shipping_method']");
		$this->test->assertElementPresent("css=div[id='checkout-shipping-method-load']>dl[class='sp-methods']");
		//$this->test->assertElementPresent("css=input[id='s_method_hillarysrate_standard']");
		//$this->test->assertElementPresent("css=input[id='s_method_hillarysrate_am']");
		//$this->test->assertElementPresent("css=input[id='s_method_hillarysrate_saturday']");
                
                if (($this->test->isTextPresent("£0.00"))===True)
                {
                    $this->test->assertChecked("css=input[id='s_method_hillarysrate_freeshipping']");
                }
                else 
                {
                     $this->test->assertChecked("css=input[id='s_method_hillarysrate_standard']");
                }
		
		sleep(2);
		$this->test->assertElementPresent("//div[@class='delivery-info']");
		$this->test->assertElementPresent("//div[@class='delivery-links']");
		$this->test->assertElementPresent("//div[@class='delivery-table']");
		$this->test->assertElementPresent("//table[@id='my-products-table']");
		$this->test->assertElementPresent("//a[@class='product-image']");
		$this->test->assertElementPresent("//div[@id='delivery_date_curtain_0']");
		$this->test->assertElementPresent("//div[@class='delivery-date']");
		$this->test->assertElementPresent("//div[@class='delivery-date-inner']");
		$this->test->assertElementPresent("//input[@id='another_date_curtain_0']");
		$this->test->assertElementPresent("//img[@id='calendar-trigger_curtain_0']");
		$this->test->assertElementPresent("//div[@id='delivery-instructions']");
		$this->test->type ("//div[@id='delivery-instructions']","Selenium Automated Tests");
		$this->test->assertElementPresent("//textarea[@name='delivery_instructions']");
		$this->test->assertEquals("30", $this->test->getAttribute("//textarea[@name='delivery_instructions']/@maxlength"));
		$this->test->assertElementPresent("css=div[id='shipping-method-buttons-container']>button");
		$this->test->click("css=div[id='shipping-method-buttons-container']>button");
				
	}
	
	
	public function paymentInformation()
	{
			
		
		//**********************************
		//Payment information.
		//**********************************	
		sleep(3);
		$this->test->waitForCondition("selenium.browserbot.getCurrentWindow().document.getElementById('opc-payment').className.match(/allow/);",10000);
		$this->test->waitForElementPresent("css=li[id='opc-payment']");
		echo"\nPayment Information";
		echo" --- Assuming following payment methods:\n	1.Commidea\n	2.PayPal Direct\n	3.PayPal Express\n	4.Check/Money Order";
	
		$this->test->assertElementPresent("css=input[id='p_method_commidea_paypage']");
		$this->test->assertElementPresent("css=input[id='p_method_paypal_direct']");
		$this->test->assertElementPresent("css=input[id='p_method_paypal_express']");
		$this->test->assertElementPresent("css=input[id='p_method_checkmo']");
	
		$this->test->assertNotChecked("css=input[id='p_method_commidea_paypage']");
		$this->test->assertNotChecked("css=input[id='p_method_paypal_direct']");
		$this->test->assertNotChecked("css=input[id='p_method_paypal_express']");
		$this->test->assertNotChecked("css=input[id='p_method_checkmo']");
	
		$this->test->check("css=input[id='p_method_checkmo']");
	
		$this->test->assertElementPresent("css=div[id='payment-buttons-container']>button");
		$this->test->click("css=div[id='payment-buttons-container']>button");
		sleep(10);
	
	}
	
	public function orderVerification()
	{
	
		
		//**********************************
		//Order Verification Page Testing
		//**********************************	
		sleep(5);
		echo "\nVerifying Order.";
		$this->test->waitForCondition("selenium.browserbot.getCurrentWindow().document.getElementById('opc-review').className.match(/allow/);",10000);
		$this->test->waitForElementPresent("css=li[id='opc-review']");
	
		$this->test->assertEquals("Complete Order",$this->test->getText("css=li[id='opc-review']>div[class='step-title']>h2"));
		$this->test->assertEquals("You are about to complete your order on web-blinds.com, please take some time to check all the details below are correct.", $this->test->getText("css=div[id='checkout-review-table-wrapper']>p"));
		$this->test->assertElementPresent("css=div[id='checkout-review-table-wrapper']>button[class='button btn-checkout']");
		$this->test->assertElementPresent("css=table[id='checkout-review-table']");
	
		$this->test->assertEquals("Item(s)",$this->test->getText("//table[@id='checkout-review-table']/thead/tr/th[1]"));
		$this->test->assertEquals("Delivery Details",$this->test->getText("//table[@id='checkout-review-table']/thead/tr/th[2]"));
		$this->test->assertEquals("Price",$this->test->getText("//table[@id='checkout-review-table']/thead/tr/th[3]"));
		$this->test->assertEquals("Discount",$this->test->getText("//table[@id='checkout-review-table']/thead/tr/th[4]"));
		$this->test->assertEquals("Subtotal",$this->test->getText("//table[@id='checkout-review-table']/thead/tr/th[5]"));
	
		$this->test->assertElementPresent("css=span[class='product-image']");
		$this->test->assertElementPresent("css=table[id='checkout-review-totals']");
		$this->test->assertEquals("Subtotal",$this->test->getText("css=td[class='a-right cart-subtotal']"));
		$this->test->assertElementPresent("css=td[class='a-right grand-total']");
		$this->test->assertElementPresent("css=//li[@id='opc-review']/div/div[2]/div/button[@title='Place Order']");
		$this->test->click("xpath=//li[@id='opc-review']/div/div[2]/div/button[@title='Place Order']");
	
	}
	
	public function orderSuccessPage ()
	{
	
		
		//**********************************
		//Order Success Page Check
		//**********************************	
		sleep(5);
		$this->test->waitForPageToLoad(90000);
		//$this->test->waitForCondition("selenium.browserbot.getCurrentWindow().document.getElementById('my-orders-table').className.match('data-table');",40000);
		echo"\nOrder Success Page";
		$this->test->assertEquals("Your order has been received",$this->test->getText("css=div[class='page-title']>h1"));
		$this->test->assertElementPresent("css=a[class='print']");
		$this->test->assertElementPresent("css=div[class='order-page']>p[class='order-number']");
		$this->test->assertElementPresent("css=div[class='order-page']>p[class='order-date']");
		$this->test->assertElementPresent("css=div[class='order-page']>p[class='order-status']");
	
		$this->test->assertEquals("Shipping Address",$this->test->getText("xpath=//div[@class='col-1']/div[@class='info-box']/h4[1]"));
		$this->test->assertEquals("Billing Address",$this->test->getText("xpath=//div[@class='col-2']/div[@class='info-box']/h4[1]"));
		$this->test->assertEquals("Delivery Information",$this->test->getText("xpath=//div[@class='col-3']/div[@class='info-box']/h4[1]"));
	
		$this->test->assertEquals("Items Ordered",$this->test->getText("css=div[class='order-details']>h2[class='table-caption']"));
	
		$this->test->assertEquals("Item",$this->test->getText("xpath=//table[@id='my-orders-table']/thead/tr/th[1]"));
		$this->test->assertEquals("Delivery Details",$this->test->getText("xpath=//table[@id='my-orders-table']/thead/tr/th[2]"));
		$this->test->assertEquals("Price",$this->test->getText("xpath=//table[@id='my-orders-table']/thead/tr/th[3]"));
		$this->test->assertEquals("Discount",$this->test->getText("xpath=//table[@id='my-orders-table']/thead/tr/th[4]"));
		$this->test->assertEquals("Subtotal",$this->test->getText("xpath=//table[@id='my-orders-table']/thead/tr/th[5]"));
	
		$this->test->assertElementPresent("css=div[class='payment-inner']");
	
		$this->test->assertElementPresent("css=table[id='my-orders-totals']");
		$this->test->assertElementPresent("css=button[title='Continue Shopping']");
		$orderDetails = $this->test->getText("css=p[class='order-number']");
		echo"\nYour ".$orderDetails;
		
	
	}
	
//	public function testBuyWhatEverIsInTheBasket()//I have renamed this it was originally testBuyWhatEverIsInTheBasket
//	{
//
//	 	$this->test->openAndWait("/");
//		
//	/*	//Top categories
//		echo "\nWhat Do You Want to Buy?\n";  
//		echo"\nTop Categories\n";
//		for($i=1;$i<8;$i++){
//			$category[$i]=$this->test->getText("//ul[@id='nav']/li[$i]/a/span");
//			//echo $i." ".$category[$i]."\n";
//			}
//		
//		//Sub Categories under Blinds
//		echo"\nSub Categories\n";
//		for($i=1;$i<9;$i++){
//			$subCategory[$i]=$this->test->getText("//ul[@id='sub-level-6']/li[$i]/a");
//			//echo $i." ".$subCategory[$i]."\n";
//			}
//	*/		
//		
//		$this->test->addingItemToBasket();
//		$this->test->checkoutBeginsHere();
//		$this->test->billingAddress();
//		$this->test->fillInDeliveryInfo();
//		$this->test->chooseDeliveryMethod();
//		$this->test->paymentInformation();
//		$this->test->orderVerification();
//		$this->test->orderSuccessPage();
//		sleep(5);
//				
//	}

}

?>

