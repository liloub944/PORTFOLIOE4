<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "somnoconsulting";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $courriel = $_POST['courrielMed'];
        $password = $_POST['mdpMed'];

        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $conn->prepare("SELECT * FROM medecin WHERE courrielMed = :courriel");
        $stmt->bindParam(':courriel', $courriel);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result && password_verify($password, $result['mdpMed'])) {
            echo "Connexion réussie. Bienvenue, " . $result['nomMed'] . "!";
        } else {
            echo "Erreur : Courriel ou mot de passe incorrect.";
        }
    }
} catch(PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}

$conn = null;
?>
    
