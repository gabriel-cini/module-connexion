<?php
$serveur = 'localhost:3306';
$utilisateur = 'gabriel-cini';
$motDePasse = 'Gabrieldyna@1';
$baseDeDonnees = 'gabriel-cini_module-connexion';
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['id']) || $_SESSION['id'] !== true) {
    // Rediriger vers la page de connexion
    header("Location: connexion.php");
    exit;
}

try {
    // Créer une connexion
    $conn = new PDO("mysql:host=$serveur;dbname=$baseDeDonnees", $utilisateur, $motDePasse);
    // Configurer PDO pour lancer des exceptions en cas d'erreur
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Récupérer les informations de l'utilisateur connecté
    $login = $_SESSION['login'];
    $dtb = $conn->prepare("SELECT * FROM user WHERE login = :login");
    $dtb->bindParam(':login', $login);
    $dtb->execute();
    $user = $dtb->fetch(PDO::FETCH_ASSOC);

    // Si le formulaire est soumis
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $prenom = $_POST['prenom'];
        $nom = $_POST['nom'];

        // Mettre à jour les informations de l'utilisateur dans la base de données
        $dtb = $conn->prepare("UPDATE user SET prenom = :prenom, nom = :nom WHERE login = :login");
        $dtb->bindParam(':prenom', $prenom);
        $dtb->bindParam(':nom', $nom);
        $dtb->bindParam(':login', $login);
        $dtb->execute();

        // Mettre à jour les informations de l'utilisateur dans la session
        $_SESSION['prenom'] = $prenom;
        $_SESSION['nom'] = $nom;

        echo "Informations mises à jour avec succès";
        
        
    }
} catch(PDOException $e) {
    echo "Erreur: " . $e->getMessage();
}

$conn = null;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Profil</title>
    <link rel="stylesheet" href="style4.css">
</head>
<body>
    <div class="container">
        <h1>Profil</h1>
        <form method="POST" action="profile.php">
            <label for="login">Login:</label>
            <input type="text" id="login" name="login" value="<?php echo $_SESSION['login']; ?>">
            <label for="prenom">Prénom:</label>
            <input type="text" id="prenom" name="prenom" value="<?php echo $_SESSION['prenom']; ?>">
            <label for="nom">Nom:</label>
            <input type="text" id="nom" name="nom" value="<?php echo $_SESSION['nom']; ?>">
            <input type="submit" value="Mettre à jour">
            
        </form>
    </div>
</body>
</html>