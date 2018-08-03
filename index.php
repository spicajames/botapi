<?php 
//$redis = new Predis\Client(getenv('REDIS_URL'));

$my_file = 'file.txt';
$handle = fopen($my_file, 'r');
$dataIn = fread($handle,filesize($my_file));
fclose($handle);

//var_dump(json_decode($dataIn));

header('Content-type: application/json');
$data = json_decode(file_get_contents("php://input"));
$intent = $data->queryResult->intent->displayName;
if($intent == "get"){
  $key = $data->queryResult->parameters->any;
  $val = $dataIn[$key];
  echo "{'fulfillmentText': '$val'}";
} else if($intent == "post"){
  $key = $data->queryResult->parameters->key;
  $val = $data->queryResult->parameters->any;
  
  $data[$key] = $val;

  $data = array_merge ($dataIn,$data);
  
 $my_file = 'file.txt';
 $handle = fopen($my_file, 'w') or die('Cannot open file:  '.$my_file);

 fwrite($handle, json_encode($data));
  fclose($handle);
  
  echo "{'fulfillmentText': 'Got it!'}";
} else{
  echo "{'fulfillmentText': 'I have no idea what your asking for'}";
}
