<?php 
header('Content-type: application/json');
$data = json_decode(file_get_contents("php://input"));
$intent = $data->queryResult->intent->displayName;
if($intent == "get"){
  $key = str_replace("'","''", $data->queryResult->parameters->any);
  
  if(strtolower($key) == "list"){
    $conn = pg_connect(getenv("DATABASE_URL"));
    $sql = "SELECT * FROM memory";
    $result = pg_query($conn, $sql);
    $outcome = "List:\n";
    while ($row = pg_fetch_array($result)) {
     $outcome .= addslashes($row['word'])."->".addslashes($row['meaning']).'\n';     
    }
    
    echo "{'fulfillmentText': '$outcome'}";
    
  }else{
  
    $conn = pg_connect(getenv("DATABASE_URL"));
    $select = "SELECT * FROM memory WHERE WORD = '$key'";
    $resultS = pg_query($conn,$select);
    $found = false;
    while ($row = pg_fetch_array($resultS)) {
      $found = $row['meaning'];
    }
    if($found == false){
      echo "{'fulfillmentText': 'No idea what is that'}";
    }else{
      $found = addslashes($found);
      echo "{'fulfillmentText': '$found'}";
    }  
  }
  
} else if($intent == "post"){  
  $key = str_replace("'","''", $data->queryResult->parameters->key);
  $val =  str_replace("'","''", $data->queryResult->parameters->any);
  
  if($key != "" && $val != ""){
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
