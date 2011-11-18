<?php

require_once 'PHPUnit/Extensions/SeleniumTestCase.php';
include 'baseDef.php';
class MyAccountTest extends MainTest
{ 

   public function testChangeMyDetails()
   {
       $new_email = "bsilwal+1@ibuildings.com";
       $new_prefix = "Company";
       $new_name = "Binayak"; 
       $new_surname = "Silwal";
       $new_password = "password123";
       
       $this->logIn("bsilwal@ibuildings.com","password");
       $this->clickAndWait("link=Update my details");
       $welcome_text = $this->getText("css=.header-welcome");
       
       
       // Change email address, prefix, name, surname.
       
       $this->type("email","bsilwal@ibuildings.com");
       $this->type("email-new",$new_email);
       $this->type("email-confirm",$new_email);
       $this->select("prefix",$new_prefix);
       $this->type("firstname",$new_name);
       $this->type("lastname",$new_surname);
       $this->click("css=button[title='Update Details']");
       
       $this->waitForElementPresent("css=.messages-lightbox");
       
       $this->assertEquals("Account Success",$this->getText("xpath=//div[@class='messages-lightbox ']/div/h1"));
       $this->assertContains("The account information has been saved.",$this->getText("xpath=//li[@class='success-msg']/ul/li"));
       
       $this->click("cboxClose");  
       
       //Change password.
       
       $this->clickAndWait("link=Update my details");
       
       $this->type("current_password","password");
       $this->type("password",$new_password);
       $this->type("confirmation",$new_password);
       $this->clickAndWait("css=button[title='Change Password']");
       
       $this->waitForElementPresent("css=.messages-lightbox");
       
       $this->assertEquals("Account Success",$this->getText("xpath=//div[@class='messages-lightbox ']/div/h1"));
       $this->assertContains("The account information has been saved.",$this->getText("xpath=//li[@class='success-msg']/ul/li"));
        
       $this->click("cboxClose");
       
       
       //Logout and re-login.
       
       $this->logIn($new_email,$new_password);
       
    
       
       //Check for the header text consistency.
       
       $welcome_text_changed = $this->getText("css=.header-welcome");
       $this->assertNotEquals($welcome_text, $welcome_text_changed);
       
       $chunk = substr($welcome_text_changed, 9);
       //e.g. Welcome, Mr Binayak Silwal!
       echo $chunk;
       
       $chunk = explode(" ", $chunk);
       
       $prefix = $chunk[0]; //Mr
       echo "\n";
       echo $prefix;
       $name = $chunk[1]; //Binayak
       echo "\n";
       echo $name;
       $username = $chunk[2]; //Silwal!
       echo "\n";
       echo $username;
       $username = substr($username, 0, -1); //Silwal
       echo "\n";
       echo $username;
       
       
       $this->assertEquals($prefix, $new_prefix);
       $this->assertEquals($name, $new_name);
       $this->assertEquals($username, $new_surname);
       
       
       $this->logIn($new_email, $new_password);
       $this->clickAndWait("link=Update my details");
       
       $this->type("email",$new_email);
       $this->type("email-new","bsilwal@ibuildings.com");
       $this->type("email-confirm","bsilwal@ibuildings.com");
       $this->select("prefix","Mr");
       $this->type("firstname","Binayak");
       $this->type("lastname","Silwal");
       $this->clickAndWait("css=button[title='Update Details']");
       
       $this->waitForElementPresent("css=.messages-lightbox");
       
       $this->assertEquals("Account Success",$this->getText("xpath=//div[@class='messages-lightbox ']/div/h1"));
       $this->assertContains("The account information has been saved.",$this->getText("xpath=//li[@class='success-msg']/ul/li"));
       
       $this->click("cboxClose");
       
       $this->clickAndWait("link=Update my details");
       
       $this->type("current_password","password123");
       $this->type("password","password");
       $this->type("confirmation","password");
       $this->clickAndWait("css=button[title='Change Password']");
       
       $this->waitForElementPresent("css=.messages-lightbox");
       
       $this->assertEquals("Account Success",$this->getText("xpath=//div[@class='messages-lightbox ']/div/h1"));
       $this->assertContains("The account information has been saved.",$this->getText("xpath=//li[@class='success-msg']/ul/li"));
       
       $this->click("cboxClose");
       
       $this->logOut();    
   }
   
 
   
