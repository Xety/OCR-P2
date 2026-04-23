<?php
session_start();

// Récupération des erreurs et des anciennes valeurs depuis la session
$errors = $_SESSION['errors'] ?? [];
$old = $_SESSION['old_values'] ?? [];

// On nettoie les données de session pour éviter la réutilisation des anciennes erreurs et valeurs
unset($_SESSION['errors'], $_SESSION['old_values']);

require 'header.php';
?>

<form action="traitement.php" method="POST">
    <div class="champ-formulaire">
        <label for="titre">Titre de l'œuvre</label>
        <input type="text" name="titre" id="titre" value="<?= htmlspecialchars($old['titre'] ?? '') ?>" required>
        <?php if (isset($errors['titre'])): ?>
            <p class="champ-erreur">Le titre est obligatoire.</p>
        <?php endif; ?>
    </div>
    <div class="champ-formulaire">
        <label for="artiste">Auteur de l'œuvre</label>
        <input type="text" name="artiste" id="artiste" value="<?= htmlspecialchars($old['artiste'] ?? '') ?>" required>
        <?php if (isset($errors['artiste'])): ?>
            <p class="champ-erreur">L'auteur est obligatoire.</p>
        <?php endif; ?>
    </div>
    <div class="champ-formulaire">
        <label for="image">URL de l'image</label>
        <input type="url" name="image" id="image" value="<?= htmlspecialchars($old['image'] ?? '') ?>" required>
        <?php if (isset($errors['image'])): ?>
            <p class="champ-erreur">L'URL de l'image est obligatoire et doit être valide.</p>
        <?php endif; ?>
    </div>
    <div class="champ-formulaire">
        <label for="description">Description</label>
        <textarea name="description" id="description" required><?= htmlspecialchars($old['description'] ?? '') ?></textarea>
        <?php if (isset($errors['description'])): ?>
            <p class="champ-erreur">La description est obligatoire et doit contenir au moins 3 caractères.</p>
        <?php endif; ?>
    </div>

    <input type="submit" value="Valider" name="submit">
</form>

<?php require 'footer.php'; ?>