<?php
include "./dbconnect.php";



$name = "";
$type_alimentaire = "";
$image = "";
if (isset($_POST['submit'])) {

    $name = $_POST['name'];
    $type_alimentaire = $_POST['type_alimentaire'];
    $habitat = $_POST['Id_habitat'];
    $image = $_POST['image'];


    if (empty($name) || empty($type_alimentaire) || empty($habitat) || empty($image)) {
        die("All fields are required!");
    }

    $check = mysqli_query($conn, "SELECT * FROM habitas WHERE Id_h = $habitat");
    if (mysqli_num_rows($check) == 0) {
        die("Error: selected habitat does not exist!");
    }

    $sql = "INSERT INTO animals (`name`, `type_alimentaire`, `Id_habitat`, `image`)
            VALUES ('$name', '$type_alimentaire', $habitat, '$image')";

    if (mysqli_query($conn, $sql)) {
        header("Location: animals.php?success=1");
        exit;
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}


if (isset($_POST['submit'])) {  
    $id = $_POST['id'];
    $name  = $_POST['name'];
    $type_alimentaire  = $_POST['type_alimentaire'];
    $habitat = $_POST['Id_habitat'];
    $image = $_POST['image'];

    $check = mysqli_query($conn, "SELECT * FROM habitas WHERE Id_h = $habitat");
    if (mysqli_num_rows($check) == 0) {
        die("Error: selected habitat does not exist!");
    }

    $sql = "UPDATE animals 
    SET name = '$name', type_alimentaire = '$type_alimentaire', image = '$image', Id_habitat = $habitat
            WHERE id = $id";

    if (mysqli_query($conn, $sql)) {
        header("Location: animals.php?success=1");
        exit;
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

if (isset($_GET["delete"])) {
    $delete_id = $_GET["delete"];
    $query_delete = "DELETE FROM animals WHERE id= " . $delete_id;
    if (mysqli_query($conn, $query_delete)) {

        header("Location: animals.php?success=1");
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
                        <span class="font-medium">Animals</span>
                    </button>

                    <button data-tab="zones"
                        class="w-full text-left px-3 py-2 rounded flex items-center gap-3 hover:bg-yellow-50">
                        <!-- map icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-yellow-600" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor">
                            <path d="M20 6l-5 2-5-2-5 2v10l5-2 5 2 5-2V6z" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                        <a href="habitat.php" class="font-medium">Habitat</a>
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
                        <button id="addtop" class="bg-green-500 text-white px-3 py-2 rounded-lg shadow">Add
                            animal</button>
                    </div>
                </div>



                <!-- POPUP -->
                <div
                    class="animal flex fixed inset-0 bg-black bg-opacity-40 hidden items-center justify-center">

                    <div class="bg-white p-6 rounded-xl w-full max-w-md shadow-xl">


                        <form action="animals.php" method="POST" class="flex flex-col gap-3 ">
                            <legend class="text-lg font-semibold mb-2">Animal Information</legend>

                            <label for="name">Name of animal:</label>
                            <input type="text" id="name" name="name" value="<?php echo $name; ?>"
                                class="border rounded px-3 py-2" />

                            <label for="type_alimentaire">Type food:</label>
                            <select type="text" id="type_alimentaire" name="type_alimentaire" value="<?php echo $type_alimentaire; ?>"
                                class="border rounded px-3 py-2">
                                <option value="Carnivore">Carnivore</option>
                                <option value="Herbivore">Herbivore</option>
                                <option value="Omnivore">Omnivore</option>
                            </select>
                            <label for="habitat">Name of habitat:</label>
                            <select name="Id_habitat" id="habitat" class="border rounded px-3 py-2">
                                <option value="">Select habitat</option>
                                <?php
                                $habitats = mysqli_query($conn, "SELECT Id_h, name FROM habitas");

                                while ($row = mysqli_fetch_assoc($habitats)) {
                                    echo '<option value="' . $row['Id_h'] . '">' . $row['name'] . '</option>';
                                }
                                ?>
                            </select>


                            <label for="image">Enter the URL:</label>
                            <input type="url" id="image" name="image" value="<?php echo $image; ?>"
                                class="border rounded px-3 py-2" />


                            <div class="flex gap-4 ">
                                <input type="submit"
                                    name="submit" value="Submit"
                                    class="mt-3 bg-green-500 text-white px-4 py-2 rounded cursor-pointer w-full" />
                                <button type="button" id="animalCancel" class="bg-orange-300 rounded cursor-pointer text-white px-4 py-2 justify-end items-end w-full ">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>





                <?php $sql = 'SELECT `name`, `image`, type_alimentaire,id FROM animals'; ?>
                <div class="grid grid-cols-3 gap-3">
                    <?php

                    if ($result = mysqli_query($conn, $sql)) {
                        if (mysqli_num_rows($result) > 0) {



                            while ($row = mysqli_fetch_array($result)) {
                                echo "<div class='border border-4 h-full'>";
                                echo " <img class='w-full h-1/2 object-cover border-2 ' src=" . $row['image'] . ">";
                                echo "<p class='p-2'>" . $row['name'] . "</p>";
                                echo "<p class='p-1'>" . $row['type_alimentaire'] . "</p>";
                                echo "<div class='flex justify-evenly gap-4 p-2 mt-4 w-full'>";
                                echo "<a href='modfier.php?id=" . $row["id"] . "'><button class='px-3 py-1 bg-green-500 hover:bg-green-600 text-white rounded-lg text-sm w-[120px]'>Edit</button></a>";
                                echo "<a href='animals.php?delete=" . $row["id"] . "'><button class=' px-3 py-1 bg-red-500 hover:bg-red-600 text-white rounded-lg text-sm w-[120px]'>Delete</button></a>";
                                echo "</div>";

                                echo "</div>";
                            }

                            mysqli_free_result($result);
                        } else {
                            echo "No records matching your query were found.";
                        }
                    } else {
                        echo "ERROR: Could not able to execute $sql.";
                        mysqli_error($conn);
                    }


                    mysqli_close($conn);
                    ?>
                </div>



                <script src="app.js"></script>
</body>

</html>