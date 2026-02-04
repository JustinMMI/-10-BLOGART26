<?php
include '../../../header.php'; // contains the header and call to config.php

if (!isset($_SESSION['user']) || $_SESSION['user']['statut'] !== 'Administrateur'&& $_SESSION['user']['statut'] !== 'Modérateur') {
    header('Location: /');
    exit;
}
?>

<?php
$comments = sql_select(
    "comment c
     INNER JOIN membre m ON c.numMemb = m.numMemb
     INNER JOIN article a ON c.numArt = a.numArt",
    "a.libTitrArt,
     m.pseudoMemb,
     c.dtCreaCom,
     c.dtModCom,
     c.delLogiq,
     c.attModOK,
     c.notifComKOAff,
     c.libCom,
     c.numCom",
    null,
    null,
    "c.dtCreaCom DESC"
);

$enAttente = array_filter($comments, fn($c) => $c['delLogiq'] == 0 && $c['attModOK'] == 0);
$dejaControle = array_filter($comments, fn($c) => $c['delLogiq'] == 0 && $c['attModOK'] == 1);
$suppressionLogique = array_filter($comments, fn($c) => $c['delLogiq'] == 1);
?>

<!-- Bootstrap default layout to display all statuts in foreach -->
<main class="container my-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12 mt-5">
                <h1>Commentaires en attente </h1>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Titre Article</th>
                            <th>Pseudo</th>
                            <th>Date</th>
                            <th>Contenu</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($enAttente as $comment) { ?>
                            <tr>
                                <td><?= $comment['libTitrArt']; ?></td>
                                <td><?= $comment['pseudoMemb']; ?></td>
                                <td><?= $comment['dtCreaCom']; ?></td>
                                <td><?= $comment['libCom']; ?></td>
                                <td>
                                    <a href="update.php?numCom=<?= $comment['numCom']; ?>" class="btn btn-info">Controle</a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 mt-5">
                <h1>Commentaires contrôlés</h1>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Pseudo</th>
                            <th>Dernière Modification</th>
                            <th>Contenu</th>
                            <th>Publication</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($dejaControle as $comment) { ?>
                            <tr>
                                <td><?= $comment['pseudoMemb']; ?></td>
                                <td><?= $comment['dtModCom']; ?></td>
                                <td><?= $comment['libCom']; ?></td>
                                <td><?= $comment['delLogiq'] ? 'Masqué' : 'Publié'; ?></td>
                                <td>
                                    <a href="delete.php?numCom=<?= $comment['numCom']; ?>" class="btn btn-danger">Delete logique</a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 mt-5">
                <h1>Suppression logique</h1>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Pseudo</th>
                            <th>Date suppr logique</th>
                            <th>Contenu</th>
                            <th>Publication</th>
                            <th>Raison refus</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($suppressionLogique as $comment) { ?>
                            <tr>
                                <td><?= $comment['pseudoMemb']; ?></td>
                                <td><?= $comment['dtModCom']; ?></td>
                                <td><?= $comment['libCom']; ?></td>
                                <td>REFUS</td>
                                <td><?= $comment['notifComKOAff']; ?></td>
                                <td>
                                    <a href="delete.php?numCom=<?= $comment['numCom']; ?>" class="btn btn-danger">Delete Physique</a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>

<?php
include '../../../footer.php'; // contains the footer
?>