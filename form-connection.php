<?php

require_once 'config/database.php';

    //condition pour vérifier si on a recu une request en post (formulaire)

    $errors = [];
    $message = "";

    if ($_SERVER["REQUEST_METHOD"] === "POST") {

        // On verifie qu'il n'y ai pas de code ou d'espace extra dans la saisie
        $email = htmlspecialchars(trim($_POST["email"] ?? ""));
        $password = htmlspecialchars(trim($_POST["password"] ?? ""));

        // Vérifie que les champs ne sont pas vides
        if (empty($email) || empty($password)) {

            $errors[] = "Veuillez remplir tous les champs.";

        }
    
        if (empty($errors)) { // si il n'y a pas d'erreur

            // logique de traitement en data base. Connexion à la base de donnée.
            $pdo = dbConnexion();

            // verifier si l'adresse existe
            $checkEmail = $pdo -> prepare("SELECT email, password FROM users WHERE email = ? ");
            
            // la methode execute de mon objet pdo execute la request préparée
            $checkEmail -> execute([$email]);


            // On verifie si l'e-mail existe
            if ($checkEmail -> rowCount() === 1) {

                // On récupère la ligne de l'utilisateur
                $userData = $checkEmail -> fetch();

                // Si l'email est correct
                // On verifie le mot de passe // WARNING : elle traite uniquement les mot de passe enregistrer avec hashing.
                if (password_verify($password, $userData["password"])) {
                
                    // Si password correct    
                    $message = "Connexion réussie ! Bienvenue";
                
                } else {

                    // Sinon
                    $errors[] = "Mot de passe incorrect.";

                }

            } else {

                // Si email pas correct
                $errors[] = "Adresse e-mail non reconnue.";

            }            
            
        }
                
    }

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="asset/style/style.css?v=<?= filemtime('asset/style/style.css') ?>">
</head>
<body>
    <header>
        <h1>Exercice de mise en pratique : PHP et SQL</h1>
    </header>
    <main>

        <section>

            <h2>Formulaire de connection</h2>

            <form action="" method="POST">

                <div>
                    <label for="email">Votre adresse éléctronique :</label>
                    <input type="text" name="email" id="email" placeholder="Veuillez inserer votre adresse e-mail">
                </div>

                <div>
                    <label for="password">Votre mot de passe</label>
                    <input type="password" name="password" id="password" placeholder="Veuillez inserer votre mot de passe">
                </div>

                <input type="submit" value="Envoyer" class="btn">

                <?php if (!empty($errors)): ?>

                    <div class="errors">
                        <?php foreach ($errors as $error): ?>

                            <p><?= $error ?></p>

                        <?php endforeach; ?>
                    </div>

                <?php endif; ?>

                <?php if (!empty($message)): ?>

                    <div class="success">

                        <p><?= $message ?></p>

                    </div>

                <?php endif; ?>

            </form>

        </section>

    </main>
    <footer>
        <p>© 2025 - by Loriana DIANO</p>
    </footer>
</body>
</html>