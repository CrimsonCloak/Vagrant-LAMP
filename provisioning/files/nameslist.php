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

<div id="grid-container">
<form action="#" method="post" id="grid-item-form">
<fieldset>
<legend>Add or delete user from database</legend>


<?php
 $FirstName = $LastName = "";
?>
<label for="FirstName">First Name:</label> <br>
<input type="text" id="FirstName" name="FirstName" placeholder="First name" required>
<br>

<label for="LastName">Last Name:</label> <br>
<input type="text" name="LastName" id="LastName" placeholder="Last name" required> <br>

<label for="add">Add user</label>
<input type="radio" name="selection" id="add" value="add" checked>

<label for="delete">Delete user</label>
<input type="radio" name="selection" id="delete" value="delete">

<input type="submit" value="Send request">

</fieldset>
</form>




<table id="grid-item-table">
  <tr>
    <th>Name of employees</th>
  </tr>
<?php
#echo "<h2>Employees</h2>";
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

</div>



<?php #Script for processing form
process_form();

function process_form()
{
  if ($_SERVER["REQUEST_METHOD"] === "POST" && $_POST["selection"] === "add"){
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
        header("Refresh:0");
        $db = null;
        }   

    catch (PDOException $e) {
          print "Error!: " . $e->getMessage() . "<br/>";
          die();
      }
    }

  if ($_SERVER["REQUEST_METHOD"] === "POST" && $_POST["selection"] === "delete")
    {
      $Sirname = $_POST["FirstName"];
      $Name= $_POST["LastName"];  
      try {
        $user = "php";
        $password = "phptest";
        $database = "data";
        $table = "people";
        $db = new PDO("mysql:host=localhost;dbname=$database", $user, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "DELETE FROM $table WHERE LastName ='$Name' AND FirstName ='$Sirname'";
        $db->exec($sql);
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