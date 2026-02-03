<?php
include '../../../header.php'; 


$membres = sql_select("MEMBRE m INNER JOIN STATUT s ON m.numStat = s.numStat","m.*, s.libStat");
?>

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
                        <th>Accord RGPD</th>
                        <th>Statut</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($membres as $membre) { ?>
                        <tr>
                            <td><?php echo $membre['numMemb']; ?></td>
                            <td><?php echo $membre['prenomMemb']; ?></td>
                            <td><?php echo $membre['nomMemb']; ?></td>
                            <td><?php echo $membre['pseudoMemb']; ?></td>
                            <td><?php echo $membre['eMailMemb']; ?></td>
                            <td><?php echo ($membre['accordMemb'] == 1 ? 'Oui' : 'Non'); ?></td>
                            <td><?php echo $membre['libStat']; ?></td>
                            <td>
                                <a href="edit.php?numMemb=<?php echo $membre['numMemb']; ?>" class="btn btn-warning">Edit</a>

                               <?php
                               
                                $rqAdminCount = $DB->query("SELECT COUNT(*) FROM membre WHERE numStat = 1");
                                $adminCount = $rqAdminCount->fetchColumn();

                                if ($membre['numStat'] == 1 && $adminCount == 1) { ?>
                                    <button class="btn btn-danger" disabled>
                                        Impossible de supprimer le dernier administrateur
                                    </button>
                                <?php } else { ?>
                                    <a href="delete.php?numMemb=<?php echo $membre['numMemb']; ?>" class="btn btn-danger">
                                        Delete
                                    </a>
                                <?php } ?>

                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>

            <a href="create.php" class="btn btn-success">Create</a>
        </div>
    </div>
</div>

<?php include '../../../footer.php'; ?>
