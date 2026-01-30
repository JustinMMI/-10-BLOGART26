<?php
require_once '../../../header.php';
?>

<div class="container">
    <h2>Suppression Article (Un) Liké</h2>
    <form action="../../../api/likes/delete.php" method="POST">
        <div class="mb-3">
            <label class="form-label">Membre</label>
            <input type="text" class="form-control" value="juju1989 (numéro 3)" disabled>
        </div>

        <div class="mb-3">
            <label class="form-label">Article</label>
            <input type="text" class="form-control" value="Le Lion bleu de Bordeaux, star des réseaux sociaux" disabled>
        </div>

        <div class="mb-3">
            <label class="form-label">Article liké?</label>
            <p><strong>Like</strong></p> </div>

        <div class="mt-4">
            <a href="list.php" class="btn btn-outline-secondary">List</a>
            <button type="submit" class="btn btn-danger">Confirmer Delete ?</button>
        </div>
    </form>
</div>

<?php require_once '../../../footer.php'; ?>