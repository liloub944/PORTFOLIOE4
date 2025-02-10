<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "somnoconsulting";
try {
   $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
   $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   if ($_SERVER["REQUEST_METHOD"] == "POST") {
       $nom = $_POST['nom'];
       $prenom = $_POST['prenom'];
       $courriel = $_POST['courriel'];
       $telephone = $_POST['telephone'];
       if (!empty($nom) && !empty($prenom) && !empty($courriel) && !empty($telephone)) {
           $stmt = $conn->prepare("INSERT INTO medecin (nomMed, prenomMed, courrielMed, numTelMed) VALUES (:nom, :prenom, :courriel, :telephone)");
           $stmt->bindParam(':nom', $nom);
           $stmt->bindParam(':prenom', $prenom);
           $stmt->bindParam(':courriel', $courriel);
           $stmt->bindParam(':telephone', $telephone);
           $stmt->execute();
           echo "Nouveau technicien ajouté avec succès";
       } else {
           echo "Tous les champs sont obligatoires.";
       }
   }
} catch(PDOException $e) {
   echo "Erreur : " . $e->getMessage();
}
$conn = null;
?>