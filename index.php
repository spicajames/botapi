<?php 
$key = $_POST['any'];
header('Content-type: application/json');
?>
{
  "fulfillmentText": "You asked for <?php echo $key; ?>" 
}
