<?php
include '../../../header.php';
?>

<?php
$numCom = $_GET['numCom'] ?? null;

$comments = sql_select(
    "comment c
     INNER JOIN membre m ON c.numMemb = m.numMemb
     INNER JOIN article a ON c.numArt = a.numArt",
    "a.libTitrArt,
     m.pseudoMemb,
     c.dtCreaCom,
     c.libCom,
     c.numCom",
    "c.numCom = " . intval($numCom)
);
$comment = $comments[0];
?>


<form action="<?= ROOT_URL . '/api/comments/update.php'; ?>" method="POST">
  <input type="hidden" name="numCom" value="<?= htmlspecialchars($comment['numCom']) ?>">
  <div class="container">
    <h1 class="text-center mt-5">Contrôle commentaire en attente : à valider</h1>

    <h2 class="mt-5">Titre de l'article</h2>
    <p><?= htmlspecialchars($comment['libTitrArt']) ?></p>

    <h2 class="mt-5">Information commentaire</h2>
    <p>Pseudonyme utilisateur :</p>
    <p><?= htmlspecialchars($comment['pseudoMemb']) ?></p>
    <p>Date de création :</p>
    <p><?= htmlspecialchars($comment['dtCreaCom']) ?></p>

    <h2 class="mt-5">Contenu du commentaire</h2>
    <textarea class="form-control" rows="4"><?= htmlspecialchars($comment['libCom']) ?></textarea>

    <h2 class="mt-5">Validation du commentaire</h2>

    <div class="form-check mt-3">
      <input class="form-check-input" type="radio" name="validation" id="valider" value="1">
      <label class="form-check-label" for="valider">
        Valider le commentaire
      </label>
    </div>

    <div class="form-check">
      <input class="form-check-input" type="radio" name="validation" id="refuser" value="0">
      <label class="form-check-label" for="refuser">
        Refuser le commentaire
      </label>
    </div>

    <h2 class="mt-5">Raison du refus</h2>
    <p>À remplir seulement si le commentaire est refusé</p>

    <textarea class="form-control" rows="4" name="RaisonRefus" placeholder="Expliquez la raison du refus..."></textarea>

    <div class="d-flex justify-content-between mt-5 mb-5">
      <a href="list.php" class="btn btn-primary">Liste</a>
      <button type="submit" class="btn btn-success">Envoyer contrôle</button>
    </div>
  </div>
</form>


