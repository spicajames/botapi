<?php 
$request = file_get_contents('php://input');
$json = json_decode($request);
$key = $json->queryResult->parameters->any;
header('Content-type: application/json');
?>
{
  "fulfillmentText": "You asked for <?php echo $key; ?>" 
}
