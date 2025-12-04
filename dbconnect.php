 <?php
$serveur = "localhost";
$nom_utilisateur = "root";
$mot_de_passe = "";
$nom_base_de_donnees = "zoo";


 
$conn = new mysqli($serveur, $nom_utilisateur, $mot_de_passe, $nom_base_de_donnees);
if ($conn->connect_error) {


  die("Connection failed : " .$conn->connect_error);

}

$test = 'test test';

?>