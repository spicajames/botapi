<?php 
$request = file_get_contents('php://input');
var_dump($request);
$key = $_POST['any'];
$json = json_decode($key);
header('Content-type: application/json');
?>
{
  "fulfillmentText": "You asked for <?php echo $key; ?>" 
}
