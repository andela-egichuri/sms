<?php
if (isset($_REQUEST['text'])) {
	$text = $_REQUEST['text'];
}
else {
	$text = '';
}


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
$phoneNumber = $_POST['phoneNumber'];

if($text == '') {
	// Check if the farmer is registered
	$sql ='SELECT * FROM farmer_farmer WHERE phone_number = $phoneNumber';
	
	$rs = pg_query($db, $sql);
	if(!$rs) {
		$reply = 'CON Welcome to KEAB \n';
		$reply = '1. Register \n';
		$reply = '2. Exit';
	}  else {
		$reply = 'END You have already registered. Thanks for keeping it';
	}
	

	//$reply = 'Welcome to farmer-sb'
}
else if ($text == '1') {
	// Register The farmer
	$reply = 'Please enter your name#id#Location:';
	$data = explode("#", $reply);
	$name = $data[0];
	$id = $data[1];
	$location = $data[2];

	// save the details to db
	$sql = 'INSERT INTO farmer_farmer (name, location, id_number, phone_number)
			VALUES ($name, $location, $id, $phoneNumber)';
	$ret = pg_query($db, $sql);
	if(!$ret){
		$reply = 'END Error! Please try again';
	} else {
		$reply = 'END You have been successfully registered';
	}
}
else if ($text == '2') {
	$reply == 'END Goodbye';
}

echo $reply;
pg_close($db);
?>