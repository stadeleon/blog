<?php

class SoapController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
    }

    public function wsdlAction()
    {
        // action body
    }


    public function formSoapAction(){
        //set another layout

        $this->_helper->layout->setLayout('soapLayout');

        /* $options = array(
             'soap_version'=>SOAP_1_1,
             //'charset'=>utf-8
         );*/

        /*  $q = 'POST /soap HTTP/1.1
              Host: localhost
              Connection: Keep-Alive
              User-Agent: PHP-SOAP/5.3.1
              Content-Type: application/soap+xml; charset=utf-8
              Content-Length: 471

              <?xml version="1.0" encoding="UTF-8"?>
              <env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope"
               xmlns:ns1="http://example.localhost/index/soap"
               xmlns:xsd="http://www.w3.org/2001/XMLSchema"
               xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
               xmlns:enc="http://www.w3.org/2003/05/soap-encoding">
              <env:Body>
              <ns1:getBookmark env:encodingStyle="http://www.w3.org/2003/05/soap-encoding">
              <param0 xsi:type="xsd:int">4682</param0>
              </ns1:getBookmark>
              </env:Body>
              </env:Envelope>';*/

        $query = array(
            "DOTNumber" => "123456",
            "UserName" => "USERNAME",
            "Password" => "PASSWORD",
            "DlNum" => "License88322",
            "DlLastName" => "LastName101594",
            "DlState" => "OH",
            "DriverDOB" => "7-sep-1973",
            "MotorCarrierId" => "1234",
            "InternalRefId" => "Internal Reference",
            "DriverConsent" => "true",
            "DriverLastName" => "LastName101594",
            "DriverFirstName" => "R Reed"
        );
        $header = new SoapHeader('Content-Type:text/soap+xml', true);
//        $header = "Content-Type: text/html; charset=utf-8";

        $client = new Zend_Soap_Client('https://psp-stage.cdc.nicusa.com/Dot.Psp.Web.ServiceWeb/ServiceWeb.wsdl');
        //$client ->setEncoding("UTF-8");
        $client ->setSoapVersion(SOAP_1_2);
        $client->addSoapInputHeader($header);
        //var_dump ($client) ;
        $client->GetDriverData($query);

        var_dump($client->getLastRequestHeaders());



        //show sending form
        //including jquery script
        //$this->view->headScript()->appendFile('/js/index/soap.js', 'text/javascript');
    }
}

