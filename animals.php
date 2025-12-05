<?php
include "./dbconnect.php";

$name = "";
$type_alimentaire = "";
$image = "";
$habitat = "";

if (isset($_POST['submit'])) {
    $name  = $_POST['name'];
    $type_alimentaire  = $_POST['type_alimentaire'];
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
    mysqli_query($conn, $sql) or die("Insert error: " . mysqli_error($conn));
    header("Location: animals.php?success=1");
    exit;
}

if (isset($_GET["delete"])) {
    $delete_id = $_GET["delete"];
    mysqli_query($conn, "DELETE FROM animals WHERE id=$delete_id") or die("Delete error: " . mysqli_error($conn));
    header("Location: animals.php?success=1");
    exit;
}


?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Zoo Kids — Animals</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .popup {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.5);
            align-items: center;
            justify-content: center;
            z-index: 50;
        }
    </style>
</head>

<body class="bg-yellow-50 min-h-screen p-6 flex gap-6">

  
    <aside class="sidebar w-64 bg-white rounded-blobby p-4 cartoon-shadow border border-yellow-100">
        <div class="flex items-center gap-3 mb-6">
       
            <div class="w-12 h-12 bg-yellow-200 rounded-full flex items-center justify-center">
            
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
             
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-yellow-600" viewBox="0 0 24 24"
                    fill="none" stroke="currentColor">
                    <path d="M3 9.5L12 3l9 6.5V20a1 1 0 0 1-1 1h-5v-6H9v6H4a1 1 0 0 1-1-1V9.5z"
                        stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                <a href="index.php" class="font-medium">Dashboard</a>
            </button>

            <button data-tab="animals"
                class="w-full text-left px-3 py-2 rounded flex items-center gap-3 hover:bg-yellow-50">
            
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-yellow-600" viewBox="0 0 24 24"
                    fill="none" stroke="currentColor">
                    <path d="M4.5 11.5c0 3 3 6 7.5 6s7.5-3 7.5-6V9c0-3-3-6-7.5-6S4.5 6 4.5 9v2.5z"
                        stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                <span class="font-medium">Animals</span>
            </button>

            <button data-tab="zones"
                class="w-full text-left px-3 py-2 rounded flex items-center gap-3 hover:bg-yellow-50">
             
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
            
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-green-600" viewBox="0 0 24 24"
                    fill="none" stroke="currentColor">
                    <path d="M12 5v14M5 12h14" stroke-width="1.8" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
                <span class="font-medium">Add New</span>
            </button>
        </nav>
    </aside>
    
    <main class="flex-1">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-extrabold">Animals List</h2>
            <div class="flex items-center gap-3">
                <div class="bg-white px-3 py-2 rounded-lg shadow-sm flex items-center gap-3">
                  
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-400" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor">
                        <path d="M21 21l-4.35-4.35M11 18a7 7 0 100-14 7 7 0 000 14z" stroke-width="1.5"
                            stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                  
                    <form action="animals.php" method="GET">
                      <input type="text" name="search" placeholder="Search animals..." />
                          <button type="submit">Search</button>
                    </form>
                </div>
                <button id="togglePopupBtn" class="bg-green-500 text-white px-3 py-1 rounded w-50 flex mb-2">Add New Animal</button>

            </div>
        </div>

        <div></div>
        <div class="grid grid-cols-3 gap-4">
            <?php

        $search = isset($_GET['search']) ? $_GET['search'] : '';
        $sql = "SELECT animals.*, habitas.name AS habitat
                FROM animals
                JOIN habitas ON animals.Id_habitat = habitas.Id_h
                WHERE animals.name LIKE '%$search%' OR habitas.name LIKE '%$search%'";
        $result = mysqli_query($conn, $sql);

            $result = mysqli_query($conn, $sql);
            if ($result && mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<div class="bg-white p-2 rounded shadow">';
                    echo '<img src="' . $row['image'] . '" class="w-full h-32 object-cover mb-2">';
                    echo '<p class="font-bold">' . $row['name'] . '</p>';
                    echo '<p>' . $row['type_alimentaire'] . '</p>';
                    echo '<div class="flex gap-2 mt-2">';
                    echo '<a href="modfier.php?id=' . $row['id'] . '" class="bg-blue-500 text-white px-2 py-1 rounded">Edit</a>';
                    echo '<a href="animals.php?delete=' . $row['id'] . '" class="bg-red-500 text-white px-2 py-1 rounded">Delete</a>';
                    echo '</div></div>';
                }
            } else {
                echo "<div class='col-span-3 flex justify-center items-center h-32'>";
                echo "<p class='text-red-600 font-semibold text-lg'>No animals found matching '<strong>" . htmlspecialchars($search) . "</strong>'</p>";
                echo "</div>";

            }
            ?>
        </div>
    </main>

    <!-- Popup Form -->
    <div id="popupForm" class="popup hidden">
        <div class="bg-white p-6 rounded shadow w-full max-w-md">
            <form action="animals.php" method="POST" class="flex flex-col gap-3">
                <h2 class="text-lg font-semibold mb-2">Add New Animal</h2>
                <label>Name:</label>
                <input type="text" name="name" class="border p-1 w-full mb-2" required>

                <label>Type Alimentaire:</label>
                <select name="type_alimentaire" class="border p-1 w-full mb-2" required>
                    <option value="">Select</option>
                    <option value="Carnivore">Carnivore</option>
                    <option value="Herbivore">Herbivore</option>
                    <option value="Omnivore">Omnivore</option>
                </select>

                <label>Habitat:</label>
                <select name="Id_habitat" class="border p-1 w-full mb-2" required>
                    <option value="">Select habitat</option>
                    <?php
                    $habitats = mysqli_query($conn, "SELECT Id_h, name FROM habitas");
                    while ($row = mysqli_fetch_assoc($habitats)) {
                        echo '<option value="' . $row['Id_h'] . '">' . $row['name'] . '</option>';
                    }
                    ?>
                </select>

                <label>Image URL:</label>
                <input type="url" name="image" class="border p-1 w-full mb-2" required>

                <div class="flex gap-2">
                    <input type="submit" name="submit" value="Add Animal" class="bg-green-500 text-white px-3 py-1 rounded cursor-pointer">
                    <button type="button" id="closePopup" class="bg-orange-500 text-white px-3 py-1 rounded">Cancel</button>
                </div>
            </form>
        </div>
    </div>

    <script src="./app.js"></script>

</body>

</html>