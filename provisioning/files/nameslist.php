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
    <th>Name</th>
  </tr>
<?php
echo "<h2>Employees</h2>";
$user = "php";
$password = "phptest";
$database = "data";
$table = "people";

try {
  $db = new PDO("mysql:host=localhost;dbname=$database", $user, $password);

  $data = $db->query("SELECT FirstName, LastName FROM $table")->fetchAll();
  foreach ($data as $row) {
    echo "<tr> <td>";
    echo $row['FirstName'] . "<br>";
    echo $row['LastName']. "<br>";
    echo "</td> </tr>";
} 
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}



$db = null;
?>
  </tr>
</table>


<!-- 
<form action="#" method="post">

<?php
 $FirstName = $LastName = $message = "";
?>
<label for="Name">Name:</label> <br>
<input type="text" id="Name" name="Name" required>
<br>

<label for="Email">Email address:</label> <br>
<input type="text" name="Email" id="Email" required> <br>

<label for="Updates">I would like to receive updates and news related to my PHP skills.</label> <br>
<input type="checkbox" name="Updates" id="Updates"><br>

<input type="submit" value="Send">
</form>

<?php
require 'contact_form.php';
?> -->




</body>
</html>