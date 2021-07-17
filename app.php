<?php
// error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
// ini_set('display_errors', 1);

require 'vendor/autoload.php';
use zcrmsdk\crm\setup\restclient\ZCRMRestClient;

class RestClient {
  public function __construct() {
    $configuration = array(
      "client_id"              => "",
      "client_secret"          => "",
      "redirect_uri"           => "http://something.com/wp-content/plugins/wp-zoho-crm/app.php",
      "currentUserEmail"       => "email@email.com",
      "token_persistence_path" => '/mnt/path_to_token/web/content/test',
    );
    ZCRMRestClient::initialize($configuration);
  }

  public function create($data) {
    //error_log('*********************');
    //error_log(print_r($data));
    /*$oAuthClient = ZohoOAuth::getClientInstance();
    $grantToken = "";
    $oAuthTokens = $oAuthClient->generateAccessToken($grantToken);
    var_dump($oAuthTokens);*/
    if ($data['formid'] == 27878 || $data['formid'] == 26720 || $data['formid'] == 26716 || $data['formid'] == 25411 || $data['formid'] == 32395) {
      $firstName           = $data['first_name'];
      $lastName            = $data['last_name'];
      $companyName         = $data['company_name'];
      $email               = $data['email'];
      $phone               = $data['phone'];
      $country             = $data['country'];
      $lead_url            = $data['lead_url'];
      $leadSource          = $data['lead_source'];
      $description         = $data['description'];
      $interestedIn        = $data['interested_in'];
      $industry            = $data['industry'];
      $gaTrafficSourceData = $data['ga_traffic_source_data'];

      $records = array();
      $record  = ZCRMRestClient::getInstance()->getRecordInstance("Leads", NULL);
      $record->setFieldValue("First_Name", $firstName);
      $record->setFieldValue("Last_Name", $lastName);
      $record->setFieldValue("Company", $companyName);
      $record->setFieldValue("Email", $email);
      $record->setFieldValue("Phone", $phone);
      $record->setFieldValue("Country", $country);
      $record->setFieldValue("Description", $description);
      $record->setFieldValue("Lead_URL", $lead_url);
      $record->setFieldValue("Lead_Source", $leadSource);
      $record->setFieldValue("Industry", $industry);
      $record->setFieldValue("System_Usage", [$interestedIn]);
      $record->setFieldValue("GA_Traffic_Source_Data", [$gaTrafficSourceData]);
      //$record->setFieldValue("roundrobinleadassignment0__Assign_Using_Active_Assignment_Rule", true);

      $moduleIns = ZCRMRestClient::getInstance()->getModuleInstance("Leads"); // to get the instance of the module

      array_push($records, $record); //pushing the record to the array
      $responseIn = $moduleIns->createRecords($records); //updating the records
    }

    if ($data['formid'] == 27877) {
      $lastName            = $data['last_name'];
      $companyName         = $data['company_name'];
      $email               = $data['email'];
      $phone               = $data['phone'];
      $country             = $data['country'];
      $lead_url            = $data['lead_url'];
      $leadSource          = $data['lead_source'];
      $description         = $data['description'];
      $gaTrafficSourceData = $data['ga_traffic_source_data'];

      $records = array();
      $record  = ZCRMRestClient::getInstance()->getRecordInstance("Leads", NULL);
      $record->setFieldValue("Last_Name", $lastName);
      $record->setFieldValue("Company", $companyName);
      $record->setFieldValue("Email", $email);
      $record->setFieldValue("Phone", $phone);
      $record->setFieldValue("Country", $country);
      $record->setFieldValue("Description", $description);
      $record->setFieldValue("Lead_URL", $lead_url);
      $record->setFieldValue("Lead_Source", $leadSource);
      $record->setFieldValue("GA_Traffic_Source_Data", [$gaTrafficSourceData]);
      //$record->setFieldValue("roundrobinleadassignment0__Assign_Using_Active_Assignment_Rule", true);

      $moduleIns = ZCRMRestClient::getInstance()->getModuleInstance("Leads"); // to get the instance of the module

      array_push($records, $record); //pushing the record to the array
      $responseIn = $moduleIns->createRecords($records); //updating the records
    }

    //  foreach($responseIn->getEntityResponses() as $responseIns){
    //     echo "HTTP Status Code:".$responseIn->getHttpStatusCode();  //To get http response code
    //     echo "Status:".$responseIns->getStatus();  //To get response status
    //     echo "Message:".$responseIns->getMessage();  //To get response message
    //     echo "Code:".$responseIns->getCode();  //To get status code
    //     echo "Details:".json_encode($responseIns->getDetails());
    // }
  }
}