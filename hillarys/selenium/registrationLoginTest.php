<?php

require_once 'PHPUnit/Extensions/SeleniumTestCase.php';
include 'baseDef.php';

class RegistrationLoginTest extends MainTest
{
	 
	 
     public function testNewAccountCreation(){        
     	
     	$date = date("FjYgis");
	  	$email = 'bsilwal+'.$date.'@ibuildings.com';
  		$email_forgot = $email;
  	  	
   	  	$firstname = 'Binayak';
		$lastname = 'Silwal';
		$password = 'password';


        $this->openAndWait("/");
        if($this->isElementPresent("link=Log Out")){
            logOut();
        }
    
    	$this->clickAndWait("link=Log In/Register");
        $this->type("firstname",$firstname);
        
        $this->type("lastname",$lastname);
        $this->type("email_address",$email);
        $this->type("password",$password);
        $this->type("confirmation",$password);
        $this->click("class=checkbox required-entry");
        $this->clickAndWait("css=button[title='Submit']");
        
        $this->waitForElementPresent("css=div[id='cboxLoadedContent']");
        $this->assertElementPresent("css=div[id='cboxLoadedContent']");
        $this->assertEquals("Account Success", $this->getText("xpath=id('cboxLoadedContent')//h1"));
		$this->assertEquals("Thank you for registering with Web Blinds.", $this->getText("css=li[class='success-msg']>ul>li"));
 		$this->click("cboxClose");
        sleep(1);
        $this->assertEquals("Welcome Mr ".$firstname." ".$lastname, $this->getText("css=h1[class='sub-title']"));
        $this->logout();
   	  	
        $rand = rand(100,30000);
        $emailNotExist = "bsilwal+".$rand."@ibuildings.com";
        
       // $this->forgotPassword($email_forgot);
       // $this->forgotPasswordNonExistanceEmail($emailNotExist);
       
        $this->openAndWait("/");        

		echo "User Registration Successful!!";        
   		echo "\n";
    }

		 
	 //Existing User Forgot Password 
	
	public function testForgotPassword(){

		$this->openAndWait("/");
        if($this->isElementPresent("link=Log Out")){
            logOut();
        }
    
    	$this->clickAndWait("link=Log In/Register");
    	$this->clickAndWait("css=a[class='forgot-pswd']");
    	$this->assertContains("Reset Your Password",$this->getText("xpath=//div[5]/div/div[2]/div[1]/div/div[1]/h1"));
    	$this->type ("css=input[id='email_address']","bsilwal@ibuildings.com");
    	$this->click("css=div[class='buttons-set form-buttons']>button");
    	//$this->waitForElementPresent("css=div[id='cboxLoadedContent']");
    	sleep(3);
    	
    	$this->assertElementPresent("css=div[id='cboxLoadedContent']");
        $this->assertEquals("Account Success", $this->getText("xpath=id('cboxLoadedContent')//h1"));
   	
    	$this->click("xpath=id('cboxClose')");
    	
    	echo "Password Reset Successful!!";        
   		echo "\n";
    	
    }
    
    
    //Non Existing User Forgot Password 
    
    public function testForgotPasswordNonExistanceEmail(){
    
		$this->openAndWait("/");
        if($this->isElementPresent("link=Log Out")){
            logOut();
        }   
        $this->clickAndWait("link=Log In/Register");
        $this->clickAndWait("css=a[class='forgot-pswd']");
        $this->assertContains("Reset Your Password",$this->getText("xpath=//div[5]/div/div[2]/div[1]/div/div[1]/h1"));
        //$this->assertContains("Reset Your Password","css=div[class='page-title']>h1");
        $this->type("email_address","blahblah987@random.com");
        sleep(1);
        $this->click("css=div[class='buttons-set form-buttons']>button[type='submit']");
        sleep(2);
        $this->assertEquals("Account Error", $this->getText("xpath=id('cboxLoadedContent')//h1"));
        $this->click("xpath=id('cboxClose')");
        
        echo "Invalid email cant perform Password Reset!!";        
   		echo "\n";
    }
    
}

?>