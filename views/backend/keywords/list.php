<?php
include '../../../header.php'; // contains the header and call to config.php

//Load all keywords
$keywords = sql_select("motclearticle", "*");
?>

<!-- Bootstrap default layout to display all keywords in foreach -->
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
                            <td><?php echo($keyword['numArt']); ?></td>
                            <td><?php echo($keyword['numMotCle']); ?></td>
                            <td>
                                <a href="edit.php?numArt=<?php echo($keyword['numArt']); ?>" class="btn btn-warning">Edit</a>
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
<?php
include '../../../footer.php'; // contains the footer

