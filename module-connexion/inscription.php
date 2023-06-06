<?php
// Connexion à la base de données
$serveur = 'localhost:3306';
$utilisateur = 'gabriel-cini';
$motDePasse = 'Gabrieldyna@1';
$baseDeDonnees = 'gabriel-cini_module-connexion';


try {
    // Créer une connexion
    $conn = new PDO("mysql:host=$serveur;dbname=$baseDeDonnees", $utilisateur, $motDePasse);
    // Configurer PDO pour lancer des exceptions en cas d'erreur
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Si le formulaire est soumis
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $login = $_POST['login'];
        $prenom = $_POST['prenom'];
        $nom = $_POST['nom'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];

        // Vérifier que les mots de passe correspondent
        if ($password != $confirm_password) {
            echo "Les mots de passe ne correspondent pas";
            exit;
        }

        // Vérifier les contraintes du mot de passe
        if (
            strlen($password) < 8 ||
            !preg_match('/[A-Z]/', $password) ||
            !preg_match('/[a-z]/', $password) ||
            !preg_match('/\d/', $password) ||
            !preg_match('/[^A-Za-z\d]/', $password)
        ) {
            echo "Le mot de passe ne respecte pas les contraintes";
            exit;
        }

        // Vérifier si le login existe déjà
        $dtb = $conn->prepare("SELECT * FROM user WHERE login = :login");
        $dtb->bindParam(':login', $login);
        $dtb->execute();

        if ($dtb->rowCount() > 0) {
            echo "Ce login est déjà utilisé";
            exit;
        }

        // Hacher le mot de passe
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Insérer l'utilisateur dans la base de données
        $dtb = $conn->prepare("INSERT INTO user (login, prenom, nom, password) VALUES (:login, :prenom, :nom, :password)");
        $dtb->bindParam(':login', $login);
        $dtb->bindParam(':prenom', $prenom);
        $dtb->bindParam(':nom', $nom);
        $dtb->bindParam(':password', $hashed_password);

        if ($dtb->execute()) {
            // Redirection vers la page de connexion
            header("Location: connexion.php");
            exit;
        } else {
            echo "Erreur lors de l'inscription";
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
    <title>Formulaire d'inscription</title>
    <link rel="stylesheet" href="style1.css">
</head>
<body>
   <section>
       <h1> Inscription</h1>
       <form action="" method="POST">  
           <label>Login</label>
           <input type="text" name="login">

           <label> Prenom</label>
           <input type="prenom" name="prenom">
           <label> Nom</label>
           <input type="nom" name="nom">

           <label >Mots de Passe</label>
           <input type="password" name="password">

           <label> Confirmation du mot de passe</label>
           <input type="password" name="confirm_password">

           <input type="submit" value="Valider" name="boutton-valider">
       </form>
   </section> 
</body>
</html>