<?php 

$conn = pg_connect(getenv("DATABASE_URL"));
$result = pg_query($conn, "CREATE TABLE memory (ID SERIAL PRIMARY KEY     NOT NULL, WORD  TEXT    NOT NULL,  MEANING  TEXT    NOT NULL);");
var_dump($result);
$result = pg_insert($conn, 'memory', array('WORD' => 'RULES', 'MEANING' => 'THIS'));
var_dump($result);

