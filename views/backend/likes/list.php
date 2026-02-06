<?php
require_once '../../../header.php'; 

require_once $_SERVER['DOCUMENT_ROOT'] . '/functions/admin_guard.php';

requireAdmin('page');

$likes = sql_select(
    "LIKEART l
     INNER JOIN MEMBRE m ON l.numMemb = m.numMemb
     INNER JOIN ARTICLE a ON l.numArt = a.numArt",
    "l.numMemb,
     l.numArt,
     l.likeA,
     m.pseudoMemb,
     a.libTitrArt,
     a.libChapoArt",
    null,
    null,
    "l.numArt DESC, m.pseudoMemb ASC"
);

$likesGroup = array_filter($likes, fn($l) => $l['likeA'] == 1);
$dislikesGroup = array_filter($likes, fn($l) => $l['likeA'] == 0);
?>

<!-- Bootstrap default layout to display all statuts in foreach -->
<main class="container my-5">
    <div class="container">
        <h2>Articles Likes</h2>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Membre</th>
                    <th>Titre Article</th>
                    <th>Statut</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($likesGroup as $like) { ?>
                    <tr>
                        <td><?= htmlspecialchars($like['pseudoMemb']); ?></td>
                        <td><?= htmlspecialchars($like['libTitrArt']); ?></td>
                        <td>like</td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</main>

<?php require_once '../../../footer.php'; ?>