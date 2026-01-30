<?php
require_once '../../../header.php'; 

?>

<div class="container">
    <h2>Articles (Un) Likes</h2>
    <a href="create.php" class="btn btn-primary mb-3">Create</a>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Membre</th>
                <th>Titre Article</th>
                <th>Chapeau Article</th>
                <th>Statut</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Admin99 (1)</td>
                <td>La surprenante reconversion de la base sous-marine</td>
                <td>Un bâtiment unique chargé d'histoire...</td>
                <td>like</td>
                <td>
                    <a href="edit.php?id1=1&id2=1" class="btn btn-sm btn-warning">Edit</a>
                    <a href="delete.php?id1=1&id2=1" class="btn btn-sm btn-danger">Delete</a>
                </td>
            </tr>
            </tbody>
    </table>
</div>

<?php require_once '../../../footer.php'; ?>