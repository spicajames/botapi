<?php 
header('Content-type: application/json');
if($json = json_decode(file_get_contents("php://input"), true)) {
     $data = $json;
} else {
     $data = $_POST;
}
$intent = $data->queryResult->intent->displayName;
if($intent == "get"){
  $key = $data->queryResult->parameters->any;
  echo "{'fulfillmentText': 'You asked for $key'}";
} else if($intent == "post"){
  echo "{'fulfillmentText': 'Got it!'}";
} else{
  echo "{'fulfillmentText': 'I have no idea what your asking for'}";
}
