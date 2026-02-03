<?php 
require_once 'header.php';
$articles = sql_select("ARTICLE", "*", null, null, "dtCreaArt DESC", "6");
?>

<!-- HERO -->
<section class="hero">
  <div class="hero-overlay"></div>
  <div class="hero-inner">
    <h1>
      Bordeaux à travers<br>
      <span class="highlight">sa gastronomie</span>
    </h1>
    <span class="hero-separator"></span>
    <p>
      Explorez les saveurs, les talents et les lieux qui font de Bordeaux une
      capitale de la gastronomie française
    </p>
  </div>
</section>

<!-- CONTENU BEIGE -->
<main class="page-content">

<?php if (!empty($articles)): ?>
<?php $featured = $articles[0]; ?>

<section class="featured-section">
  <div class="container featured-layout">

    <!-- ARTICLE A LA UNE -->
    <div class="featured-main">
      <h2 class="section-title">À la une</h2>

      <article class="featured-article">
        <img src="/src/uploads/<?= htmlspecialchars($featured['urlPhotArt']) ?>" alt="">
        <div class="featured-meta">
          <span class="date"><?= date('d F Y', strtotime($featured['dtCreaArt'])) ?></span>
          <h3><?= htmlspecialchars($featured['libTitrArt']) ?></h3>
          <p><?= nl2br(htmlspecialchars($featured['libChapoArt'])) ?></p>
          <a class="read-more" href="/views/frontend/articles/article1.php?numArt=<?= (int)$featured['numArt'] ?>">
            Lire la suite →
          </a>
        </div>
      </article>
    </div>

    <!-- SIDEBAR -->
    <aside class="featured-sidebar">

      <div class="sidebar-box sidebar-red">
        <h4>Événements</h4>
        <div class = 'trait-dore'></div>
        <ul>
          <li>BON ! Festival gourmand</li>
          <li>Gourmet Business meeting</li>
          <li>Place de la comédie à Bordeaux</li>
          <li>Marché des Capucins – Rencontre avec les producteurs</li>
        </ul>
        <a class="sidebar-link" href="#">Voir tous →</a>
      </div>

      <div class="sidebar-box sidebar-light">
        <h4>Acteurs Clés</h4>
        <div class = 'trait-dore'></div>
        <ul>
          <li>Les étoiles qui illuminent Bordeaux</li>
          <li>Sucré – À la croisée de l’art et des saveurs</li>
          <li>Trompe l’œil (Viviente Andrieux)</li>
          <li>Les jeunes chefs qui révolutionnent la ville</li>
        </ul>
        <a class="sidebar-link" href="#">Voir tous →</a>
      </div>

      <div class="sidebar-box sidebar-black">
        <h4>Insolite</h4>
        <div class = 'trait-dore'></div>
        <ul>
          <li>Dans le noir / Exp. sensorielles: Dégustations l'obscurité</li>
          <li>L'autre petit bois - la forêt au coeur dans la salle</li>
          <li>Le chapon Fin / L'élegance dans une grotte</li>
          <li>Les producteurs fournissant les restaurants gastronomiques</li>
        </ul>
        <a class="sidebar-link" href="#">Voir tous →</a>
      </div>
    </aside>

  </div>

  <div class="container text-center view-all-wrapper">
    <a href="/views/frontend/articles-list.php" class="btn btn-primary btn-lg">
        Voir tous les articles →
    </a>
  </div>
</section>


<?php endif; ?>

</main>

<?php require_once 'footer.php'; ?>
