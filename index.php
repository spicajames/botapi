<?php 
//$redis = new Predis\Client(getenv('REDIS_URL'));

$my_file = 'file.txt';
$handle = fopen($my_file, 'w') or die('Cannot open file:  '.$my_file);
$data['prueba'] = 'ajaja';
//$data = 'This is the data';
fwrite($handle, json_encode($data));

$my_file = 'file.txt';
$handle = fopen($my_file, 'r');
$dataIn = fread($handle,filesize($my_file));

var_dump(json_decode($dataIn));

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
