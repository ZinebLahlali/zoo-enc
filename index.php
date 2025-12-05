<?php 
include "./dbconnect.php";


// if ($conn->connect_errno === 0) {
//     echo " Connexion réussie à la base de données !";
// } else {
//     echo " Erreur de connexion : " . $conn->connect_error;
// }












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
                        <span class="font-medium">Dashboard</span>
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
                    </div>
                </div>

              
                <section id="dashboard" class="tab-content">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="bg-white p-4 rounded-lg cartoon-shadow">
                            <h3 class="text-lg font-semibold">Total Animals</h3>
                            <p id="totalAnimals" class="text-3xl font-bold mt-3">0</p>
                        </div>
                        <div class="bg-white p-4 rounded-lg cartoon-shadow">
                            <h3 class="text-lg font-semibold">Zones</h3>
                            <p id="totalZones" class="text-3xl font-bold mt-3">0</p>
                        </div>
                        <div class="bg-white p-4 rounded-lg cartoon-shadow">
                            <h3 class="text-lg font-semibold">Carnivores</h3>
                            <p id="totalCarn" class="text-3xl font-bold mt-3">0</p>
                        </div>
                    </div>
                </section>

                <section id="animals" class="tab-content hidden">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-xl font-semibold">Animals</h3>
                        <div class="flex items-center gap-2">
                            <select id="filterZone" class="border rounded px-2 py-1 text-sm">
                                <option value="">All zones</option>
                            </select>
                            <select id="filterDiet" class="border rounded px-2 py-1 text-sm">
                                <option value="">All diets</option>
                                <option value="Carnivore">Carnivore</option>
                                <option value="Herbivore">Herbivore</option>
                                <option value="Omnivore">Omnivore</option>
                            </select>


                        </div>
                    </div>

                   
                </section>

                <section id="zones" class="tab-content hidden">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-xl font-semibold">Zones (Habitats)</h3>
                        <button id="addZoneBtn" class="bg-blue-500 text-white px-3 py-2 rounded">Add zone</button>
                    </div>

                    <div id="zoneGrid" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4"></div>
                </section>

            </main>
        </div>
    </div>

   
    <div id="animalModal" class="fixed inset-0 bg-black bg-opacity-40 hidden items-center justify-center p-4">
        <div class="bg-white w-full max-w-lg p-5 rounded-lg cartoon-shadow">
            <h3 id="animalModalTitle" class="text-lg font-semibold mb-3">Add Animal</h3>
            <form id="animalForm" class="space-y-3">
                <div>
                    <label class="text-sm font-medium">Name</label>
                    <input id="a_name" class="w-full border rounded px-3 py-2" required />
                </div>
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="text-sm font-medium">Image URL</label>
                        <input id="a_image" class="w-full border rounded px-3 py-2" placeholder="https://" />
                    </div>
                    <div>
                        <label class="text-sm font-medium">Diet</label>
                        <select id="a_diet" class="w-full border rounded px-3 py-2">
                            <option>Carnivore</option>
                            <option>Herbivore</option>
                            <option>Omnivore</option>
                        </select>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="text-sm font-medium">Zone</label>
                        <select id="a_zone" class="w-full border rounded px-3 py-2"></select>
                    </div>
                    <div>
                        <label class="text-sm font-medium">Tags (comma)</label>
                        <input id="a_tags" class="w-full border rounded px-3 py-2" placeholder="large, friendly" />
                    </div>
                </div>

                <div class="flex items-center gap-3 justify-end">
                    <button type="button" id="closeAnimalModal" class="px-4 py-2 rounded border">Cancel</button>
                    <button type="submit" class="px-4 py-2 rounded bg-green-500 text-white">Save</button>
                </div>
            </form>
        </div>
    </div>

  
    <div id="zoneModal" class="fixed inset-0 bg-black bg-opacity-40 hidden items-center justify-center p-4">
        <div class="bg-white w-full max-w-md p-5 rounded-lg cartoon-shadow">
            <h3 id="zoneModalTitle" class="text-lg font-semibold mb-3">Add Zone</h3>
            <form id="zoneForm" class="space-y-3">
                <div>
                    <label class="text-sm font-medium">Zone Name</label>
                    <input id="z_name" class="w-full border rounded px-3 py-2" required />
                </div>
                <div>
                    <label class="text-sm font-medium">Description</label>
                    <input id="z_desc" class="w-full border rounded px-3 py-2" />
                </div>
                <div class="flex items-center gap-3 justify-end">
                    <button type="button" id="closeZoneModal" class="px-4 py-2 rounded border">Cancel</button>
                    <button type="submit" class="px-4 py-2 rounded bg-blue-500 text-white">Save Zone</button>
                </div>
            </form>
        </div>
    </div>
    
</body>

</html>