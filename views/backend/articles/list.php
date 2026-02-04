<?php
include '../../../header.php';


if (!isset($_SESSION['user']) || $_SESSION['user']['statut'] !== 'Administrateur'&& $_SESSION['user']['statut'] !== 'Modérateur') {
    header('Location: /');
    exit;
}

// Récupérer l'article épinglé depuis le fichier JSON
$pinFileContent = json_decode(file_get_contents('../../../pinned_article.json'), true);
$pinnedId = $pinFileContent['numArt'];

$articles = sql_select("ARTICLE a INNER JOIN THEMATIQUE t ON a.numThem = t.numThem","a.*, t.libThem");
?>

<!-- Bootstrap default layout to display all statuts in foreach -->
<main class="container my-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Articles</h1>

                <table class="table table-striped table-bordered align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Id</th>
                            <th>Date</th>
                            <th>Titre</th>
                            <th>Chapeau</th>
                            <th>Accroche</th>
                            <th>Mots clés</th>
                            <th>Thématique</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>

                    <?php foreach ($articles as $article): ?>

                        <?php

                        $motsCles = sql_select(
                            "MOTCLEARTICLE ma 
                            INNER JOIN MOTCLE mc ON ma.numMotCle = mc.numMotCle",
                            "mc.libMotCle",
                            "ma.numArt = " . (int)$article['numArt']
                        );

                        $listeMots = [];
                        foreach ($motsCles as $mot) {
                            $listeMots[] = $mot['libMotCle'];
                        }
                        ?>

                        <tr>
                            <td><?= $article['numArt']; ?></td>

                            <td><?= $article['dtCreaArt']; ?></td>

                            <td><?= htmlspecialchars($article['libTitrArt']); ?></td>

                            <td>
                                <?= substr(strip_tags($article['libChapoArt']), 0, 80); ?> […]
                            </td>

                            <td>
                                <?= substr(strip_tags($article['libAccrochArt'] ?? ''), 0, 80); ?> […]
                            </td>

                            <td>
                                <?= !empty($listeMots) ? implode(', ', $listeMots) . ' […]' : '-' ?>
                            </td>

                            <td><?= htmlspecialchars($article['libThem']); ?></td>

                            <td>
                                <a href="edit.php?numArt=<?= $article['numArt']; ?>"
                                class="btn btn-warning btn-sm">
                                Edit
                                </a>

                                <a href="delete.php?numArt=<?= $article['numArt']; ?>"
                                class="btn btn-danger btn-sm">
                                Delete
                                </a>

                                <button class="btn btn-info btn-sm toggle-pin" data-art="<?= $article['numArt']; ?>" data-pinned="<?= $article['numArt'] === $pinnedId ? '1' : '0' ?>">
                                    <?= ($article['numArt'] === $pinnedId) ? 'Dépingler' : 'Épingler' ?>
                                </button>
                            </td>
                        </tr>

                    <?php endforeach; ?>

                    </tbody>
                </table>

                <a href="create.php" class="btn btn-success">Create</a>
            </div>
        </div>
    </div>
</main>

<script>
document.querySelectorAll('.toggle-pin').forEach(btn => {
    btn.addEventListener('click', function(e) {
        e.preventDefault();
        const numArt = this.dataset.art;
        const isPinned = this.dataset.pinned === '1';
        const button = this;

        console.log('Épinglage article:', numArt, 'Action:', isPinned ? 'unpin' : 'pin');

        fetch('/api/articles/pin.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            credentials: 'same-origin',
            body: new URLSearchParams({
                numArt: numArt,
                action: isPinned ? 'unpin' : 'pin'
            })
        })
        .then(response => {
            console.log('Réponse reçue:', response.status);
            if (!response.ok) {
                throw new Error('HTTP error ' + response.status);
            }
            return response.text();
        })
        .then(text => {
            console.log('Réponse texte:', text);
            try {
                const data = JSON.parse(text);
                if (data.success) {
                    console.log('Succès, rechargement...');
                    location.reload();
                } else {
                    alert('Erreur: ' + (data.message || 'Erreur inconnue'));
                }
            } catch (e) {
                console.error('Erreur parsing JSON:', e);
                alert('Erreur serveur: ' + text);
            }
        })
        .catch(error => {
            console.error('Erreur fetch:', error);
            alert('Erreur: ' + error.message);
        });
    });
});
</script>

