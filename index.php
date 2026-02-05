<?php 
require_once 'header.php';

// Zone PHP principale de la page d'accueil
// Récupérer l'article épinglé depuis le fichier JSON
$featured_epingle = null;
$pinFileContent = json_decode(file_get_contents('functions/pinned_article.json'), true);
if ($pinFileContent['numArt']) {
    $epingled = sql_select("ARTICLE", "*", "numArt = " . (int)$pinFileContent['numArt']);
    $featured_epingle = !empty($epingled) ? $epingled[0] : null;
}

// Récupérer les 6 derniers articles
$articles = sql_select("ARTICLE", "*", null, null, "dtCreaArt DESC", "6");
?>

<!-- HERO -->
<section class="hero">
  <!-- Bandeau principal -->
  <div class="hero-inner">
    <h1>
      Bordeaux à travers<br>
      <span class="highlight">sa gastronomie</span>
    </h1>
    <span class="hero-separator"></span>
    <p>
      Explorez les saveurs, les talents et les lieux qui font de Bordeaux une
      capitale de la Gastronomie
    </p>
  </div>

  <a href="/views/frontend/articles-list.php" class="hero-cta gold-corners">
    Voir tous les articles →
    <span class="coin-tl"></span>
    <span class="coin-tr"></span>
    <span class="coin-bl"></span>
    <span class="coin-br"></span>
  </a>
</section>

<!-- CONTENU -->
<main class="page-content">

<?php if (!empty($articles)): ?>
  <?php $featured = $articles[0]; ?>

<section class="featured-section">
  <div class="container featured-layout">

    <!-- ARTICLE À LA UNE -->
    <div class="featured-main">
      <h2 class="section-title">À la une<div class="trait-dore-alaune"></div></h2>
      <?php if ($featured_epingle): ?>
        <!-- ARTICLE ÉPINGLÉ -->
        <article class="featured-article featured-pinned">
          <img src="/src/uploads/<?= htmlspecialchars($featured_epingle['urlPhotArt']) ?>" alt="">
          <div class="featured-meta">
            <span class="date">
              <?= date('d F Y', strtotime($featured_epingle['dtCreaArt'])) ?>
            </span>
            <h3><?= htmlspecialchars($featured_epingle['libTitrArt']) ?></h3>
            <p><?= nl2br(htmlspecialchars($featured_epingle['libChapoArt'])) ?></p>

            <a class="read-more"
               href="/views/frontend/articles/article1.php?numArt=<?= (int)$featured_epingle['numArt'] ?>">
              Lire la suite →
            </a>
          </div>
        </article>
      <?php endif; ?>

      <!-- DERNIER ARTICLE PUBLIÉ -->
      <article class="featured-article">
        <img src="/src/uploads/<?= htmlspecialchars($featured['urlPhotArt']) ?>" alt="">
        <div class="featured-meta">
          <span class="date">
            <?= date('d F Y', strtotime($featured['dtCreaArt'])) ?>
          </span>
          <h3><?= htmlspecialchars($featured['libTitrArt']) ?></h3>
          <p><?= nl2br(htmlspecialchars($featured['libChapoArt'])) ?></p>

          <a class="read-more"
            href="/views/frontend/articles/article1.php?numArt=<?= (int)$featured['numArt'] ?>">
            Lire la suite →
          </a>
        </div>
      </article>

      <!-- Boutons principaux -->
      <div class="view-all-wrapper">
        <a href="/views/frontend/articles-list.php" class="btn btn-primary btn-lg">
          Voir tous les articles →
        </a>
        <a href="/views/frontend/contact.php" class="btn btn-primary btn-lg">
            Contactez-nous →
        </a>
      </div>
    </div>

 <?php // Index - articles par themes

  // Récup des articles les + récents
  $articlesRecup = sql_select(
  "article a",
  "a.numThem,
  a.numArt,
  a.libTitrArt",
  null,
  null,
  "a.dtCreaArt DESC",
);

// Récupérer les thématiques
$thematiques = sql_select("THEMATIQUE", "numThem, libThem");

// Prépa du tableau par thématique
$trieArticles = [];
foreach ($thematiques as $them) {
  $trieArticles[$them['numThem']] = [];
}

// Rangement des articles dans leur thème
foreach ($articlesRecup as $article) {
  $trieArticles[$article['numThem']][] = ['titre' => $article['libTitrArt'],'numArt' => $article['numArt']];
}

// Classes visuelles dispo
$sidebarClasses = [
  'sidebar-red coins-dore',
  'sidebar-light',
  'sidebar-black',
  'sidebar-light-inverse'
];
?>


    <!-- SIDEBAR -->
    <aside class="featured-sidebar">

      <a href="/views/frontend/articles-list.php" class="hero-cta gold-corners">
        Voir tous les articles →
        <span class="coin-tl"></span>
        <span class="coin-tr"></span>
        <span class="coin-bl"></span>
        <span class="coin-br"></span>
      </a>

      <?php foreach ($thematiques as $index => $them): ?>
        <?php
          $boxClass = $sidebarClasses[$index % count($sidebarClasses)];
          $listeArticles = $trieArticles[$them['numThem']] ?? [];
        ?>

        <!-- Carte thématique -->
        <div class="sidebar-box <?= htmlspecialchars($boxClass) ?>">
          <?php if ($boxClass === 'sidebar-red coins-dore'): ?>
            <span class="coin-tl"></span>
            <span class="coin-tr"></span>
            <span class="coin-bl"></span>
            <span class="coin-br"></span>
          <?php endif; ?>

          <h4><?= htmlspecialchars($them['libThem']) ?></h4>
          <div class="trait-dore"></div>
            <ul>
          <?php foreach (array_slice($listeArticles, 0, 5) as $article): ?>
              <li>
                  <a href="views/frontend/articles/article1.php?numArt=<?= urlencode($article['numArt']) ?>">
                      <?= htmlspecialchars($article['titre']) ?>
                  </a>
              </li>
          <?php endforeach; ?>
          </ul>
          <div class="trait-dore-petit"></div>
          <a class="sidebar-link" href="/views/frontend/articles-list.php?search=&keywords=&them=<?= (int)$them['numThem'] ?>">Voir tous →</a>
        </div>
        
      <?php endforeach; ?>
      <div class="sidebar-light">
      <div class="map-wrapper">
        <iframe src="https://www.google.com/maps/embed?pb=!1m16!1m12!1m3!1d22637.968251198658!2d-0.5570560254383343!3d44.82673834480565!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!2m1!1srestaurants%20gastronomiques%20Bordeaux!5e0!3m2!1sfr!2sfr!4v1770297548553!5m2!1sfr!2sfr" width="100%" height="250" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"> </iframe>
      </div>
    </div>

    </aside>
  </div>
</section>

<?php else: ?>
  <!-- MESSAGE PAS D'ARTICLES -->
  <section class="no-articles-section" style="text-align: center; padding: 60px 20px;">
    <div class="container">
      <div class="no-articles-content">
        <h2>Il n'y a pas d'articles pour l'instant</h2>
        
        <?php if (!empty($_SESSION['user']) && $_SESSION['user']['statut'] === 'Administrateur'): ?>
          <p>Vous êtes administrateur. Créez le premier article !</p>
          <a href="/views/backend/articles/create.php" class="btn btn-primary btn-lg">
            Créer votre premier article !
          </a>
        <?php else: ?>
          <p>Revenez bientôt pour découvrir du contenu passionnant.</p>
        <?php endif; ?>
      </div>
    </div>
  </section>

<?php endif; ?>

</main>

<?php require_once 'footer.php'; ?>