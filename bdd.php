<?php
function connexion() {
     try {
        return new PDO('mysql:host=127.0.0.1;dbname=artbox;charset=utf8', 'root', '');
    } catch (Exception $e) {
        // Gestion des erreurs de connexion à la base de données
        die('Erreur : ' . $e->getMessage());
    }
}