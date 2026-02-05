<?php
include '../../../header.php'; 

$membres = sql_select("MEMBRE m INNER JOIN STATUT s ON m.numStat = s.numStat", "m.*, s.libStat");

$rqAdminCount = $DB->query("SELECT COUNT(*) FROM membre WHERE numStat = 1");
$adminCount = $rqAdminCount->fetchColumn();

$currentUserId = $_SESSION['user']['id'] ?? null;
?>

<!-- Bootstrap default layout to display all statuts in foreach -->
<main class="container my-5">
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
                        <?php foreach ($membres as $membre) { 
                            $memberId = $membre['numMemb'] ?? $membre['NumMemb'] ?? null;
                        ?>
                            <tr>
                                <td><?php e($memberId); ?></td>
                                <td><?php e($membre['prenomMemb']); ?></td>
                                <td><?php e($membre['nomMemb']); ?></td>
                                <td><?php e($membre['pseudoMemb']); ?></td>
                                <td><?php e($membre['eMailMemb']); ?></td>
                                <td><?php e($membre['accordMemb'] == 1 ? 'Oui' : 'Non'); ?></td>
                                <td><?php e($membre['libStat']); ?></td>
                                <td>
                                    <a href="edit.php?numMemb=<?php e($memberId); ?>" class="btn btn-warning">Edit</a>

                                    <?php
                                    if (
                                        ($membre['numStat'] == 1 && $adminCount == 1) || ($memberId == $currentUserId)) { ?>
                                        <button class="btn btn-danger" disabled>
                                            Suppression impossible !
                                        </button>
                                    <?php } else { ?>
                                        <a href="delete.php?numMemb=<?php e($memberId); ?>" class="btn btn-danger">
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
</main>

<?php include '../../../footer.php'; ?>
