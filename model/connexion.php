<?php
session_start();

$host = "localhost";
$db = "gestionstock";
$user = "sandra";
$password = "root";

// Options de récupération des données et affichage des messages d'erreur liés à la BDD
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,  // Active le mode d'erreur exception
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,        // Définit le mode de récupération par défaut
];

// Connexion à la BDD
try {
    $GLOBALS['connexion'] = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4;port=3306", $user, $password, $options);
} catch (PDOException $e) {
    // En cas d'erreur, lance une nouvelle exception avec le message d'erreur
    throw new PDOException($e->getMessage(), (int)$e->getCode());
}
?>
