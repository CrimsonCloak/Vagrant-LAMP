<?php
$user = "php";
$password = "phptest";
$database = "data";
$table = "people";

try {
  $db = new PDO("mysql:host=localhost;dbname=$database", $user, $password);
  echo "<h2>People</h2> <br />\n"; 

  $data = $db->query("SELECT * FROM $table")->fetchAll();
  foreach ($data as $row) {
    echo $row['FirstName']."<br />\n";
}
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}
$db = null;
?>