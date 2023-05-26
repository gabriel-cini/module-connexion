<?php
$serveur = 'localhost';
$utilisateur = 'root';
$motDePasse = 'Gabrieldyna@1';
$baseDeDonnees = 'moduleconnexion';

session_start();

try {

    $conn = new PDO("mysql:host=$serveur;dbname=$baseDeDonnees", $utilisateur, $motDePasse);
    
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $login = $_POST['login'];
        $password = $_POST['password'];

        
        $dtb = $conn->prepare("SELECT * FROM user WHERE login = :login");
        $dtb->bindParam(':login', $login);
        $dtb->execute();

        if ($dtb->rowCount() > 0) {
            $row = $dtb->fetch(PDO::FETCH_ASSOC);
            $hashed_password = $row['password'];

            // Vérifier le mot de passe
            echo $password;   // = password_hash($password, PASSWORD_DEFAULT);
            echo "<br>";
            echo $hashed_password;

            if (password_verify($password, $hashed_password)){
                // Authentification réussie, créer une session pour l'utilisateur
                $_SESSION['id'] = true;
                $_SESSION['login'] = $row['login'];
                $_SESSION['prenom'] = $row['prenom'];
                $_SESSION['nom'] = $row['nom'];

                // Rediriger vers la page de profil ou la page d'admin en fonction du login
                if ($_SESSION['login'] === 'admin') {
                    header("Location: admin.php");
                } else {
                    header("Location: profile.php");
                }
                exit;
            }
            else {
                echo "Mot de passe incorrect";
            }
        } 
        else {
            echo "Login incorrect";
        }
    }
} catch(PDOException $e) {
    echo "Erreur: " . $e->getMessage();
}

$conn = null;
?>


<<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire de connexion</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<section>
    <h1> Connexion</h1>
    <form action="" method="POST">  
        <label>Login</label>
        <input type="text" name="login">
        <label >Mots de Passe</label>
        <input type="password" name="password" required>
        <input type="submit" value="Valider" name="boutton-valider">
    </form>
    <p class="text-center"><a href="inscription.php">Inscription</a></p>
</section> 
</body>
</html>