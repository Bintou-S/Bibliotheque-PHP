<?php

require_once 'config/Database.php';
require_once 'models/Auteur.php';
require_once 'includes/header.php';

$auteurModel = new Auteur();
$message     = '';
$messageType = '';
$editData    = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nom         = trim($_POST['nom'] ?? '');
    $prenom      = trim($_POST['prenom'] ?? '');
    $nationalite = trim($_POST['nationalite'] ?? '');

    if ($nom && $prenom) {
        if (isset($_POST['action']) && $_POST['action'] === 'edit' && isset($_POST['id'])) {
            $auteurModel->update((int)$_POST['id'], $nom, $prenom, $nationalite);
            $message     = 'Auteur modifie avec succes.';
            $messageType = 'success';
        } else {
            $auteurModel->create($nom, $prenom, $nationalite);
            $message     = 'Auteur ajoute avec succes.';
            $messageType = 'success';
        }
    } else {
        $message     = 'Veuillez renseigner le nom et le prenom.';
        $messageType = 'error';
    }
}

if (isset($_GET['delete'])) {
    $auteurModel->delete((int)$_GET['delete']);
    $message     = 'Auteur supprime.';
    $messageType = 'success';
}

if (isset($_GET['edit'])) {
    $editData = $auteurModel->findById((int)$_GET['edit']);
}

$auteurs = $auteurModel->findAll();
?>

<div class="page-header">
    <div class="page-title">
        <span>Gestion</span>
        Auteurs
    </div>
</div>

<?php if ($message): ?>
    <div class="alert alert-<?= $messageType ?>"><?= htmlspecialchars($message) ?></div>
<?php endif; ?>

<div class="section-divider">

    <!-- Formulaire -->
    <div>
        <div class="form-card">
            <h2 style="font-family:'Playfair Display',serif;font-size:1.25rem;margin-bottom:1.5rem;padding-bottom:.75rem;border-bottom:1px solid var(--cream);">
                <?= $editData ? 'Modifier l\'auteur' : 'Nouvel auteur' ?>
            </h2>

            <form method="post">
                <?php if ($editData): ?>
                    <input type="hidden" name="action" value="edit">
                    <input type="hidden" name="id" value="<?= $editData['id'] ?>">
                <?php endif; ?>

                <div class="form-grid">
                    <div class="form-group">
                        <label for="nom">Nom</label>
                        <input type="text" id="nom" name="nom" required
                               value="<?= htmlspecialchars($editData['nom'] ?? '') ?>">
                    </div>
                    <div class="form-group">
                        <label for="prenom">Prenom</label>
                        <input type="text" id="prenom" name="prenom" required
                               value="<?= htmlspecialchars($editData['prenom'] ?? '') ?>">
                    </div>
                    <div class="form-group full">
                        <label for="nationalite">Nationalite</label>
                        <input type="text" id="nationalite" name="nationalite"
                               value="<?= htmlspecialchars($editData['nationalite'] ?? '') ?>">
                    </div>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">
                        <?= $editData ? 'Enregistrer' : 'Ajouter' ?>
                    </button>
                    <?php if ($editData): ?>
                        <a href="auteurs.php" class="btn btn-outline">Annuler</a>
                    <?php endif; ?>
                </div>
            </form>
        </div>
    </div>

    <div>
        <div class="card">
            <?php if (empty($auteurs)): ?>
                <div class="empty-state">Aucun auteur enregistre.</div>
            <?php else: ?>
            <table>
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Prenom</th>
                        <th>Nationalite</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($auteurs as $a): ?>
                    <tr>
                        <td><strong><?= htmlspecialchars($a['nom']) ?></strong></td>
                        <td><?= htmlspecialchars($a['prenom']) ?></td>
                        <td><?= htmlspecialchars($a['nationalite']) ?></td>
                        <td>
                            <div class="td-actions">
                                <a href="auteurs.php?edit=<?= $a['id'] ?>" class="btn btn-outline btn-sm">Modifier</a>
                                <a href="auteurs.php?delete=<?= $a['id'] ?>"
                                   class="btn btn-danger btn-sm"
                                   onclick="return confirm('Supprimer cet auteur ?')">Supprimer</a>
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