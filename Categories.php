<?php

require_once 'config/Database.php';
require_once 'models/Categorie.php';
require_once 'includes/header.php';

$categorieModel = new Categorie();
$message        = '';
$messageType    = '';
$editData       = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $libelle = trim($_POST['libelle'] ?? '');

    if ($libelle) {
        if (isset($_POST['action']) && $_POST['action'] === 'edit' && isset($_POST['id'])) {
            $categorieModel->update((int)$_POST['id'], $libelle);
            $message     = 'Categorie modifiee avec succes.';
            $messageType = 'success';
        } else {
            $categorieModel->create($libelle);
            $message     = 'Categorie ajoutee avec succes.';
            $messageType = 'success';
        }
    } else {
        $message     = 'Veuillez saisir un libelle.';
        $messageType = 'error';
    }
}

if (isset($_GET['delete'])) {
    $categorieModel->delete((int)$_GET['delete']);
    $message     = 'Categorie supprimee.';
    $messageType = 'success';
}

if (isset($_GET['edit'])) {
    $editData = $categorieModel->findById((int)$_GET['edit']);
}

$categories = $categorieModel->findAll();
?>

<div class="page-header">
    <div class="page-title">
        <span>Gestion</span>
        Categories
    </div>
</div>

<?php if ($message): ?>
    <div class="alert alert-<?= $messageType ?>"><?= htmlspecialchars($message) ?></div>
<?php endif; ?>

<div class="section-divider">

    <div>
        <div class="form-card">
            <h2 style="font-family:'Playfair Display',serif;font-size:1.25rem;margin-bottom:1.5rem;padding-bottom:.75rem;border-bottom:1px solid var(--cream);">
                <?= $editData ? 'Modifier la categorie' : 'Nouvelle categorie' ?>
            </h2>

            <form method="post">
                <?php if ($editData): ?>
                    <input type="hidden" name="action" value="edit">
                    <input type="hidden" name="id" value="<?= $editData['id'] ?>">
                <?php endif; ?>

                <div class="form-group">
                    <label for="libelle">Libelle</label>
                    <input type="text" id="libelle" name="libelle" required
                           value="<?= htmlspecialchars($editData['libelle'] ?? '') ?>">
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">
                        <?= $editData ? 'Enregistrer' : 'Ajouter' ?>
                    </button>
                    <?php if ($editData): ?>
                        <a href="categories.php" class="btn btn-outline">Annuler</a>
                    <?php endif; ?>
                </div>
            </form>
        </div>
    </div>

    <div>
        <div class="card">
            <?php if (empty($categories)): ?>
                <div class="empty-state">Aucune categorie enregistree.</div>
            <?php else: ?>
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Libelle</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($categories as $c): ?>
                    <tr>
                        <td style="color:rgba(26,18,8,.35);font-size:.8rem;"><?= $c['id'] ?></td>
                        <td><strong><?= htmlspecialchars($c['libelle']) ?></strong></td>
                        <td>
                            <div class="td-actions">
                                <a href="categories.php?edit=<?= $c['id'] ?>" class="btn btn-outline btn-sm">Modifier</a>
                                <a href="categories.php?delete=<?= $c['id'] ?>"
                                   class="btn btn-danger btn-sm"
                                   onclick="return confirm('Supprimer cette categorie ?')">Supprimer</a>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?php endif; ?>
        </div>
    </div>

</div>

<?php require_once 'includes/footer.php'; ?>