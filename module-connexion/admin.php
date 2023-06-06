<?php
$serveur = 'localhost:3306';
$utilisateur = 'gabriel-cini';
$motDePasse = 'Gabrieldyna@1';
$baseDeDonnees = 'gabriel-cini_module-connexion';
session_start();

// if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true || $_SESSION['login'] !== 'admin') {
//     header("Location: connexion.php");
//     exit;
// }

try {
    $conn = new PDO("mysql:host=$serveur;dbname=$baseDeDonnees", $utilisateur, $motDePasse);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $dtb = $conn->query("SELECT * FROM user");
    $utili = $dtb->fetchAll(PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    echo "Erreur: " . $e->getMessage();
}

$conn = null;
?>




<!DOCTYPE html>
<html>
<head>
    <title>Administration</title>
    <link rel="stylesheet" type="text/css" href="style3.css">
</head>
<body>
    <div class="container">
        <h1>Administration</h1>
        <table>
            <tr>
                <th>Login</th>
                <th>Prénom</th>
                <th>Nom</th>
            </tr>
            <?php foreach ($utili as $user) : ?>
            <tr>
                <td><?php echo $user['login']; ?></td>
                <td><?php echo $user['prenom']; ?></td>
                <td><?php echo $user['nom']; ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
        <a href="index.php" class="button">Retour à l'accueil</a>
    </div>
</body>
</html>





