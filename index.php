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
  
  if($key != ""){
    $conn = pg_connect(getenv("DATABASE_URL"));
    $select = "SELECT * FROM memory WHERE WORD = '$key'";
    $resultS = pg_query($conn,$select);
    $found = false;
    while ($row = pg_fetch_array($resultS)) {
      $found = $row['meaning'];
    }
    if($found == false){
      $sql = "INSERT INTO memory (WORD, MEANING) VALUES ('$key', '$val')";
      $res = "now I know";
    }else{
       $sql = "UPDATE memory SET MEANING = '$val' WHERE WORD = '$key'";    
      $res = "I will remember your change";
    }

   $result = pg_query($conn,$sql); 
   pg_free_result($result);
   pg_close($conn);
    echo "{'fulfillmentText': 'Got it! $res'}";
  }else{
    echo "{'fulfillmentText': 'Something went wrong, I didn't got that!'}";
  }
} else{
  echo "{'fulfillmentText': 'I have no idea what your asking for'}";
}
