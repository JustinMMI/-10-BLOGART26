<?php
include '../../../header.php'; // contains the header and call to config.php
require_once $_SERVER['DOCUMENT_ROOT'] . '/functions/admin_guard.php';

requireAdmin('page');
//Load all statuts
$thematiques = sql_select("thematique", "*");
?>

 <!-- Bootstrap default layout to display all statuts in foreach -->
<main class="container my-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Thématiques</h1>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Nom des thématiques</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($thematiques as $thematique){ ?>
                            <tr>
                                <td><?php echo($thematique['numThem']); ?></td>
                                <td><?php echo($thematique['libThem']); ?></td>
                                <td>
                                    <a href="edit.php?numThem=<?php echo($thematique['numThem']); ?>" class="btn btn-warning">Edit</a>
                                    <a href="delete.php?numThem=<?php echo($thematique['numThem']); ?>" class="btn btn-danger">Delete</a>
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
<?php
include '../../../footer.php'; // contains the footer
