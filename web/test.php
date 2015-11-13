<?php
$host = 'ec2-54-217-240-205.eu-west-1.compute.amazonaws.com'; 
$port = '5432';
$dbname = 'dcaomiqgff85af';
$credentials = 'user=igkvnbupupuifl password=2eLlt2szzW8sUp0Tec7BWc1g7U';

// connect to the database
$db = pg_connect('$host $port $dbname $credentials');
if(!db) {
	echo 'Error: Connection failed!';
} else {
	echo "Opened database successfuly";
}
// Welcome the farmer to the app 
	// get the phone number

// Reads the variables sent via POST from our gateway
$sessionId   = $_POST["sessionId"];
$serviceCode = $_POST["serviceCode"];
$phoneNumber = $_POST["phoneNumber"];
$text        = $_POST["text"];

if ( $text == "" ) {

	 // This is the first request. Note how we start the response with CON
	 $response  = "CON What would you want to check \n";
	 $response .= "1. My Account \n";
	 $response .= "2. My phone number".$phoneNumber;

}

else if ( $text == "1" ) {
  // Business logic for first level response
  $response = "CON Choose account information you want to view \n";
  $response .= "1. Account number \n";
  $response .= "2. Account balance";
  
 }
 
 else if($text == "2") {
 
  // Business logic for first level response
  $phoneNumber  = "+254711XXXYYY";
  // This is a terminal request. Note how we start the response with END
  $response = "END Your phone number is $phoneNumber";
 }
 
 else if($text == "1*1") {
 
  // This is a second level response where the user selected 1 in the first instance
  $accountNumber  = "ACC1001";
  // This is a terminal request. Note how we start the response with END
  $response = "END Your account number is $accountNumber";
 }
	
 else if ( $text == "1*2" ) {
  
	 // This is a second level response where the user selected 1 in the first instance
	 $balance  = "KES 1,000";
	 // This is a terminal request. Note how we start the response with END
	 $response = "END Your balance is $balance";

}

// Print the response onto the page so that our gateway can read it
header('Content-type: text/plain');
echo $response;
