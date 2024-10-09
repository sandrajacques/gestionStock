<?php include 'connexion.php';
// Fonction qui va récupérer tous les produits 
/* function getProduit(){
    if (!isset($GLOBALS['connexion'])) {
        die('Erreur : La connexion à la base de données n\'est pas établie.');}
    $sql = "SELECT * FROM produit"; // selectionne tous les produits de la table produit
    $req  = $GLOBALS['connexion']->prepare($sql);// on récupère la session de manière globale
    $req->execute();// execution de la requête
    return $req->fetchAll();//retourne ce que la requête à récupérée sous forme d'un tableau
} */
function getProduit($id=null){
    if(!empty($id)){
        // Récupère un seul produit avec les informations de la catégorie et du fournisseur
        $sql = "SELECT produit.*, categorie.nom_categorie, fournisseur.nom AS nom_fournisseur
                FROM produit
                LEFT JOIN categorie ON produit.id_categorie = categorie.id_categorie
                LEFT JOIN fournisseur ON produit.id_fournisseur = fournisseur.id_fournisseur
                WHERE produit.id_produit = ?";
        $req = $GLOBALS['connexion']->prepare($sql);
        $req->execute(array($id));
        return $req->fetch(PDO::FETCH_ASSOC); // Récupère un seul produit
    } else {
        // Récupère tous les produits avec les informations de la catégorie et du fournisseur
        $sql = "SELECT produit.*, categorie.nom_categorie, fournisseur.nom AS nom_fournisseur
                FROM produit
                LEFT JOIN categorie ON produit.id_categorie = categorie.id_categorie
                LEFT JOIN fournisseur ON produit.id_fournisseur = fournisseur.id_fournisseur";
        $req = $GLOBALS['connexion']->prepare($sql);
        $req->execute();
        return $req->fetchAll(PDO::FETCH_ASSOC); // Récupère tous les produits
    }
}
function getCategories() {
    try {
        $sql = "SELECT * FROM categorie ORDER BY nom_categorie ASC";
        $req = $GLOBALS['connexion']->prepare($sql);
        $req->execute();
        return $req->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        // en cas d'erreur (par exemple, log, affichage d'un message d'erreur, etc.)
        error_log("Erreur lors de la récupération des catégories : " . $e->getMessage());
        return [];
    }
}
function getFournisseurs() {
    try {
        $sql = "SELECT * FROM fournisseur ORDER BY nom ASC";
        $req = $GLOBALS['connexion']->prepare($sql);
        $req->execute();
        return $req->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        // en cas d'erreur (par exemple, log, affichage d'un message d'erreur, etc.)
        error_log("Erreur lors de la récupération des fournisseurs : " . $e->getMessage());
        return [];
    }
}