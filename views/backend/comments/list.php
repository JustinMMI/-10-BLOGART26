<?php
include '../../../header.php'; // contains the header and call to config.php

//Load all statuts
$comments = sql_select(
    "comment c
     INNER JOIN membre m ON c.numMemb = m.numMemb
     INNER JOIN article a ON c.numArt = a.numArt",
    "a.libTitrArt,
     m.pseudoMemb,
     c.dtCreaCom,
     c.libCom,
     c.numCom",
    null,
    null,
    "c.dtCreaCom DESC"
);
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <a href="create.php" class="btn btn-success">Create</a>
            <h1>Commentaires en attentes</h1>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Titre Article</th>
                        <th>Pseudo</th>
                        <th>Date</th>
                        <th>Contenue</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($comments as $comment) { ?>
                        <tr>
                            <td><?php echo $comment['libTitrArt']; ?></td>
                            <td><?php echo $comment['pseudoMemb']; ?></td>
                            <td><?php echo $comment['dtCreaCom']; ?></td>
                            <td><?php echo $comment['libCom']; ?></td>
                            <td>
                                <a href="edit.php?numCom=<?php echo $comment['numCom']; ?>" class="btn btn-warning">
                                    Edit
                                </a>
                                <a href="controle.php?numCom=<?php echo $comment['numCom']; ?>" class="btn btn-danger">
                                    Controle
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <h1>Commentaires en contrôlés</h1>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Pseudo</th>
                        <th>Dernière Modification</th>
                        <th>Contenue</th>
                        <th>Publication</th>
                        <th>Raison refus</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($comments as $comment) { ?>
                        <tr>
                            <td><?php echo $comment['libTitrArt']; ?></td>
                            <td><?php echo $comment['pseudoMemb']; ?></td>
                            <td><?php echo $comment['dtCreaCom']; ?></td>
                            <td><?php echo $comment['libCom']; ?></td>
                            <td>
                                <a href="edit.php?numCom=<?php echo $comment['numCom']; ?>" class="btn btn-warning">
                                    Edit
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <h1>Suppression logique</h1>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Pseudo</th>
                        <th>Date suppr logique</th>
                        <th>Contenue</th>
                        <th>Publication</th>
                        <th>Raison refus</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($comments as $comment) { ?>
                        <tr>
                            <td><?php echo $comment['libTitrArt']; ?></td>
                            <td><?php echo $comment['pseudoMemb']; ?></td>
                            <td><?php echo $comment['dtCreaCom']; ?></td>
                            <td><?php echo $comment['libCom']; ?></td>
                            <td>
                                <a href="edit.php?numCom=<?php echo $comment['numCom']; ?>" class="btn btn-warning">
                                    Edit
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <h1>Suppression Physique</h1>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Pseudo</th>
                        <th>Date suppr logique</th>
                        <th>Contenue</th>
                        <th>Publication</th>
                        <th>Raison refus</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($comments as $comment) { ?>
                        <tr>
                            <td><?php echo $comment['libTitrArt']; ?></td>
                            <td><?php echo $comment['pseudoMemb']; ?></td>
                            <td><?php echo $comment['dtCreaCom']; ?></td>
                            <td><?php echo $comment['libCom']; ?></td>
                            <td>
                                <a href="delete.php?numCom=<?php echo $comment['numCom']; ?>" class="btn btn-danger">
                                    Controle
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php

include '../../../footer.php'; // contains the footer