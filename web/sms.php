<?php
$text = $_REQUEST['text'];
$phoneNumber = $_REQUEST['phoneNumber'];

$host = 'ec2-54-217-240-205.eu-west-1.compute.amazonaws.com'; 
$port = 5432;
$dbname = 'dcaomiqgff85af';
$user='igkvnbupupuifl';
$password='2eLlt2szzW8sUp0Tec7BWc1g7U';

// connect to the database
$db = pg_connect('host=$host port=$port dbname=$dbname user=$user password=$password');
if(!$db) {
	echo 'END Error! Please try again';
} 
// Welcome the farmer to the app 
	// get the phone number
$level = getLevel($text);
if($level == 0) {
	// Check if the farmer is registered
	$sql ='SELECT * FROM farmer_farmer WHERE phone_number = $phoneNumber';
	
	$rs = pg_query($db, $sql);
	if(!$rs) {
		echo 'CON Welcome to KEAB '.PHP_EOL.'1. Register'.PHP_EOL.'2. Exit';
	}  else {
		echo 'END You have already registered. Thanks for keeping it real';	
	}
	exit;
}
else if ($level == 1) {
	// Register The farmer
	if($text == '1') {
		echo 'CON Please enter your name#id#Location'.$phoneNumber;
	} else {
		echo 'END Goodbye';
	}
		
}
else {
	$data = explode("#", $text);
	$name = explode("*", $data[0])[1];
	$id = $data[1];
	$location = $data[2];

	//echo 'CON Test text '.$name.' '.$id.' '.$location;
	// save the details to db
	$sql = 'INSERT INTO farmer_farmer (name, location, id_number, phone_number) VALUES ('.$name.','.$location.','. $id.','. $phoneNumber.')';
	$ret = pg_query($db, $sql);
	if(!$ret){
		echo 'END '.pg_last_error($db);
	} else {
		echo 'END You have been successfully registered';
	}
}
function getLevel($text) {
	// check if text is empty
	if(empty($text)) {
		$level = 0;
	} else {
		$exploded_text = explode("*", $text);
		$level = count($exploded_text);
	}
	return $level;
}

pg_close($db);
?>