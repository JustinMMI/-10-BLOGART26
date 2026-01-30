<?php
require_once '../../../header.php';

$numArt = (int) ($_GET['numArt'] ?? 0);
$article = null;

if ($numArt > 0) {
	$article = sql_select(
		"ARTICLE",
		"numArt, libTitrArt, libChapoArt, dtCreaArt",
		"numArt = $numArt"
	);
	$article = $article[0] ?? null;
}
?>

<div class="container mt-4">
	<?php if ($article): ?>
		<h1><?= htmlspecialchars($article['libTitrArt']); ?></h1>
		<p class="text-muted">Publié le <?= htmlspecialchars($article['dtCreaArt']); ?></p>
		<p><?= nl2br(htmlspecialchars($article['libChapoArt'])); ?></p>

		<?php if (isset($_SESSION['user'])): ?>
			<a class="btn btn-primary" href="<?= ROOT_URL . '/views/frontend/comments/commentaire.php?numArt=' . (int) $article['numArt']; ?>">
				Commenter cet article
			</a>
		<?php else: ?>
			<a class="btn btn-outline-primary" href="<?= ROOT_URL . '/views/backend/security/login.php'; ?>">
				Se connecter pour commenter
			</a>
		<?php endif; ?>
	<?php else: ?>
		<div class="alert alert-warning">Article introuvable.</div>
	<?php endif; ?>
</div>

<?php require_once '../../../footer.php'; ?>