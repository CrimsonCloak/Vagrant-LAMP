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
<label for="FirstName">First name:</label> <br>
<input type="text" id="FirstName" name="FirstName" placeholder="First name" required>
<br>

<label for="LastName">Last name:</label> <br>
<input type="text" name="LastName" id="LastName" placeholder="Last name" required> <br>

<label for="add">Add user</label>
<input type="radio" name="selection" id="add" value="add" checked>

<label for="delete">Delete user</label>
<input type="radio" name="selection" id="delete" value="delete">

<input type="submit" value="Send request">

</fieldset>
</form>


<!-- Form for update -->
<form action="#" method="post" id="grid-item-form-update">
<fieldset>
<legend>Update a user in the database</legend>


<?php
 $FirstNameOld = $LastNameOld = $FirstNameNew = $LastNameNew = "";
?>
<label for="FirstNameOld">First name old user:</label> <br>
<input type="text" id="FirstNameOld" name="FirstNameOld" placeholder="First name old user" required>
<br>

<label for="LastNameOld">Last name old user:</label> <br>
<input type="text" name="LastNameOld" id="LastNameOld" placeholder="Last name old user" required> <br>

<label for="FirstNameNew">First name new user:</label> <br>
<input type="text" id="FirstNameNew" name="FirstNameNew" placeholder="First name new user" required>
<br>

<label for="LastNameNew">Last name new user:</label> <br>
<input type="text" name="LastNameNew" id="LastNameNew" placeholder="Last name new user" required> <br>

<label for="Update">Change user</label>
<input type="checkbox" name="update" id="update" required> <br>

<input type="submit" value="Request update">

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

    // Process add request
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


    // Process delete request

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

    // Process update request
    if ($_SERVER["REQUEST_METHOD"] === "POST" && $_POST["update"] === "on")
    {
      {
        $SirnameOld = $_POST["FirstNameOld"];
        $NameOld= $_POST["LastNameOld"];  
        $SirnameNew = $_POST["FirstNameNew"];
        $NameNew = $_POST["LastNameNew"];
        try {
          $user = "php";
          $password = "phptest";
          $database = "data";
          $table = "people";
          $db = new PDO("mysql:host=localhost;dbname=$database", $user, $password);
          $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $sql = "UPDATE $table SET LastName ='$NameNew' , FirstName ='$SirnameNew' WHERE LastName LIKE '$NameOld' AND FirstName LIKE '$SirnameOld' ";
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



}

?>




</body>
</html>