<?php
include '../../header.php';

?>

<?php


if (!isset($_SESSION['user'])) {
    header('Location: security/login.php?error=auth');
    exit;
}

// Vérification ADMIN
if ($_SESSION['user']['statut'] !== 'Administrateur') {
    echo "⛔ Accès réservé aux admins.";
    exit;
}
?>

<!-- Bootstrap admin dashboard template -->
<div>
    <hr class="my-3">
    <div style="color: black; font-size: 30px; font-family: Montserrat; font-weight: 400; padding-left: 3rem ;word-wrap: break-word">Liens permettant d'administrer le Blog d'Articles</div>    
    <hr class="my-3">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <p>Bienvenue sur le dashboard !</p>
            </div>
            <div class="col-md-12">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Objets</th>
                            <th>Actions</th>
                            <th>Commentaires</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Statuts</td>
                            <td>
                                <a href="/views/backend/statuts/list.php" class="btn btn-primary">List</a>
                            </td>
                            <td>
                                <p>Exemple fourni, s'y référer pour les autres CRUD</p>
                            </td>
                        </tr>
                        <tr>
                            <td>Membres</td>
                            <td>
                                <a href="/views/backend/members/list.php" class="btn btn-primary">List</a>
                            </td>
                            <td>Pour tous les membres : Inscription, connexion, sécurité et captcha</td>
                        </tr>
                        <tr>
                            <td>Articles</td>
                            <td>
                                <a href="/views/backend/articles/list.php" class="btn btn-primary">List</a>
                                </td>
                            <td>En même temps que l'article : image à intégrer, gestion des mots-clés associés</td>
                        </tr>
                        <tr>
                            <td>Thématiques</td>
                            <td>
                                <a href="/views/backend/thematiques/list.php" class="btn btn-primary">List</a>
                                </td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Commentaires</td>
                            <td>
                                <a href="/views/backend/comments/list.php" class="btn btn-primary">List</a>
                                </td>
                            <td>Gestion côté front et côté back, modération. Utilisation de mise en forme (emojies...)</td>
                        </tr>
                        <tr>
                            <td>Likes</td>
                            <td>
                                <a href="/views/backend/likes/list.php" class="btn btn-primary">List</a>
                                </td>
                            <td>Utilisation de JS</td>
                        </tr>
                        <tr>
                            <td>Mot-clés</td>
                            <td>
                                <a href="/views/backend/keywords/list.php" class="btn btn-primary">List</a>
                            </td>
                            <td></td>
                        </tr>
                    </tbody>
            </div>
        </div>
    </div>
</div>