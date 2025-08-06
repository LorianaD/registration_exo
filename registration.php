<?php
    //condition pour vérifier si on a recu une request en post (formulaire)

    $errors = [];

    if ($_SERVER["REQUEST_METHOD"] === "POST") {

        $name = htmlspecialchars(trim($_POST["name"])) ?? "";
        $email = htmlspecialchars(trim($_POST["email"])) ??"";
        $password = htmlspecialchars(trim($_POST["password"])) ?? "";
        $confirmPassword = htmlspecialchars(trim($_POST["confirmPassword"])) ?? "";
        
        // validation des données
        // validation username
        // valide que le champ soit remplis

        if (empty($name)) {
            $errors[] = "nom obligatoire !";
        //valide avec la function strlen si la string est de plus de 3 carac
        }elseif (strlen($name) < 3) {
            $errors[] = "mini 3 carac";
        //valide avec la function strlen si la string est de moins de 55 carac
        }elseif (strlen($name) > 55) {
            $errors[] = "max 55 carac";
        }

        //validation email
        if (empty($email)) {
            $errors[] = "email obligatoire !";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "votre adresse ne correspond au format mail classique";
        }

        //validation password
        if (empty($password)) { // si password vide
            $errors[] = "password obligatoire"; // alors envoie le msg
        }elseif (strlen($password) < 6) { // sinon si password inferieur de 6 caractéres
            $errors[] = "password trop juste"; // alors envoie le msg
            // normalement ici on met un pattern pour le mdp
        }elseif ($password !== $confirmPassword) { // si password strictement différent de Confirmation de password
            $errors[] = "mot de passe doivent etre identique"; // alors envoie le msg
        }

        var_dump($errors);
        
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