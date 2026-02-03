<?php
include '../../../header.php'; // contains the header and call to config.php

//Load all keywords
$keywords = sql_select("motcle", "*");
?>

<!-- Bootstrap default layout to display all statuts in foreach -->
<main class="container my-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Mots-clés</h1>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Nom des mots-clés</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($keywords as $keyword){ ?>
                            <tr>
                                <td><?php echo($keyword['numMotCle']); ?></td>
                                <td><?php echo($keyword['libMotCle']); ?></td>
                                <td>
                                    <a href="edit.php?numMotCle=<?php echo($keyword['numMotCle']); ?>" class="btn btn-warning">Edit</a>
                                    <a href="delete.php?numMotCle=<?php echo($keyword['numMotCle']); ?>" class="btn btn-danger">Delete</a>
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

