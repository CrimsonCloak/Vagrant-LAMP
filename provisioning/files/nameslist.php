<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Name list</title>
  <p><a href="index.html">Return to landing page</a></p>
</head>
<body>
<style><?php include 'styles.css'; ?></style>
<table>
  <tr>
    <th>First name</th>
  </tr>
<?php
echo "<h2>Employees</h2>";
$user = "php";
$password = "phptest";
$database = "data";
$table = "people";

try {
  $db = new PDO("mysql:host=localhost;dbname=$database", $user, $password);

  $data = $db->query("SELECT FirstName FROM $table")->fetchAll();
  foreach ($data as $row) {
    echo "<tr> <td>";
    echo $row['FirstName'] . "<br>";
    echo "</td> </tr>";
} 
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}



$db = null;
?>
  


    <!-- <td>Alfreds Futterkiste</td>
    <td>Maria Anders</td>
    <td>Germany</td> -->
  </tr>
</table>




</body>
</html>