   public function _testSavedMeasure()
   {       
       $this->logIn("bsilwal@ibuildings.com", "password");
       $this->clickAndWait("link=Save measurements");
       $this->assertEquals("You have no saved measurements.",$this->getText("xpath=//p[@class='medium']/strong"));
       $this->click("link=Add a Window");
       $this->waitForElementPresent("css=#cboxLoadedContent");
       sleep(3);
       
       $this->click("xpath=//div[@class='field']/input[@id='inches']");
       $this->type("xpath=//ul[@class='form-list']/li[1]/div[2]/div/input","40");
       $this->type("xpath=//ul[@class='form-list']/li[1]/div[3]/div/input", "40");
       $this->click("xpath=//label[text()='Recess']");
       $this->type("xpath=//ul[@class='form-list']/li[3]/div[1]/div/input", "Station side");
       $this->select("room_id", "Kitchen");
       $this->click("xpath=//button[@class='button']/span/span[text()='Save Measurements']");
       
       $this->waitForElementPresent("css=.messages-lightbox");
       
       $this->assertEquals("Window Success",$this->getText("xpath=//div[@class='messages-lightbox ']/div/h1"));
       $this->assertContains("Window was successfully saved",$this->getText("xpath=//li[@class='success-msg']/ul/li"));
       
       $this->click("cboxClose");
        
       $this->assertEquals("Kitchen", $this->getText("xpath=//div[@id='saved-measurements']/h3"));
       $this->assertEquals("Station side", $this->getText("xpath=//div[@id='saved-measurements']/ul/li[1]/p"));
       $this->assertEquals("40 inches", $this->getText("xpath=//dl[1]/dd"));
       $this->assertEquals("40 inches", $this->getText("xpath=//dl[2]/dd"));
       $this->assertEquals("Recess", $this->getText("xpath=//dl[3]/dd"));
       $this->assertTrue($this->isElementPresent("link=Shop For Window"));
       
       sleep(2);
       $this->click("link=Edit");
       
       $this->waitForElementPresent("css=#cboxLoadedContent");
       sleep(3);
       
       $this->click("xpath=//div[@class='field']/input[@id='cm']");
       $this->type("xpath=//ul[@class='form-list']/li[1]/div[2]/div/input","50");
       $this->type("xpath=//ul[@class='form-list']/li[1]/div[3]/div/input", "50");
       $this->click("xpath=//ul[@class='form-list']/li[2]/div/input[@title='Exact']");  
       $this->type("xpath=//ul[@class='form-list']/li[3]/div[1]/div/input", "Front street");
       sleep(2);
       $this->select("room_id", "Bathroom");
       $this->click("xpath=//button[@class='button']/span/span[text()='Save Measurements']");
       
       $this->waitForElementPresent("css=.messages-lightbox");
       
       $this->assertEquals("Window Success",$this->getText("xpath=//div[@class='messages-lightbox ']/div/h1"));
       $this->assertContains("Window was successfully saved",$this->getText("xpath=//li[@class='success-msg']/ul/li"));
       
       $this->click("cboxClose");
       sleep(2);
       
       try
       {
       $this->assertEquals("Bathroom", $this->getText("xpath=//div[@id='saved-measurements']/h3"));
       }
       catch (PHPUnit_Framework_AssertionFailedError $e)
       {
       array_push($this->verificationErrors, $e->toString());
       }
       
       $this->assertEquals("Front street", $this->getText("xpath=//div[@id='saved-measurements']/ul/li[1]/p"));
       $this->assertEquals("50 cm", $this->getText("xpath=//dl[1]/dd"));
       $this->assertEquals("50 cm", $this->getText("xpath=//dl[2]/dd"));
       $this->assertEquals("Exact", $this->getText("xpath=//dl[3]/dd"));
       $this->assertTrue($this->isElementPresent("link=Shop For Window"));
       $this->assertTrue($this->isElementPresent("link=Edit"));
       
       $this->click("link=Delete");
       $this->assertTrue((bool)preg_match('/^Are you sure[\s\S]$/',$this->getConfirmation()));
       
       $this->waitForElementPresent("css=.messages-lightbox");
       sleep(2);
       
       $this->assertEquals("Window Success",$this->getText("xpath=//div[@class='messages-lightbox ']/div/h1"));
       $this->assertContains("has been deleted.",$this->getText("xpath=//li[@class='success-msg']/ul/li"));
   
       $this->click("cboxClose");  
    }
    
