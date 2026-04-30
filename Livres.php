<?php

require_once 'config/Database.php';
require_once 'models/Livre.php';
require_once 'models/Auteur.php';
require_once 'models/Categorie.php';
require_once 'includes/header.php';

$livreModel     = new Livre();
$auteurModel    = new Auteur();
$categorieModel = new Categorie();

$message     = '';
$messageType = '';
$editData    = null;

$auteurs    = $auteurModel->findAll();
$categories = $categorieModel->findAll();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titre       = trim($_POST['titre'] ?? '');
    $isbn        = trim($_POST['isbn'] ?? '');
    $annee       = (int)($_POST['annee'] ?? 0);
    $quantite    = (int)($_POST['quantite'] ?? 0);
    $auteurId    = (int)($_POST['auteur_id'] ?? 0);
    $categorieId = (int)($_POST['categorie_id'] ?? 0);

    if ($titre && $auteurId && $categorieId) {
        if (isset($_POST['action']) && $_POST['action'] === 'edit' && isset($_POST['id'])) {
            $livreModel->update((int)$_POST['id'], $titre, $isbn, $annee, $quantite, $auteurId, $categorieId);
            $message     = 'Livre modifie avec succes.';
            $messageType = 'success';
        } else {
            $livreModel->create($titre, $isbn, $annee, $quantite, $auteurId, $categorieId);
            $message     = 'Livre ajoute avec succes.';
            $messageType = 'success';
        }
    } else {
        $message     = 'Veuillez renseigner le titre, l\'auteur et la categorie.';
        $messageType = 'error';
    }
}

if (isset($_GET['delete'])) {
    $livreModel->delete((int)$_GET['delete']);
    $message     = 'Livre supprime.';
    $messageType = 'success';
}

if (isset($_GET['edit'])) {
    $editData = $livreModel->findById((int)$_GET['edit']);
}

$livres = $livreModel->findAll();
?>

<div class="page-header">
    <div class="page-title">
        <span>Gestion</span>
        Livres
    </div>
    <span style="font-size:.85rem;color:rgba(26,18,8,.4);"><?= count($livres) ?> titre<?= count($livres) > 1 ? 's' : '' ?></span>
</div>

<?php if ($message): ?>
    <div class="alert alert-<?= $messageType ?>"><?= htmlspecialchars($message) ?></div>
<?php endif; ?>

<!-- Formulaire -->
<div class="form-card" style="max-width:100%;margin-bottom:2.5rem;">
    <h2 style="font-family:'Playfair Display',serif;font-size:1.25rem;margin-bottom:1.5rem;padding-bottom:.75rem;border-bottom:1px solid var(--cream);">
        <?= $editData ? 'Modifier le livre' : 'Nouveau livre' ?>
    </h2>

    <form method="post">
        <?php if ($editData): ?>
            <input type="hidden" name="action" value="edit">
            <input type="hidden" name="id" value="<?= $editData['id'] ?>">
        <?php endif; ?>

        <div class="form-grid" style="grid-template-columns:2fr 1fr 1fr 1fr;">
            <div class="form-group">
                <label for="titre">Titre</label>
                <input type="text" id="titre" name="titre" required
                       value="<?= htmlspecialchars($editData['titre'] ?? '') ?>">
            </div>
            <div class="form-group">
                <label for="isbn">ISBN</label>
                <input type="text" id="isbn" name="isbn"
                       value="<?= htmlspecialchars($editData['isbn'] ?? '') ?>">
            </div>
            <div class="form-group">
                <label for="annee">Annee</label>
                <input type="number" id="annee" name="annee" min="1000" max="2099"
                       value="<?= htmlspecialchars($editData['annee'] ?? date('Y')) ?>">
            </div>
            <div class="form-group">
                <label for="quantite">Quantite</label>
                <input type="number" id="quantite" name="quantite" min="0"
                       value="<?= htmlspecialchars($editData['quantite'] ?? 1) ?>">
            </div>
            <div class="form-group" style="grid-column:1/3;">
                <label for="auteur_id">Auteur</label>
                <select id="auteur_id" name="auteur_id" required>
                    <option value="">-- Choisir un auteur --</option>
                    <?php foreach ($auteurs as $a): ?>
                        <option value="<?= $a['id'] ?>"
                            <?= (isset($editData['auteur_id']) && $editData['auteur_id'] == $a['id']) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($a['prenom'] . ' ' . $a['nom']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group" style="grid-column:3/5;">
                <label for="categorie_id">Categorie</label>
                <select id="categorie_id" name="categorie_id" required>
                    <option value="">-- Choisir une categorie --</option>
                    <?php foreach ($categories as $c): ?>
                        <option value="<?= $c['id'] ?>"
                            <?= (isset($editData['categorie_id']) && $editData['categorie_id'] == $c['id']) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($c['libelle']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">
                <?= $editData ? 'Enregistrer' : 'Ajouter le livre' ?>
            </button>
            <?php if ($editData): ?>
                <a href="livres.php" class="btn btn-outline">Annuler</a>
            <?php endif; ?>
        </div>
    </form>
</div>

<!-- Liste -->
<div class="card">
    <?php if (empty($livres)): ?>
        <div class="empty-state">Aucun livre dans la collection.</div>
    <?php else: ?>
    <table>
        <thead>
            <tr>
                <th>Titre</th>
                <th>ISBN</th>
                <th>Auteur</th>
                <th>Categorie</th>
                <th>Annee</th>
                <th style="text-align:center;">Qte</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($livres as $l): ?>
            <tr>
                <td><strong><?= htmlspecialchars($l['titre']) ?></strong></td>
                <td style="font-size:.8rem;color:rgba(26,18,8,.45);font-family:monospace;"><?= htmlspecialchars($l['isbn']) ?></td>
                <td><?= htmlspecialchars($l['auteur_nom'] ?? '-') ?></td>
                <td><span class="badge"><?= htmlspecialchars($l['categorie_libelle'] ?? '-') ?></span></td>
                <td><?= $l['annee'] ?></td>
                <td style="text-align:center;">
                    <span style="font-weight:600;<?= $l['quantite'] == 0 ? 'color:var(--rust)' : '' ?>">
                        <?= $l['quantite'] ?>
                    </span>
                </td>
                <td>
                    <div class="td-actions">
                        <a href="livres.php?edit=<?= $l['id'] ?>" class="btn btn-outline btn-sm">Modifier</a>
                        <a href="livres.php?delete=<?= $l['id'] ?>"
                           class="btn btn-danger btn-sm"
                           onclick="return confirm('Supprimer ce livre ?')">Supprimer</a>
                    </div>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php endif; ?>
</div>

<?php require_once 'includes/footer.php'; ?>