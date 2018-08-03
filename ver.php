<?php 

$conn = pg_connect(getenv("DATABASE_URL"));
//$result = pg_query($conn, "CREATE TABLE memory (ID SERIAL PRIMARY KEY     NOT NULL, WORD  TEXT    NOT NULL,  MEANING  TEXT    NOT NULL);");
//var_dump($result);
//$result = pg_insert($conn, 'memory', array("WORD" => "RULES", "MEANING" => "THIS"));
 //$insert = "INSERT INTO memory (WORD, MEANING) VALUES ('asddsa', 'male')";
//$result = pg_query($conn,$insert);          
//var_dump($result);
//var_dump(pg_last_error());


$sql = "SELECT * FROM memory";
$result = pg_query($dbh, $sql);
if (!$result) {
   die("Error in SQL query: " . pg_last_error());
}

while ($row = pg_fetch_array($result)) {
    var_dump($row);
}
pg_free_result($result);

pg_close($dbh);
