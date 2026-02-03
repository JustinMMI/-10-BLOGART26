<?php 
include '../../../header.php';

// 🔐 Connexion requise
if (!isset($_SESSION['user'])) {
	header('Location: /views/backend/security/login.php');
    echo 'Vous devez être connecté pour ajouter un commentaire.';
	exit;
}

// Récupération de l'article depuis GET
$numArt = (int) ($_GET['numArt'] ?? 0);

if ($numArt <= 0) {
	header('Location: /');
	exit;
}

$article = sql_select("ARTICLE", "numArt, libTitrArt", "numArt = $numArt");

if (empty($article)) {
	header('Location: /');
	exit;
}

$article = $article[0];

$error = '';
if (isset($_GET['error'])) {
	$error = "Veuillez saisir un commentaire.";
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
		<input type="hidden" name="numArt" value="<?= (int) $article['numArt']; ?>">
		
		<div class="mb-3">
			<label class="form-label">Article sélectionné</label>
			<input type="text" class="form-control" value="<?= htmlspecialchars($article['libTitrArt']); ?>" readonly>
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
		<a href="/views/frontend/articles/article1.php?numArt=<?= (int) $article['numArt']; ?>" class="btn btn-secondary">Retour à l'article</a>
		<input type="hidden" name="redirect"
       value="/views/frontend/articles/article1.php?numArt=<?= (int)$article['numArt']; ?>">
	</form>
</div>

<?php include '../../../footer.php'; ?>