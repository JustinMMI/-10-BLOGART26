<?php
require_once '../../../header.php'; 

if (!isset($_SESSION['user']) || $_SESSION['user']['statut'] !== 'Administrateur'&& $_SESSION['user']['statut'] !== 'Modérateur') {
    header('Location: /');
    exit;
}

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

<?php require_once '../../../footer.php'; ?>