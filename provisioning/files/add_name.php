
<?php


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
        $db = null;
        return "New record created successfully for $Sirname $Name ";
        }   

    catch (PDOException $e) {
          print "Error!: " . $e->getMessage() . "<br/>";
          die();
      }




  

}
?>

