<?php
error_reporting(E_ALL); 
ini_set('log_errors','1'); 
ini_set('display_errors','1'); 
$header = array(
	"Content-type:application/json"
);         
$ch = curl_init();
$fields = array(
	'auth_token' => "ghshr4fg4qr5r5y5h5rf1y4r62da1a8e0cf2t",
	"clientID" => "1542635248974",
    "employee_uniqid"=>"kandd-empl15tm"
    
);                   
//echo json_encode($fields);
$field_data = http_build_query($fields); 
$url = 'http://www.cloudcrow.in/kandd/apis/v1/offline/employee/dealer';
curl_setopt_array($ch, array( 
	CURLOPT_URL => $url,    
	CURLOPT_HTTPHEADER => $header,
	CURLOPT_POST => TRUE,
	// CURLOPT_CUSTOMREQUEST=>"PUT",
	CURLOPT_POSTFIELDS=>json_encode($fields),
	CURLOPT_RETURNTRANSFER => TRUE
));   
echo $output = curl_exec($ch);
curl_close($ch);
  
?>

