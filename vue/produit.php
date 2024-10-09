<?php
include 'header.php';
require_once '../model/function.php';
// Récupération de toutes les catégories et fournisseurs
$categories = getCategories(); //  fonction qui retourne toutes les catégories
$fournisseurs = getFournisseurs(); //  fonction qui retourne tous les fournisseurs

// Récupération de tous les produits 
$produit = null;
if(!empty($_GET['id'])){
    $produit = getProduit($_GET['id']);
}
?>
<div class="home-content">
    <div class="overview-boxes">
        <div class="box">
            <form action="<?= !empty($produit) ?"../model/modifProduit.php" : "../model/ajoutProduit.php" ?>" method="post">
                <label for="nom_produit">Nom du produit</label>
                <input value="<?= !empty($produit) ? htmlspecialchars($produit['nom_produit']) : '' ?>" type="text" id="nom_produit" name="nom_produit" placeholder="Veuillez saisir le nom" required>
                <input value="<?= !empty($produit) ? htmlspecialchars($produit['nom_produit']) : '' ?>" type="hidden" id="id" name="id">
                
                <label for="id_categorie">Catégorie</label>
                <select name="id_categorie" id="id_categorie">
                    <?php foreach ($categories as $categorie): ?>
                        <option value="<?= $categorie['id_categorie'] ?>" <?= (!empty($produit) && $produit['id_categorie'] == $categorie['id_categorie']) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($categorie['nom_categorie']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>

                <label for="quantite">Quantité</label>
                <input value="<?= !empty($produit) ? htmlspecialchars($produit['quantite']) : '' ?>" type="number" id="quantite" name="quantite" placeholder="Veuillez saisir la quantité">

                <label for="prix_unitaire">Prix unitaire</label>
                <input value="<?= !empty($produit) ? htmlspecialchars($produit['prix_unitaire']) : '' ?>" type="number" id="prix_unitaire" name="prix_unitaire" placeholder="Veuillez saisir le prix unitaire" step="0.01">

                <label for="date_fabrication">Date de fabrication</label>
                <input value="<?= !empty($produit) ? htmlspecialchars($produit['date_fabrication']) : '' ?>" type="datetime-local" id="date_fabrication" name="date_fabrication">

                <label for="date_expiration">Date d'expiration</label>
                <input value="<?= !empty($produit) ? htmlspecialchars($produit['date_expiration']) : '' ?>" type="datetime-local" id="date_expiration" name="date_expiration">

                <label for="id_fournisseur">Fournisseur</label>
                <select name="id_fournisseur" id="id_fournisseur">
                    <?php foreach ($fournisseurs as $fournisseur): ?>
                        <option value="<?= $fournisseur['id_fournisseur'] ?>" <?= (!empty($produit) && $produit['id_fournisseur'] == $fournisseur['id_fournisseur']) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($fournisseur['nom']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>

                <?php if (!empty($produit)): ?>
                    <input type="hidden" name="id_produit" value="<?= $produit['id_produit'] ?>">
                <?php endif; ?>

                <button type="submit"><?= !empty($produit) ? 'Modifier' : 'Ajouter' ?></button>

                <?php
                if (!empty($_SESSION['message']['text'])) {
                    ?>
                    <div class="alert <?=$_SESSION['message']['type']?>">
                        <?=$_SESSION['message']['text']?>
                    </div>
                    <?php
                    // Efface le message de la session après affichage
                    unset($_SESSION['message']); 
                }
                ?>
            </form>
        </div>
<?php 
//PARTIE QUI PERMET D'AFFICHER TOUS LES PRODUITS
?>
        <div class="box">
            <table class="mtable">
                <tr>
                    <th>Nom Produit</th>
                    <th>Categorie</th>
                    <th>Quantité</th>
                    <th>Prix unitaire</th>
                    <th>Date de fabrication</th>
                    <th>Date d'expiration</th>
                    <th>Action</th>       
                </tr>

                <?php
                $produits = getProduit();
                if(!empty($produits) && is_array($produits)){
                    foreach($produits as $produit){
                        ?>
                        <tr>
                            <td><?= $produit['nom_produit'] ?></td>
                            <td><?= $produit['id_categorie'] ?></td>
                            <td><?= $produit['quantite'] ?></td>
                            <td><?= $produit['prix_unitaire'] ?></td>
                            <td><?= date('d/m/y H:m',strtotime($produit['date_fabrication'])) ?></td>
                            <td><?= date('d/m/y H:m',strtotime($produit['date_expiration'])) ?></td>
                            <td><a href="?id=<?=$produit['id_produit']?>"><i class='bx bx-edit-alt'></i></a></td>
                        </tr>
                        <?php
                    }   
                }               
                ?>
            </table>
        </div>
    </div>
</div>
</section>
<?php
include 'footer.php'
?>