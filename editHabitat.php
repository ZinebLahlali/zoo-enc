<?php 
include "./dbconnect.php";
 $Id_h = "";
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
    echo "id". $Id_h;


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


    $query_delete = "DELETE FROM habitas WHERE Id_h= ".$delete_id;
    if (mysqli_query($conn, $query_delete)) {

        header("Location: habitat.php?success=1");
        exit;

    } else {

        echo "Error: " . mysqli_error($conn);
    }
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


                                <div class="bg-white p-6 rounded-xl w-full max-w-md shadow-xl">

                        
                            <form  action="habitat.php" method="POST" class="flex flex-col gap-3 ">
                                <legend class="text-lg font-semibold mb-2">Habitat Information</legend>

                                <label for="name">Name of habitat:</label>
                                <input type="text" id="name" name="name" value="<?php echo $name; ?>" 
                                    class="border rounded px-3 py-2" />

                                <label for="descreption">Descreption:</label>
                                <textarea type="text" id="descreption" name="descreption" value="<?php echo $descreption; ?>" 
                                    class="border rounded px-3 py-2" ></textarea>
                                 <label for="image">Enter the URL:</label>
                                 <input type="url" id="image" name="image" value="<?php echo $image; ?>"  class="border rounded px-3 py-2" />
                       
                                    

                                <div class="flex gap-4 ">
                                    <input type="submit"
                                        name="submit" value="Submit"
                                    class="mt-3 bg-green-500 text-white px-4 py-2 rounded cursor-pointer w-full" />
                                <button type="button"  id="habitatCancel" class=" bg-orange-300 rounded cursor-pointer text-white px-4 py-2 justify-end items-end w-full ">Cancel</button>    
                                </div>  
                            </form>
                        </div>

</body>
</html>




