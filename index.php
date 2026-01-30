<?php 
require_once 'header.php';
$db = sql_connect();

$sql = "SELECT * FROM article ORDER BY dtCreaArt DESC";
$request = $db->query($sql);
$articles = $request->fetchAll();

cookie_notice();
?>

<div class="container mt-5">
    <div class="row">
        <?php foreach ($articles as $article): ?>
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <?php if (!empty($article['urlPhotArt'])): ?>
                        <img src="src/uploads/<?php echo $article['urlPhotArt']; ?>" class="card-img-top" alt="Image article" style="height: 200px; object-fit: cover;">
                    <?php endif; ?>
                    
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $article['libTitrArt']; ?></h5>
                        <p class="card-text"><?php echo substr($article['libChapoArt'], 0, 100); ?>...</p>
                        
                        <?php 
                        if (isset($_SESSION['numMemb'])) {
                            $numMemb = $_SESSION['numMemb'];
                            $numArt = $article['numArt'];

                            $sqlLike = "SELECT * FROM `LIKE` WHERE numMemb = '$numMemb' AND numArt = '$numArt'";
                            $resultLike = $db->query($sqlLike);
                            $userLiked = ($resultLike && $resultLike->rowCount() > 0);
                        ?>

                        <div class="mt-3">
                            <?php if ($userLiked): ?>
                                <form action="api/likes/delete.php" method="POST">
                                    <input type="hidden" name="numMemb" value="<?php echo $numMemb; ?>">
                                    <input type="hidden" name="numArt" value="<?php echo $numArt; ?>">
                                    <input type="hidden" name="frontend" value="true">
                                    <button type="submit" class="btn btn-danger">
                                        Je n'aime plus
                                    </button>
                                </form>
                            <?php else: ?>
                                <form action="api/likes/create.php" method="POST">
                                    <input type="hidden" name="numMemb" value="<?php echo $numMemb; ?>">
                                    <input type="hidden" name="numArt" value="<?php echo $numArt; ?>">
                                    <input type="hidden" name="frontend" value="true">
                                    <button type="submit" class="btn btn-outline-danger">
                                        J'aime
                                    </button>
                                </form>
                            <?php endif; ?>
                        </div>

                        <?php } else { ?>
                            <div class="mt-3">
                                <a href="views/security/login.php" class="btn btn-sm btn-secondary">Se connecter pour liker</a>
                            </div>
                        <?php } ?>

                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php require_once 'footer.php'; ?>

<script>
function onSubmit(token) {
    document.getElementById("recaptcha").submit();
    console.log(document.getElementById("recaptcha"));
}
</script>