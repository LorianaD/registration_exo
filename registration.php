<?php
    //condition pour vérifier si on a recu une request en post (formulaire)
    
    
    session_start();

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $name = htmlspecialchars(trim("name")) ?? "";
        $email = htmlspecialchars(trim("email")) ??"";
        $password = htmlspecialchars(trim("password")) ?? "";
        $confirmPassword = htmlspecialchars(trim("confirmPassword")) ?? "";

    }
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
    <h1>EXERCICE FORMULAIRE PHP et BDD</h1>
    </header>
    <main>
        <section>
        <h2>Formulaire d'enregistrement</h2>
            <form action="" method="POST">
                <div>
                    <label for="name">Nom</label>
                    <input type="text" name="name" id="name" placeholder="Veuillez entrer votre nom" required>
                </div>
                <div>
                    <label for="email">Adresse éléctronique</label>
                    <input type="email" name="email" id="email" placeholder="Veuillez entrer votre e-mail" required>
                </div>
                <div>
                    <label for="password">Mot de passe</label>
                    <input type="password" name="password" id="password" placeholder="Veuillez entrer votre password" required>
                </div>
                <div>
                    <label for="confirmPassword">Confirmation de mot de passe</label>
                    <input type="password" name="confirmPassword" id="confirmPassword" placeholder="Veuillez confirmer votre password" required>    
                </div>
                <input type="submit" value="Envoyer">
            </form>
        </section>
    </main>
    <footer>

    </footer>
</body>
</html>