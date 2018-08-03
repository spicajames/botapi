<?php 
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
 
  $conn = pg_connect(getenv("DATABASE_URL"));
  $insert = "INSERT INTO memory (WORD, MEANING) VALUES ($key, $val)";
  $result = pg_query($conn,$insert); 
  
  echo "{'fulfillmentText': 'Got it!'}";
} else{
  echo "{'fulfillmentText': 'I have no idea what your asking for'}";
}
