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
loadAllPeople();
function loadAllPeople(){
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
      $db = null;
  } 
  } catch (PDOException $e) {
      print "Error!: " . $e->getMessage() . "<br/>";
      die();
  }



}






?>
  </tr>
</table>




<form action="#" method="post">
<fieldset>
<legend>Add a name to the database</legend>


<?php
 $FirstName = $LastName = "";
?>
<label for="FirstName">First Name:</label> <br>
<input type="text" id="FirstName" name="FirstName" placeholder="First name" required>
<br>

<label for="LastName">Last Name:</label> <br>
<input type="text" name="LastName" id="LastName" placeholder="Last name" required> <br>

<input type="submit" value="Add to database">
</fieldset>
</form>

<?php #Script for processing form
process_form();

function process_form()
{
  if ($_SERVER["REQUEST_METHOD"] === "POST"){ 
    $Sirname = $_POST["FirstName"];
    $Name= $_POST["LastName"];

   
    try {
        $user = "php";
        $password = "phptest";
        $database = "data";
        $table = "people";
        $db = new PDO("mysql:host=localhost;dbname=$database", $user, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO $table (LastName, FirstName) VALUES ('$Name', '$Sirname')";
        $db->exec($sql);
        echo "New record created successfully";
        header("Refresh:0");
        $db = null;
        }   

    catch (PDOException $e) {
          print "Error!: " . $e->getMessage() . "<br/>";
          die();
      }
}
}
?>




</body>
</html>