<?php 

$conn = pg_connect(getenv("DATABASE_URL"));
$result = pg_query($conn, "CREATE TABLE memory (ID SERIAL INT PRIMARY KEY     NOT NULL, WORD  TEXT    NOT NULL,  MEANING  TEXT    NOT NULL);");
$result = pg_insert($conn, 'memory', array('WORD' => 'RULES', 'MEANING' => 'THIS'));

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
