<?php
// On inclut le header qui démarre déjà la session
require_once 'header.php'; 

// IMPORTANT : On capture la connexion dans $db
$db = sql_connect(); 

// DEBUG : Affiche ce qu'il y a dans ta session (supprime ces 3 lignes une fois le problème trouvé)
// echo '<pre style="background: white; padding: 10px; border: 1px solid red;">SESSION CONTENU : ';
// var_dump($_SESSION);
// echo '</pre>';

// Récupération des articles
$articles = sql_select("ARTICLE", "*");
?>

<div class="container mt-4">
    <h1>Accueil</h1>

    <?php if ($articles): ?>
        <?php foreach ($articles as $article): ?>
            
            <?php
            // --- LOGIQUE DU LIKE ---
            $userLiked = false;
            // On vérifie si numMemb existe, sinon on essaie de deviner d'autres noms courants
            $numMemb = $_SESSION['numMemb'] ?? null; 
            
            $numArt = $article['numArt'];

            if ($numMemb) {
                // Vérifie si déjà liké
                $sqlCheck = "SELECT * FROM `LIKE` WHERE numMemb = '$numMemb' AND numArt = '$numArt'";
                
                // On vérifie que $db n'est pas vide pour éviter l'erreur rouge
                if ($db) {
                    $resultCheck = $db->query($sqlCheck);
                    if ($resultCheck && $resultCheck->rowCount() > 0) {
                        $userLiked = true;
                    }
                }
            }
            // -----------------------
            ?>

            <div class="card mt-3">
                <div class="card-body">
                    <h2 class="card-title"><?= htmlspecialchars($article['libTitrArt']); ?></h2>
                    <p class="text-muted mb-2">Publié le <?= htmlspecialchars($article['dtCreaArt']); ?></p>
                    <p class="card-text"><?= nl2br(htmlspecialchars($article['libChapoArt'])); ?></p>
                    
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <a class="btn btn-primary" href="views/frontend/articles/article1.php?numArt=<?= $article['numArt']; ?>">Lire l’article</a>

                        <div class="like-container">
                            <?php if ($numMemb): ?>
                                <?php if ($userLiked): ?>
                                    <form action="api/likes/delete.php" method="POST">
                                        <input type="hidden" name="numMemb" value="<?= $numMemb ?>">
                                        <input type="hidden" name="numArt" value="<?= $numArt ?>">
                                        <input type="hidden" name="frontend" value="true">
                                        <button type="submit" class="btn btn-danger btn-sm">❤️ Je n'aime plus</button>
                                    </form>
                                <?php else: ?>
                                    <form action="api/likes/create.php" method="POST">
                                        <input type="hidden" name="numMemb" value="<?= $numMemb ?>">
                                        <input type="hidden" name="numArt" value="<?= $numArt ?>">
                                        <input type="hidden" name="frontend" value="true">
                                        <button type="submit" class="btn btn-outline-danger btn-sm">🤍 J'aime</button>
                                    </form>
                                <?php endif; ?>
                            <?php else: ?>
                                <small class="text-muted"><a href="views/security/login.php">Se connecter</a> pour liker</small>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="alert alert-info mt-3">Aucun article disponible.</div>
    <?php endif; ?>
</div>

<?php require_once 'footer.php'; ?>