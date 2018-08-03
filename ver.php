<?php 
$my_file = 'file.txt';
$handle = fopen($my_file, 'r');
$dataIn = fread($handle,filesize($my_file));
var_dump(json_decode($dataIn));
