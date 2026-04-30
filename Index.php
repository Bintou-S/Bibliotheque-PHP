<?php

require_once 'config/Database.php';
require_once 'models/Auteur.php';
require_once 'models/Categorie.php';
require_once 'models/Livre.php';
require_once 'includes/header.php';

$auteurModel    = new Auteur();
$categorieModel = new Categorie();
$livreModel     = new Livre();

$nbAuteurs    = count($auteurModel->findAll());
$nbCategories = count($categorieModel->findAll());
$nbLivres     = count($livreModel->findAll());

$livresRecents = array_slice($livreModel->findAll(), 0, 5);
?>

<div class="page-header">
    <div class="page-title">
        <span>Tableau de bord</span>
        Vue d'ensemble
    </div>
</div>

<div style="display:grid;grid-template-columns:repeat(3,1fr);gap:1.5rem;margin-bottom:2.5rem;">

    <a href="livres.php" style="text-decoration:none;">
        <div class="card" style="padding:1.75rem 2rem;transition:transform .2s,box-shadow .2s;" onmouseover="this.style.transform='translateY(-3px)';this.style.boxShadow='0 8px 24px rgba(26,18,8,.15)'" onmouseout="this.style.transform='';this.style.boxShadow=''">
            <div style="font-size:0.7rem;letter-spacing:.1em;text-transform:uppercase;color:var(--gold);margin-bottom:.5rem;">Livres</div>
            <div style="font-family:'Playfair Display',serif;font-size:3rem;font-weight:700;color:var(--ink);line-height:1;"><?= $nbLivres ?></div>
            <div style="font-size:0.8rem;color:rgba(26,18,8,.45);margin-top:.4rem;">dans la collection</div>
        </div>
    </a>

    <a href="auteurs.php" style="text-decoration:none;">
        <div class="card" style="padding:1.75rem 2rem;transition:transform .2s,box-shadow .2s;" onmouseover="this.style.transform='translateY(-3px)';this.style.boxShadow='0 8px 24px rgba(26,18,8,.15)'" onmouseout="this.style.transform='';this.style.boxShadow=''">
            <div style="font-size:0.7rem;letter-spacing:.1em;text-transform:uppercase;color:var(--gold);margin-bottom:.5rem;">Auteurs</div>
            <div style="font-family:'Playfair Display',serif;font-size:3rem;font-weight:700;color:var(--ink);line-height:1;"><?= $nbAuteurs ?></div>
            <div style="font-size:0.8rem;color:rgba(26,18,8,.45);margin-top:.4rem;">enregistres</div>
        </div>
    </a>

    <a href="categories.php" style="text-decoration:none;">
        <div class="card" style="padding:1.75rem 2rem;transition:transform .2s,box-shadow .2s;" onmouseover="this.style.transform='translateY(-3px)';this.style.boxShadow='0 8px 24px rgba(26,18,8,.15)'" onmouseout="this.style.transform='';this.style.boxShadow=''">
            <div style="font-size:0.7rem;letter-spacing:.1em;text-transform:uppercase;color:var(--gold);margin-bottom:.5rem;">Categories</div>
            <div style="font-family:'Playfair Display',serif;font-size:3rem;font-weight:700;color:var(--ink);line-height:1;"><?= $nbCategories ?></div>
            <div style="font-size:0.8rem;color:rgba(26,18,8,.45);margin-top:.4rem;">au catalogue</div>
        </div>
    </a>

</div>

<div class="page-header" style="margin-top:2rem;">
    <div class="page-title" style="font-size:1.4rem;">Derniers livres</div>
    <a href="livres.php" class="btn btn-outline btn-sm">Voir tout</a>
</div>

<div class="card">
    <?php if (empty($livresRecents)): ?>
        <div class="empty-state">Aucun livre enregistre pour le moment.</div>
    <?php else: ?>
    <table>
        <thead>
            <tr>
                <th>Titre</th>
                <th>Auteur</th>
                <th>Categorie</th>
                <th>Annee</th>
                <th>Quantite</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($livresRecents as $livre): ?>
            <tr>
                <td><strong><?= htmlspecialchars($livre['titre']) ?></strong></td>
                <td><?= htmlspecialchars($livre['auteur_nom'] ?? '-') ?></td>
                <td><span class="badge"><?= htmlspecialchars($livre['categorie_libelle'] ?? '-') ?></span></td>
                <td><?= $livre['annee'] ?></td>
                <td><?= $livre['quantite'] ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php endif; ?>
</div>

<?php require_once 'includes/footer.php'; ?>