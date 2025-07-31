<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../public/style/main.css">
    <title>Add user</title>
</head>
<body>
    <?php include "App/View/components/navbar.php"; ?>
    <h1>Ajouter un utilisateur</h1>
    <form action="" method="post">
        <input type="text" name="firstname" placeholder="Saisir votre prénom">
        <input type="text" name="lastname" placeholder="Saisir votre nom">
        <input type="text" name="email" placeholder="Saisir votre email">
        <input type="text" name="password" placeholder="Saisir votre mot de passe">
        <input type="submit" value="Enregistrer" name="submit">
    </form>
    <p><?= $message ?></p>
</body>
</html>