<?php 

include 'connexion.php';

if(!empty($_POST['nom_produit'])
&& !empty($_POST['id_categorie'])
&& !empty($_POST['quantite'])
&& !empty($_POST['prix_unitaire'])
&& !empty($_POST['date_fabrication'])
&& !empty($_POST['date_expiration'])
&& !empty($_POST['id_fournisseur'])
){
    $sql = "INSERT INTO produit(nom_produit, id_categorie, quantite, prix_unitaire, date_fabrication, date_expiration,id_fournisseur)
    VALUES (?,?,?,?,?,?,?)";
    $req = $connexion->prepare($sql);

    $req->execute(array(
        $_POST['nom_produit'],
        $_POST['id_categorie'], 
        $_POST['quantite'],
        $_POST['prix_unitaire'],
        $_POST['date_fabrication'],
        $_POST['date_expiration'],
        $_POST['id_fournisseur']
    ));

    if($req->rowCount() !== 0){
        $_SESSION['message']['text'] = "article ajouté avec succès";
        $_SESSION['message']['type']= "success";
       /*  echo "Produit ajouté avec succès"; */
    } else {
        $_SESSION['message']['text'] = "Une erreur s'est produite lors de l'ajout du produit";
        $_SESSION['message']['type']= "danger";
       /*  echo "Une erreur s'est produite lors de l'ajout du produit";   */  
    }
} else {
    $_SESSION['message']['text'] = "Une information obligatoire n'est pas renseignée";
    $_SESSION['message']['type']= "danger";
   /*  echo "Une information obligatoire n'est pas renseignée"; */
}
header('location:../vue/produit.php');
