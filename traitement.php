<?php

session_start();

$errors = [];

if (empty($_POST['titre'])) {
    $errors['titre'] = true;
}

if (empty($_POST['artiste'])) {
    $errors['artiste'] = true;
}

if (empty($_POST['image']) || !filter_var($_POST['image'], FILTER_VALIDATE_URL)) {
    $errors['image'] = true;
}

if (empty($_POST['description']) || strlen($_POST['description']) < 3) {
    $errors['description'] = true;
}

// Si des erreurs sont présentes, on les stocke en session et on redirige vers le formulaire
if (!empty($errors)) {
    $_SESSION['errors'] = $errors;
    // On stocke également les anciennes valeurs pour les réafficher dans le formulaire
    $_SESSION['old_values'] = [
        'titre' => $_POST['titre'] ?? '',
        'artiste' => $_POST['artiste'] ?? '',
        'image' => $_POST['image'] ?? '',
        'description' => $_POST['description'] ?? '',
    ];
    header('Location: ajouter.php');
    exit;
}

$titre = htmlspecialchars($_POST['titre']);
$description = htmlspecialchars($_POST['description']);
$artiste = htmlspecialchars($_POST['artiste']);
$image = htmlspecialchars($_POST['image']);

require 'bdd.php';
$bdd = connexion();
$requete = $bdd->prepare("INSERT INTO oeuvres (titre, description, artiste, image) VALUES (:titre, :description, :artiste, :image)");
$requete->execute([
    ':titre' => $titre,
    ':description' => $description,
    ':artiste' => $artiste,
    ':image' => $image,
]);
header('Location: oeuvre.php?id=' . $bdd->lastInsertId());
exit;