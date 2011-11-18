<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


require_once 'baseDef.php';
require_once 'placeOrderTest.php';


class buyingProductAsAGuestCustomer extends MainTest
{
	
        
     public function testbuyAProduct()
     {
            $this->open("/");
            $orderObject = new placeOrderTest($this);
            $options = "";
           
            try
            {
                $orderObject->addingItemToBasket();
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
     
     }
}
