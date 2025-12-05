<?php 
   include "./dbconnect.php";
   
  $name = "";
 $descreption = "";
 $image = "";
if (isset($_POST['submit'])) {

    $name  = $_POST['name'];
    $descreption  = $_POST['descreption'];
    $image = $_POST['image'];
  

    $sql = "INSERT INTO habitas (name, descreption, image)
        VALUES ('$name', '$descreption', '$image')";


    if (mysqli_query($conn, $sql)) {

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
    /* Cartoon-ish touches */
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

    /* small responsive tweaks */
    @media (max-width:640px) {
        .sidebar {
            display: none
        }
    }
    </style>
</head>

<body class="bg-gradient-to-b from-yellow-50 to-white min-h-screen">

    <div class="max-w-7xl mx-auto px-4 py-6">
        <div class="flex gap-6">

            <!-- SIDEBAR -->
            <aside class="sidebar w-64 bg-white rounded-blobby p-4 cartoon-shadow border border-yellow-100">
                <div class="flex items-center gap-3 mb-6">
                    <!-- logo icon -->
                    <div class="w-12 h-12 bg-yellow-200 rounded-full flex items-center justify-center">
                        <!-- paw icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-yellow-800" viewBox="0 0 24 24"
                            fill="currentColor">
                            <path
                                d="M7.5 8.5C7.5 6.29 5.71 4.5 3.5 4.5S-0.5 6.29 -0.5 8.5 1.29 12.5 3.5 12.5 7.5 10.71 7.5 8.5z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-bold text-lg kid-font">Zoo Kids</h3>
                        <p class="text-xs text-yellow-600">Interface pour enfants</p>
                    </div>
                </div>

                <nav class="space-y-1">
                    <button data-tab="dashboard"
                        class="w-full text-left px-3 py-2 rounded flex items-center gap-3 hover:bg-yellow-50 active:bg-yellow-100"
                        aria-current="true">
                        <!-- home icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-yellow-600" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor">
                            <path d="M3 9.5L12 3l9 6.5V20a1 1 0 0 1-1 1h-5v-6H9v6H4a1 1 0 0 1-1-1V9.5z"
                                stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <a href="index.php" class="font-medium">Dashboard</a>
                    </button>
            
                    <button data-tab="animals"
                        class="w-full text-left px-3 py-2 rounded flex items-center gap-3 hover:bg-yellow-50">
                        <!-- paw icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-yellow-600" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor">
                            <path d="M4.5 11.5c0 3 3 6 7.5 6s7.5-3 7.5-6V9c0-3-3-6-7.5-6S4.5 6 4.5 9v2.5z"
                                stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                         <a  href="animals.php" class="font-medium">Animals</a>
                    </button>

                    <button data-tab="zones"
                        class="w-full text-left px-3 py-2 rounded flex items-center gap-3 hover:bg-yellow-50">
                        <!-- map icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-yellow-600" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor">
                            <path d="M20 6l-5 2-5-2-5 2v10l5-2 5 2 5-2V6z" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                        <span class="font-medium">Habitat</span>
                    </button>

                    <div class="mt-6 px-3 py-2 text-xs text-gray-500">Tools</div>
                    <button id="btn-add-top"
                        class="w-full text-left px-3 py-2 rounded flex items-center gap-3 hover:bg-yellow-50">
                        <!-- plus icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-green-600" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor">
                            <path d="M12 5v14M5 12h14" stroke-width="1.8" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                        <span class="font-medium">Add New</span>
                    </button>
                </nav>
            </aside>


            <!-- MAIN -->
            <main class="flex-1">
                <!-- header -->
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-2xl font-extrabold">Welcome to Zoo Kids</h2>
                    <div class="flex items-center gap-3">
                        <div class="bg-white px-3 py-2 rounded-lg shadow-sm flex items-center gap-3">
                            <!-- search icon -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-400" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor">
                                <path d="M21 21l-4.35-4.35M11 18a7 7 0 100-14 7 7 0 000 14z" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <input id="search" placeholder="Search animals or zones" class="outline-none text-sm" />
                        </div>
                        <button id="btnHabitat" class="bg-green-600 text-white px-4 py-2 rounded">Add Habitat</button>

                    </div>
                </div>
    <div  class="habitat hidden flex fixed inset-0 bg-black bg-opacity-40 items-center justify-center">

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
</div>

                   



                   






                 <?php  $sql = 'SELECT `name`,image , descreption FROM habitas'; ?>
               <div class="grid grid-cols-3 gap-3">
                            <?php 
               
                            if($result = $conn -> query($sql)){
                                if(mysqli_num_rows($result)>0){
                                    
                                  
                                
                                    while($row = mysqli_fetch_array($result)){
                                        echo "<div class='border border-4'>";
                                        echo " <img class='w-full h-1/2 object-cover border-2 ' src=".$row['image'].">";
                                        echo "<p class='p-2'>" . $row['name'] . "</p>";
                                        echo "<p class='p-1'>" . $row['descreption'] . "</p>";
                                        echo "<div class='flex gap-4 p-2 mt-4'>";
                                          echo "<button class='bg-green-400 w-full rounded-lg '>Edit</button>";
                                          echo "<button class='justify-end items-end w-full rounded-lg bg-red-400'>Delete</button>";
                                        echo "</div>";
                             echo "</div>";
                                    }   
                                    
                                    mysqli_free_result($result);

                                } else{
                                     echo "No records matching your query were found.";
                                } }else {
                                    echo "ERROR: Could not able to execute $sql.";
                                    mysqli_error($conn);
                                }

                            
                            mysqli_close($conn);
                ?>
               </div>

                


        <script src="./habitat.js"></script>

</body>
</html>