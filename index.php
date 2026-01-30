<?php 
require_once 'header.php';
sql_connect();

// Article de test (le plus récent)
$article = sql_select("ARTICLE", "numArt, libTitrArt, libChapoArt, dtCreaArt", null, null, "dtCreaArt DESC", "1");
$article = $article[0] ?? null;
?>

<div class="container mt-4">
	<h1>Accueil</h1>

	<?php if ($article): ?>
		<div class="card mt-3">
			<div class="card-body">
				<h2 class="card-title"><?= htmlspecialchars($article['libTitrArt']); ?></h2>
				<p class="text-muted mb-2">Publié le <?= htmlspecialchars($article['dtCreaArt']); ?></p>
				<p class="card-text"><?= nl2br(htmlspecialchars($article['libChapoArt'])); ?></p>
				<a class="btn btn-primary" href="/views/frontend/articles/article1.php?numArt=<?= (int) $article['numArt']; ?>">Lire l’article</a>
			</div>
		</div>
	<?php else: ?>
		<div class="alert alert-info mt-3">Aucun article disponible.</div>
	<?php endif; ?>
</div>

<?php require_once 'footer.php'; ?>

<script>
function onSubmit(token) {
document.getElementById("recaptcha").submit();
console.log(document.getElementById("recaptcha"));
}
</script>