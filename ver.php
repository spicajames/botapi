<?php 

$conn = pg_connect(getenv("DATABASE_URL"));
$result = pg_query($conn, "CREATE TABLE memory (ID INT PRIMARY KEY     NOT NULL, WORD  TEXT    NOT NULL,  MEANING  TEXT    NOT NULL);");
var_dump(($result));

$my_file = 'file.txt';
$handle = fopen($my_file, 'r');
$dataIn = fread($handle,filesize($my_file));
var_dump(($dataIn));

$dataIn = array();
$key = "bike";
$val= "awsom";
$data[$key] = $val;
var_dump($data);
$data = array_merge ($dataIn,$data);

var_dump($data);
