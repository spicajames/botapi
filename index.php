<?php 
var_dump($_POST);
$key = $_POST['any'];
$json = json_decode($key);
header('Content-type: application/json');
?>
{
  "fulfillmentText": "You asked for <?php echo $key; ?>" 
}
