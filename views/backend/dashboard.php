<?php
include '../../header.php';

?>

<?php


require_once $_SERVER['DOCUMENT_ROOT'] . '/functions/admin_guard.php';

requireAdmin('page');

if ($_SESSION['user']['statut'] !== 'Administrateur'&& $_SESSION['user']['statut'] !== 'Modérateur'&& $_SESSION['user']['statut'] !== 'Modérateur'
) {
    echo "⛔ Accès réservé aux admins et modérateurs.";
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
                            <th>Paramètres</th>
                            <th>Description de l'action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <a href="/views/backend/statuts/list.php" class="btn btn-primary">Statuts</a>
                            </td>
                            <td>
                                <p>Liste des statuts pour l'edit, la suppression et la création.</p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <a href="/views/backend/members/list.php" class="btn btn-primary">Membres</a>
                            </td>
                            <td>Liste des membres pour l'edit, la suppression et la création.</td>
                        </tr>
                        <tr>
                            <td>
                                <a href="/views/backend/articles/list.php" class="btn btn-primary">Articles</a>
                                </td>
                            <td>Liste des articles pour l'edit, la suppression, la création et l'épinglage.</td>
                        </tr>
                        <tr>
                            <td>
                                <a href="/views/backend/thematiques/list.php" class="btn btn-primary">Thématiques</a>
                                </td>
                            <td>Liste des thématiques pour l'edit, la suppression et la création.</td>
                        </tr>
                        <tr>
                            <td>
                                <a href="/views/backend/comments/list.php" class="btn btn-primary">Commentaires</a>
                                </td>
                            <td>Liste des commentaires en attentes, contrôles et dans la corbeille pour le contrôle et la gestion de la suppression.</td>
                        </tr>
                        <tr>
                            <td>
                                <a href="/views/backend/likes/list.php" class="btn btn-primary">Likes</a>
                                </td>
                            <td>Liste des likes par membre associés à l’article.</td>
                        </tr>
                        <tr>
                            <td>
                                <a href="/views/backend/keywords/list.php" class="btn btn-primary">Mot-clés</a>
                            </td>
                            <td>Liste des mots-clés pour l'edit, la suppression ou la création.</td>
                        </tr>
                    </tbody>
            </div>
        </div>
    </div>
</div>