<?php 
//$redis = new Predis\Client(getenv('REDIS_URL'));
$my_file = 'file.txt';
$handle = fopen($my_file, 'w') or die('Cannot open file:  '.$my_file); //implicitly creates file
header('Content-type: application/json');
$data = json_decode(file_get_contents("php://input"));
$intent = $data->queryResult->intent->displayName;
if($intent == "get"){
  $key = $data->queryResult->parameters->any;
  echo "{'fulfillmentText': 'You asked for $key'}";
} else if($intent == "post"){
  echo "{'fulfillmentText': 'Got it!'}";
} else{
  echo "{'fulfillmentText': 'I have no idea what your asking for'}";
}
