<?php 
require_once 'header.php';

// Récupérer l'article épinglé depuis le fichier JSON
$featured_epingle = null;
$pinFileContent = json_decode(file_get_contents('pinned_article.json'), true);
if ($pinFileContent['numArt']) {
    $epingled = sql_select("ARTICLE", "*", "numArt = " . (int)$pinFileContent['numArt']);
    $featured_epingle = !empty($epingled) ? $epingled[0] : null;
}

// Récupérer les 6 derniers articles
$articles = sql_select("ARTICLE", "*", null, null, "dtCreaArt DESC", "6");
$featured = $articles[0];
?>

<!-- HERO -->
<section class="hero">
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
      <h2 class="section-title">À la une</h2>

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

      <!-- CTA déplacé ici -->
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

    $articlesRecup = sql_select(
    "article a",
    "a.numThem,
    a.numArt,
    a.libTitrArt",
    null,
    null,
    null,
);

$trieArticles = [
    1 => [],
    2 => [],
    3 => [],
    4 => []
];

foreach ($articlesRecup as $article) {
    $trieArticles[$article['numThem']][] = ['titre' => $article['libTitrArt'],'numArt' => $article['numArt']];
}
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

      <div class="sidebar-box sidebar-red coins-dore">
        <span class="coin-tl"></span>
        <span class="coin-tr"></span>
        <span class="coin-bl"></span>
        <span class="coin-br"></span>

        <h4>Événements</h4>
        <div class="trait-dore"></div>
        <ul>
        <?php foreach ($trieArticles[1] as $article): ?>
            <li>
                <a href="views/frontend/articles/article1.php?numArt=<?= urlencode($article['numArt']) ?>">
                    <?= htmlspecialchars($article['titre']) ?>
                </a>
            </li>
        <?php endforeach; ?>
        </ul>
        <div class="trait-dore-petit"></div>
        <a class="sidebar-link" href="http://blogart26.local/views/frontend/articles-list.php?search=&keywords=&them=1">Voir tous →</a>
      </div>

      <div class="sidebar-box sidebar-light">
        <h4>Acteurs Clés</h4>
        <div class="trait-dore"></div>
        <ul>
        <?php foreach ($trieArticles[2] as $article): ?>
            <li>
                <a href="views/frontend/articles/article1.php?numArt=<?= urlencode($article['numArt']) ?>">
                    <?= htmlspecialchars($article['titre']) ?>
                </a>
            </li>
        <?php endforeach; ?>
        </ul>
        <div class="trait-dore-petit"></div>
        <a class="sidebar-link" href="http://blogart26.local/views/frontend/articles-list.php?search=&keywords=&them=2">Voir tous →</a>
      </div>

      <div class="sidebar-box sidebar-black">
        <h4>Mouvement émergeant</h4>
        <div class="trait-dore"></div>
        <ul>
        <?php foreach ($trieArticles[3] as $article): ?>
            <li>
                <a href="views/frontend/articles/article1.php?numArt=<?= urlencode($article['numArt']) ?>">
                    <?= htmlspecialchars($article['titre']) ?>
                </a>
            </li>
        <?php endforeach; ?>
        </ul>
        <div class="trait-dore-petit"></div>
        <a class="sidebar-link" href="http://blogart26.local/views/frontend/articles-list.php?search=&keywords=&them=4">Voir tous →</a>
      </div>


      <div class="sidebar-box sidebar-light-inverse">
        <h4>Insolite</h4>
        <div class="trait-dore"></div>
        <ul>
        <?php foreach ($trieArticles[4] as $article): ?>
            <li class="blanc1">
                <a href="views/frontend/articles/article1.php?numArt=<?= urlencode($article['numArt']) ?>">
                    <?= htmlspecialchars($article['titre']) ?>
                </a>
            </li>
        <?php endforeach; ?>
        </ul>
        <div class="trait-dore-petit"></div>
        <a class="sidebar-link" href="http://blogart26.local/views/frontend/articles-list.php?search=&keywords=&them=2">Voir tous →</a>
      </div>


    </aside>
  </div>
</section>

<?php endif; ?>

</main>

<?php require_once 'footer.php'; ?>