<?php 
include "./dbconnect.php";

 $name = "";
 $descreption = "";
 $image ="";
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $descreption = $_POST['descreption'];
    $image = $_POST['image'];

    $sql = "INSERT INTO animals (`name`, descreption, `image`)
            VALUES ('$name', '$descreption' , '$image')";

    if (mysqli_query($conn, $sql)) {

        header("Location: habitat.php?success=1");
        exit;

    } else {

        echo "Error: " . mysqli_error($conn);
    }
}
if(isset($_GET['submit'])) {
    $Id_h= $_GET['id'];
    $name  = $_GET['name'];
   $descreption = $_GET['descreption'];
    $image = $_GET['image'];

    $sql = "UPDATE animals  SET name= '$name', descreption='$descreption' , image= '$image' WHERE Id_h= ".$Id_h;
           

    if (mysqli_query($conn, $sql)) {

        header("Location: habitat.php?success=1");
        exit;

    } else {

        echo "Error: " . mysqli_error($conn);
    }
}
if(isset($_GET["delete"])){
    $delete_id = $_GET["delete"];
    $query_delete = "DELETE FROM habitat WHERE id= ".$delete_id;
    if (mysqli_query($conn, $query_delete)) {

        header("Location: habitat.php?success=1");
        exit;

    } else {

        echo "Error: " . mysqli_error($conn);
    }
}


?>