   /* public function testMyOrders()
    {
        //////////// *********** \\\\\\\\\\\\
        $this->markTestIncomplete('The test cannot be created, cause a lack of test environment!');
        //////////// *********** \\\\\\\\\\\\
    }*/
    
    public function _testMySupportTickets()
    {
        $this->logIn("bsilwal@ibuildings.com", "password");
        $this->clickAndWait("link=My Support Tickets");
        
        $order = rand(1,1000);
        $this->type("title","Ticket_".$order);
        
        // no orders yet $this->select("order_id","");
        
        $this->type("content_field","Some content here...");
        $this->type("filename", "file:///tmp/testfile.txt");
        $this->click("xpath=//button[@class='button right form-button']/span/span[text()='Submit ticket']");
        
        //////////// *********** \\\\\\\\\\\\
        $this->markTestIncomplete('The test cannot be completed, cause a lack of test environment! Also you should add the prev tickets check');
        //////////// *********** \\\\\\\\\\\\
    }
    
    public function _testQuoteSampleCompare()
    {
        
        //Quote Test
        $this->logIn("bsilwal@ibuildings.com", "password");
        $this->clickAndWait("link=My Saved Quotes & Samples");
        
        $this->assertTrue($this->isTextPresent("You have no quotes."));
        $this->assertTrue($this->isTextPresent("You have no items to compare"));
        $this->assertTrue($this->isTextPresent("You have no items in your samples."));
        
        $this->mouseOver("xpath=//div[@class='nav-container']/ul/li[1]");
        $this->waitForElementPresent("class=top-menu-row shown-sub");
        $this->clickAndWait("link=Perfect Fit Pleated blinds");
        
        $this->clickAndWait("xpath=//li[@class='item first']/a");
        
        $productquotedname = $this->getText("xpath=//div[@class='product-name']/h1");
        
        $this->type("width_input", "120");
        $this->type("drop_input", "100");
        $this->click("nextbtn-1");
        $this->waitForElementPresent("step-tracking-step-title-2");
        $this->click("nextbtn-2");
        $this->waitForElementPresent("step-tracking-step-title-3");
        $this->select("bracket_size","18mm");
        $this->click("nextbtn-3");
        $this->waitForElementPresent("step-tracking-step-title-4"); 
        sleep(2);
        $this->clickAndWait("save-as-quote");
        
        $this->waitForElementPresent("css=.messages-lightbox");
        sleep(2);
        $this->assertEquals("Saved Quotes Success",$this->getText("xpath=//div[@class='messages-lightbox ']/div/h1"));
        $this->assertContains("The product saved as quote.",$this->getText("xpath=//li[@class='success-msg']/ul/li"));
        $this->click("cboxClose");
        sleep(2);
        
        $this->assertTrue($this->isTextPresent("Saved Quotes & Samples"));
        $this->assertEquals("Blind Name", $this->getText("xpath=//table[@id='my-quotes-table']/thead/tr/th[1]"));
        $this->assertEquals("Price", $this->getText("xpath=//table[@id='my-quotes-table']/thead/tr/th[2]"));
        $this->assertEquals("Discount", $this->isElementPresent("xpath=//table[@id='my-quotes-table']/thead/tr/th[3]"));
        $this->assertEquals("Quote", $this->isElementPresent("xpath=//table[@id='my-quotes-table']/thead/tr/th[4]"));
        $this->assertEquals("Actions", $this->isElementPresent("xpath=//table[@id='my-quotes-table']/thead/tr/th[5]"));
        
        $this->assertEquals("1", $this->getXpathCount("//table[@id='my-quotes-table']/tbody/tr"));
        $this->assertTrue($this->isElementPresent("xpath=//table[@id='my-quotes-table']/tbody/tr/td[1]/p/img"));
        $this->assertEquals($productquotedname, $this->getText("xpath=//table[@id='my-quotes-table']/tbody/tr/td[2]/strong"));
        $this->assertEquals("Width:", $this->getText("xpath=//table[@id='my-quotes-table']/tbody/tr/td[2]/dl[1]/dt"));
        $this->assertTrue($this->isElementPresent("xpath=//table[@id='my-quotes-table']/tbody/tr/td[2]/dl[1]/dd"));
        $this->assertEquals("Drop:", $this->getText("xpath=//table[@id='my-quotes-table']/tbody/tr/td[2]/dl[2]/dt"));
        $this->assertTrue($this->isElementPresent("xpath=//table[@id='my-quotes-table']/tbody/tr/td[2]/dl[2]/dd"));
        $this->assertTrue($this->isElementPresent("xpath=//table[@id='my-quotes-table']/tbody/tr/td[3]/span[@class='price']"));
        $this->assertTrue($this->isElementPresent("xpath=//table[@id='my-quotes-table']/tbody/tr/td[@class='red']"));
        $this->assertTrue($this->isElementPresent("xpath=//table[@id='my-quotes-table']/tbody/tr/td[5]/strong/span"));
        $this->assertTrue($this->isElementPresent("xpath=//table[@id='my-quotes-table']/tbody/tr/td[@class='a-center last']/ul/li/a[@class='icon-link details-link cboxElement']"));
        $this->assertTrue($this->isElementPresent("xpath=//table[@id='my-quotes-table']/tbody/tr/td[@class='a-center last']/ul/li/a[@class='icon-link delete-link']"));
        $this->assertTrue($this->isElementPresent("xpath=//table[@id='my-quotes-table']/tbody/tr/td[@class='a-center last']/ul/li/button[@class='button-plain']"));
        $this->assertTrue($this->isTextPresent("Quote expires in 14 days"));
        sleep(1);
        $this->click("link=Remove item");
        
        $this->waitForElementPresent("css=.messages-lightbox");
        sleep(4);
        $this->assertEquals("Saved Quotes Success", $this->getText("xpath=//div[@class='messages-lightbox ']/div/h1"));
        $this->assertContains("The quote has been deleted.", $this->getText("xpath=//li[@class='success-msg']/ul/li"));
        sleep(1);
        $this->click("cboxClose");
        sleep(2);
        
        $this->assertTrue($this->isTextPresent("You have no quotes."));
        
        //Add to favourite test
        
        $this->logOut();
        $this->openAndWait("/");
        $this->mouseOver("xpath=//div[@class='nav-container']/ul/li[1]");
        $this->waitForElementPresent("class=top-menu-row shown-sub");
        $this->clickAndWait("link=Skylight Roller blinds");
        
        $productfavname = $this->getText("xpath=//ul[@class='products-grid first odd']/li[1]/a/h2");
        
        $this->click("//div[@class='category-products-inner']/ul[1]/li[1]/div/ul/li[2]/a"); //Add to Favorites
        $this->waitForElementPresent("cboxLoadedContent");
        sleep(2);
        $this->assertTrue($this->isElementPresent("xpath=//div[@class='register-form-block']"));
        $this->assertTrue($this->isElementPresent("xpath=//div[@class='login-form-block']"));
        $this->type("email","bsilwal@ibuildings.com");
        $this->type("pass","password");
        $this->click("send2");
        $this->waitForElementPresent("css=.messages-lightbox");
        sleep(2);
        $this->assertTrue($this->isTextPresent("Saved Samples Success"));
        $this->assertTrue($this->isTextPresent($productfavname." has been added to your wishlist."));
        $this->click("cboxClose");
        sleep(2);
        
        $this->assertEquals("My Wishlist", $this->getTitle());
        $this->assertFalse($this->isTextPresent("You have no items in your samples."));
        $this->assertTrue($this->isTextPresent($productfavname));
        $this->assertEquals($productfavname, $this->getText("xpath=//ul[@class='products-grid first last odd']/li/h2"));
        $this->assertTrue($this->isElementPresent("xpath=//ul[@class='products-grid first last odd']/li/a/img"));
        $this->assertTrue($this->isElementPresent("xpath=//div[@class='actions']/ul/li[1]/a[@class='sample-view-details icon-link details-link cboxElement']"));
        
        $this->click("link=View Details");
        
        $this->waitForElementPresent("cboxLoadedContent");
        $this->assertEquals($productfavname, $this->getText("xpath=//div[@class='product-name']/h1"));
        $this->click("cboxClose");
        sleep(2);
        
        $this->click("link=Add to Compare");
        
        $this->waitForElementPresent("cboxLoadedContent");
        sleep(2);
        $this->assertTrue($this->isTextPresent("Compare Success"));
        $this->assertEquals("The product ".$productfavname." has been added to comparison list.", $this->getText("xpath=//ul[@class='messages']/li/ul/li"));
        $this->click("cboxClose");
        sleep(2);
        $this->assertTrue($this->isTextPresent("You must have more than 1 item to compare"));
        $this->assertTrue($this->isTextPresent("1 Samples"));
        //Free Sample
        $this->click("xpath=(//div[@class='actions']/ul/li/button)[1]");
        
        $this->waitForElementPresent("cboxLoadedContent");
        sleep(2);
        $this->assertTrue($this->isTextPresent("Added to Basket"));
        $this->assertEquals($productfavname." was added to your shopping cart.", $this->getText("xpath=//ul[@class='messages']/li/ul/li"));
        $this->clickAndWait("xpath=//div[@id='cboxLoadedContent']/div[2]/button");
        $this->clickAndWait("link=Remove");
        $this->openAndWait("/salesquote/index/index/");
        
        //build your blind
        $this->click("xpath=//div[@class='actions']/ul/li/a[@class='button button-sml']");
        
        $this->waitForElementPresent("cboxLoadedContent");
        sleep(3);
        $this->assertTrue($this->isTextPresent("Get a Quote"));
        $this->assertTrue($this->isTextPresent("This sample is associated with multiple products. Select which product you wish to get a quote for from the options below."));
        $this->assertTrue($this->isElementPresent("css=.get-quote-buttons"));
        $this->click("cboxClose");
        sleep(2);
        
        $this->click("link=Remove item");
        
        $this->waitForElementPresent("cboxLoadedContent");
        sleep(2);
        $this->assertTrue($this->isTextPresent("Saved Samples Success"));
        $this->assertTrue($this->isTextPresent("The sample has been deleted"));
        $this->click("cboxClose");
        sleep(2);
        $this->assertTrue($this->isTextPresent("You have no items in your samples."));
        
        //Compare Samples Test
        $this->openAndWait("http://qa.hillarys.sessiondigital.com/samples/blind-samples/venetian");
        
        $productcompname = $this->getText("xpath=(//li[@class='item first']/a/h2)[1]");
        //add to compare the first product
        $this->clickAndWait("xpath=(//li[@class='item first']/div/ul/li[2]/a)[1]");
        
        $this->waitForElementPresent("cboxLoadedContent");
        sleep(2);
        $this->assertTrue($this->isTextPresent("Compare Success"));
        $this->assertTrue($this->isTextPresent("The product ".$productcompname." has been added to comparison list."));
        $this->click("cboxClose");
        sleep(2); 
        
        $this->openAndWait("/salesquote/index/index/");
        $this->assertTrue($this->isTextPresent("2 Samples"));
        $this->click("css=.button-compare-samples");
        
        $this->waitForElementPresent("cboxLoadedContent");
        sleep(2);
        
        $this->assertTrue($this->isTextPresent("Compare Samples"));
        $this->assertEquals("Item", $this->getText("xpath=//table[@id='product_comparison']/tbody/tr[@class='first odd']/th"));
        $this->assertTrue($this->isElementPresent("xpath=//table[@id='product_comparison']/tbody/tr[@class='first odd']/td[1]/a[@title='Remove']"));
        $this->assertTrue($this->isElementPresent("xpath=//table[@id='product_comparison']/tbody/tr[@class='first odd']/td[1]/a[2]/img"));
        $this->assertEquals('Order Free Sample', $this->getText("xpath=//table[@id='product_comparison']/tbody/tr[@class='first odd']/td[1]/ul/li[1]/a"));
        $this->assertEquals('Add to Favorites', $this->getText("xpath=//table[@id='product_comparison']/tbody/tr[@class='first odd']/td[1]/ul/li[2]/a"));
        $this->assertTrue($this->isElementPresent("xpath=//table[@id='product_comparison']/tbody/tr[@class='first odd']/td[2]/a[@title='Remove']"));
        $this->assertTrue($this->isElementPresent("xpath=//table[@id='product_comparison']/tbody/tr[@class='first odd']/td[2]/a[2]/img"));
        $this->assertEquals('Order Free Sample', $this->getText("xpath=//table[@id='product_comparison']/tbody/tr[@class='first odd']/td[2]/ul/li[1]/a"));
        $this->assertEquals('Add to Favorites', $this->getText("xpath=//table[@id='product_comparison']/tbody/tr[@class='first odd']/td[2]/ul/li[2]/a"));
        $this->assertTrue($this->isElementPresent("xpath=//table[@id='product_comparison']/tbody[3]/tr/td[1]/ul/li"));
        $this->assertTrue($this->isElementPresent("xpath=//table[@id='product_comparison']/tbody[3]/tr/td[2]/ul/li"));
        
        //get quick quote unit tests
        $this->click("xpath=//form/p/a");
        sleep(1);
        $this->assertTrue($this->isElementPresent("advice-required-entry-width"));
        $this->assertTrue($this->isElementPresent("advice-required-entry-drop"));
        
        $this->type("width", "-10");
        sleep(1);
        
        $this->assertTrue($this->isElementPresent("advice-validate-greater-than-zero-width"));
        
        $this->type("width", "10000");
        $this->type("drop", "10000");
        $this->click("xpath=//form/p/a");
        sleep(3);

		try{
		   	$this->assertEquals("No Price for your request", $this->getText("xpath=//tr[@class='last odd']/td[1]/ul/li/strong"));
        	} 
        catch (PHPUnit_Framework_AssertionFailedError $e){
        	array_push($this->verificationErrors, $e->toString());
        	}
        		
        
        $this->click("xpath=//table[@id='product_comparison']/tbody/tr[@class='first odd']/td[1]/a[@title='Remove']");
        sleep(5);
        $this->click("xpath=//table[@id='product_comparison']/tbody/tr/td/a[@title='Remove']");
        sleep(5);
        
        $this->logOut();
        
    }        
    
    
}
?>
