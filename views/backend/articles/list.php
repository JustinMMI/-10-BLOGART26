<?php
include '../../../header.php';

// 🔐 Sécurité admin
if (!isset($_SESSION['user']) || $_SESSION['user']['statut'] !== 'Administrateur') {
    header('Location: /');
    exit;
}

// Charger tous les articles
$articles = sql_select("ARTICLE", "*");
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Articles</h1>

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Titre</th>
                        <th>Date création</th>
                        <th>Dernière maj</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>

                <?php foreach ($articles as $article): ?>
                    <tr>
                        <td><?= $article['numArt']; ?></td>

                        <td><?= htmlspecialchars($article['libTitrArt']); ?></td>

                        <td><?= $article['dtCreaArt']; ?></td>

                        <td><?= $article['dtMajArt'] ?? '-'; ?></td>

                        <td>
                            <a href="edit.php?numArt=<?= $article['numArt']; ?>"
                               class="btn btn-warning btn-sm">
                               Edit
                            </a>

                            <a href="delete.php?numArt=<?= $article['numArt']; ?>"
                               class="btn btn-danger btn-sm">
                               Delete
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>

                </tbody>
            </table>

            <a href="create.php" class="btn btn-success">Create</a>
        </div>
    </div>
</div>

<?php include '../../../footer.php'; ?>
