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
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Admin99 (1)</td>
                <td>La surprenante reconversion de la base sous-marine</td>
                <td>Un bâtiment unique chargé d'histoire...</td>
                <td>like</td>
            </tr>
            </tbody>
    </table>
</div>

<?php require_once '../../../footer.php'; ?>