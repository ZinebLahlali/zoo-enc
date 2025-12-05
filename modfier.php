<?php
include "./dbconnect.php";

$id = $_GET['id'] ?? null;
if (!$id) {
    header("Location: animals.php");
    exit;
}

$sql = "SELECT * FROM animals WHERE id=$id";
$result = mysqli_query($conn, $sql);
if (!$result || mysqli_num_rows($result) == 0) {
    header("Location: animals.php");
    exit;
}
$animal = mysqli_fetch_assoc($result);

$name = $animal['name'];
$type_alimentaire = $animal['type_alimentaire'];
$image = $animal['image'];
$habitat = $animal['Id_habitat'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $type_alimentaire = $_POST['type_alimentaire'];
    $image = $_POST['image'];
    $habitat = $_POST['Id_habitat'];

    if (empty($name) || empty($type_alimentaire) || empty($image) || empty($habitat)) {
        $errorMessage = "All fields are required!";
    } else {
        $sql = "UPDATE animals 
                SET name='$name', type_alimentaire='$type_alimentaire', image='$image', Id_habitat=$habitat
                WHERE id=$id";
        if (mysqli_query($conn, $sql)) {
            header("Location: animals.php?success=1");
            exit;
        } else {
            $errorMessage = "Error updating animal: " . mysqli_error($conn);
        }
    }
}
?>

<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Edit Animal</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-yellow-50 p-6">

<h1 class="text-2xl font-bold mb-4">Edit Animal</h1>

<?php if (!empty($errorMessage)) { echo '<p class="text-red-500">'.$errorMessage.'</p>'; } ?>

<form action="modfier.php?id=<?php echo $id; ?>" method="POST" class="p-4 bg-white rounded shadow w-96">
    <label>Name:</label>
    <input type="text" name="name" class="border p-1 w-full mb-2" value="<?php echo $name; ?>" required>

    <label>Type Alimentaire:</label>
    <select name="type_alimentaire" class="border p-1 w-full mb-2" required>
        <option value="Carnivore" <?php if($type_alimentaire=='Carnivore') echo 'selected'; ?>>Carnivore</option>
        <option value="Herbivore" <?php if($type_alimentaire=='Herbivore') echo 'selected'; ?>>Herbivore</option>
        <option value="Omnivore" <?php if($type_alimentaire=='Omnivore') echo 'selected'; ?>>Omnivore</option>
    </select>

    <label>Habitat:</label>
    <select name="Id_habitat" class="border p-1 w-full mb-2" required>
        <?php
        $habitats = mysqli_query($conn, "SELECT Id_h, name FROM habitas");
        while ($row = mysqli_fetch_assoc($habitats)) {
            $selected = ($row['Id_h'] == $habitat) ? 'selected' : '';
            echo "<option value='{$row['Id_h']}' $selected>{$row['name']}</option>";
        }
        ?>
    </select>

    <label>Image URL:</label>
    <input type="url" name="image" class="border p-1 w-full mb-2" value="<?php echo $image; ?>" required>

    <input type="submit" value="Update Animal" class="bg-blue-500 text-white px-3 py-1 rounded cursor-pointer">
</form>

</body>
</html>
