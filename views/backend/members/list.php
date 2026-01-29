<?php
include '../../../header.php'; // contains the header and call to config.php

$ghostUserId = 999;

$membres = sql_select(
    "MEMBRE m INNER JOIN STATUT s ON m.numStat = s.numStat",
    "m.*, s.libStat",
    "m.numMemb <> $ghostUserId"
);

?>

<!-- Bootstrap default layout to display all statuts in foreach -->
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Membres</h1>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Prénom</th>
                        <th>Nom</th>
                        <th>Pseudo</th>
                        <th>Email</th>
                        <th>Date création</th>
                        <th>Dernière maj</th>
                        <th>Nom statut</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($membres as $membre){ ?>
                        <tr>
                            <td><?php echo($membre['numMemb']); ?></td>
                            <td><?php echo($membre['prenomMemb']); ?></td>
                            <td><?php echo($membre['nomMemb']); ?></td>
                            <td><?php echo($membre['pseudoMemb']); ?></td>
                            <td><?php echo($membre['eMailMemb']); ?></td>
                            <td><?php echo($membre['dtCreaMemb']); ?></td>
                            <td><?php echo($membre['dtMajMemb']); ?></td>
                            <td><?php echo($membre['libStat']); ?></td>
                            <td>
                                <a href="edit.php?numMemb=<?php echo($membre['numMemb']); ?>" class="btn btn-warning">Edit</a>
                                <a href="delete.php?numMemb=<?php echo($membre['numMemb']); ?>" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <a href="create.php" class="btn btn-success">Create</a>
        </div>
    </div>
</div>
<?php
include '../../../footer.php'; // contains the footer