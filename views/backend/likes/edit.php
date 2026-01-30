<?php
require_once '../../../header.php';

?>

<div class="container">
    <h2>Modification Article (un) Liké</h2>
    <form action="../../../api/likes/update.php" method="POST">
        <div class="mb-3">
            <label class="form-label">Membre</label>
            <input type="text" class="form-control" value="Phil09 (numéro 2)" readonly>
        </div>

        <div class="mb-3">
            <label class="form-label">Article</label>
            <input type="text" class="form-control" value="La surprenante reconversion de la base sous-marine" readonly>
        </div>

        <div class="mb-3">
            <label class="form-label">Article (un) Liké?</label><br>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="statut" id="like" value="1">
                <label class="form-check-label" for="like">Like</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="statut" id="unlike" value="0" checked>
                <label class="form-check-label" for="unlike">Unlike</label>
            </div>
        </div>

        <div class="mt-4">
            <a href="list.php" class="btn btn-outline-secondary">List</a>
            <button type="submit" class="btn btn-primary">Confirmer Edit ?</button>
        </div>
    </form>
</div>

<?php require_once '../../../footer.php'; ?>