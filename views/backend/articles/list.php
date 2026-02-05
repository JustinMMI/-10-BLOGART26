<?php
include '../../../header.php';


requireAdmin('page');

// Récupérer l'article épinglé depuis le fichier JSON
$pinFileContent = json_decode(file_get_contents('../../../functions/pinned_article.json'), true);
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
                            <td><?= $article['numArt'] ?></td>

                            <td><?= $article['dtCreaArt'] ?></td>

                            <td><?= htmlspecialchars($article['libTitrArt']); ?></td>

                            <td>
                                <?= substr(strip_tags($article['libChapoArt']), 0, 80) ?> […]
                            </td>

                            <td>
                                <?= substr(strip_tags($article['libAccrochArt'] ?? ''), 0, 80) ?> […]
                            </td>

                            <td>
                                <?= !empty($listeMots) ? implode(', ', $listeMots) . ' […]' : '-' ?>
                            </td>

                            <td><?= htmlspecialchars($article['libThem']); ?></td>

                            <td>
                                <a href="edit.php?numArt=<?= $article['numArt'] ?>"
                                class="btn btn-warning btn-sm">
                                Edit
                                </a>

                                <a href="delete.php?numArt=<?= $article['numArt'] ?>"
                                class="btn btn-danger btn-sm">
                                Delete
                                </a>

                                <form method="POST" action="/api/articles/pin.php" style="display:inline;">
                                    <input type="hidden" name="numArt" value="<?= $article['numArt'] ?>">
                                    <input type="hidden" name="action" value="<?= ($article['numArt'] === $pinnedId) ? 'unpin' : 'pin' ?>">
                                    <button type="submit" class="btn btn-info btn-sm">
                                        <?= ($article['numArt'] === $pinnedId) ? 'Dépingler' : 'Épingler' ?>
                                    </button>
                                </form>
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



