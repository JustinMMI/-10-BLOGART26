<?php
include '../../../header.php';

// 🔐 Connexion requise
if (!isset($_SESSION['user'])) {
	header('Location: /views/backend/security/login.php');
    echo 'Vous devez être connecté pour ajouter un commentaire.';
	exit;
}

// Articles disponibles
$articles = sql_select("ARTICLE", "numArt, libTitrArt", null, null, "dtCreaArt DESC");

$error = '';
if (isset($_GET['error'])) {
	$error = "Veuillez sélectionner un article et saisir un commentaire.";
}
?>

<div class="container mt-4">
	<h1>Ajouter un commentaire</h1>

	<p class="text-muted">
		Connecté en tant que <strong><?= htmlspecialchars($_SESSION['user']['pseudo']); ?></strong>
	</p>

	<?php if ($error): ?>
		<div class="alert alert-danger"><?= htmlspecialchars($error); ?></div>
	<?php endif; ?>

	<form action="<?= ROOT_URL . '/api/comments/create.php'; ?>" method="post">
		<div class="mb-3">
			<label for="numArt" class="form-label">Sélectionnez un article</label>
			<select class="form-select" id="numArt" name="numArt" required>
				<option value="">-- Choisir un article --</option>
				<?php foreach ($articles as $article): ?>
					<option value="<?= (int) $article['numArt']; ?>">
						<?= htmlspecialchars($article['libTitrArt']); ?>
					</option>
				<?php endforeach; ?>
			</select>
		</div>

		<div class="mb-3">
			<label for="libCom" class="form-label">Votre commentaire</label>
			<textarea class="form-control" id="libCom" name="libCom" rows="5" required
				placeholder="Écrivez votre commentaire ici..."></textarea>
			<small class="text-muted d-block mt-2">
				BBCode autorisé : [b]gras[/b], [i]italique[/i], [u]souligné[/u],
				[url=https://exemple.com]lien[/url], :), :D
			</small>
		</div>

		<button class="btn btn-success">Publier le commentaire</button>
		<a href="list.php" class="btn btn-secondary">Retour à la liste</a>
	</form>
</div>

<?php include '../../../footer.php'; ?>