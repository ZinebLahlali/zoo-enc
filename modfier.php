
<?php 

include "./dbconnect.php";

$id = "";
$name = "";
 $type_alimentaire = "";
 $image ="";
 $errorMessage = "";
 $successMessage ="";
 if($_SERVER['REQUEST_METHOD'] == 'GET'){
          if(!isset($_GET["id"])){

          header("Location: animals.php");
        exit;

    } 
    $id = $_GET["id"];
    $sql = "SELECT * FROM animals WHERE id = $id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
   if (!$row){
    header("location: animals.php");
    exit;
   }

    $name  = $row['name'];
    $type_alimentaire  = $row['type_alimentaire'];
    $image = $row['image'];

    
}else {

    $id = $_POST["id"]
    $name  = $_POST['name'];
    $type_alimentaire  = $_POST['type_alimentaire'];
    $image = $_POST['image'];
     
    do{
        if(empty($id) || empty($name) || empty( $type_alimentaire) || empty($image) ){
           $errorMessage = "All the fields are required";
           break;  
        }
        $sql = "UPDATE animals".
         "SET name = '$name', '$type_alimentaire ', "

    } while(true)





    }
    
 

?>


<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>Zoo Kids — Cartoon UI</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
  
    :root {
        --card: #fff8f2;
        --accent: #ffb86b
    }

    body {
        font-family: Inter, ui-sans-serif, system-ui, -apple-system, 'Segoe UI', Roboto, 'Helvetica Neue', Arial
    }

    .cartoon-shadow {
        box-shadow: 0 10px 0 rgba(0, 0, 0, 0.06), 0 30px 60px rgba(255, 184, 107, 0.06)
    }

    .rounded-blobby {
        border-radius: 18px 40px 18px 40px
    }

    .kid-font {
        letter-spacing: 0.2px
    }

 
    @media (max-width:640px) {
        .sidebar {
            display: none
        }
    }
    </style>
</head>
<body>

<div>
    <form  action="animals.php" method="POST" class="flex flex-col gap-3 ">
        <input type="hidden" value="<?php echo $id; ?>">
            <legend class="text-lg font-semibold mb-2">Animal Information</legend>

            <label for="name">Name of animal:</label>
            <input type="text" id="name" name="name" value="<?php echo $name; ?>" 
                   class="border rounded px-3 py-2" />

            <label for="type_alimentaire">Type food:</label>
            <select type="text" id="type_alimentaire" name="type_alimentaire" value="<?php echo $type_alimentaire; ?>"
                   class="border rounded px-3 py-2" >
                   <option value="Carnivore">Carnivore</option>
                    <option value="Herbivore">Herbivore</option>
                     <option value="Omnivore">Omnivore</option>
                </select>

            <label for="image">Enter the URL:</label>
            <input type="url" id="image" name="image" value="<?php echo $image; ?>" 
                   class="border rounded px-3 py-2" />
                   

            <div class="flex gap-4 ">
                <input type="submit"
                    name="submit" value="Submit"
                   class="mt-3 bg-green-500 text-white px-4 py-2 rounded cursor-pointer w-full" />
             <button type="button" class=" cancel bg-orange-300 rounded cursor-pointer text-white px-4 py-2 justify-end items-end w-full ">Cancel</button>    
            </div>  
        </form>
</div>

</body>
</html>