<?php
require_once '../../../header.php';
?>

<div class="container">
    <h2>Liker Article</h2>
    <form action="../../../api/likes/create.php" method="POST">
        <div class="mb-3">
            <label for="numMemb" class="form-label">Membre :</label>
            <select name="numMemb" id="numMemb" class="form-select">
                <option value="">- - - Choisissez un membre - - -</option>
                </select>
        </div>

        <div class="mb-3">
            <label for="numArt" class="form-label">Article :</label>
            <select name="numArt" id="numArt" class="form-select">
                <option value="">- - - Choisissez un article - - -</option>
                </select>
        </div>

        <p class="text-danger">
            [cite_start]<strong>Remarque :</strong> Dès le membre sélectionné, seuls les articles non encore likés par ce membre s'afficheront. [cite: 29]
        </p>

        <div class="mt-4">
            <a href="list.php" class="btn btn-outline-secondary">List</a>
            <button type="submit" class="btn btn-success">Create</button>
        </div>
    </form>
</div>

<?php require_once '../../../footer.php'; ?>