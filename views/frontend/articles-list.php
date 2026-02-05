<?php
require_once '../../header.php';
require_once '../../functions/query/select.php';

$search   = trim($_GET['search'] ?? '');
$them     = (int)($_GET['them'] ?? 0);
$keywords = trim($_GET['keywords'] ?? '');

/* Thématiques */
$thematiques = sql_select("THEMATIQUE", "*", null, null, "libThem ASC");

/* Construction dynamique SQL */
$where  = [];
$joins  = [];
$params = [];

/* Recherche avancée */
if ($search !== '') {
    $input = trim($search);

    preg_match_all('/[""«»‹›]([^""«»‹›]+)[""«»‹›]/', $input, $matches);
    $expressions = $matches[1];
    $remaining = preg_replace('/[""«»‹›][^""«»‹›]+[""«»‹›]/', '', $input);

    $motsSimples = array_filter(
        preg_split('/\s+/', trim($remaining)),
        fn($mot) => $mot !== ''
    );

    $keywordsList = array_merge($expressions, $motsSimples);

    if ($keywordsList) {
        $tabChamps = [
            "a.libTitrArt",
            "a.libChapoArt",
            "a.libAccrochArt",
            "a.parag1Art",
            "a.libSsTitr1Art",
            "a.parag2Art",
            "a.libSsTitr2Art",
            "a.parag3Art",
            "a.libConclArt"
        ];

        $clauses = [];
        foreach ($keywordsList as $k => $word) {
            $or = [];
            foreach ($tabChamps as $champ) {
                $or[] = "$champ LIKE :search$k";
            }
            $clauses[] = '(' . implode(' OR ', $or) . ')';
            $params["search$k"] = "%$word%";
        }

        $where[] = '(' . implode(' AND ', $clauses) . ')';
    }
}

/* Filtre thématique */
if ($them > 0) {
    $where[] = "a.numThem = :them";
    $params['them'] = $them;
}

/* Recherche mots-clés */
if ($keywords !== '') {
    $joins[] = "
        INNER JOIN MOTCLEARTICLE ma ON a.numArt = ma.numArt
        INNER JOIN MOTCLE mc ON ma.numMotCle = mc.numMotCle
    ";

    $words = preg_split('/\s+/', $keywords);
    $sub   = [];

    foreach ($words as $i => $word) {
        $sub[] = "mc.libMotCle LIKE :kw$i";
        $params["kw$i"] = "%$word%";
    }

    $where[] = '(' . implode(' OR ', $sub) . ')';
}

/* SQL final */
$sql = "
    SELECT DISTINCT a.*, t.libThem
    FROM ARTICLE a
    LEFT JOIN THEMATIQUE t ON a.numThem = t.numThem
    " . implode(' ', $joins);

if ($where) {
    $sql .= " WHERE " . implode(' AND ', $where);
}

$sql .= " ORDER BY a.dtCreaArt DESC";

/* Exécution */
sql_connect();
global $DB;

$stmt = $DB->prepare($sql);
$stmt->execute($params);
$articles = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<link rel="stylesheet" href="/src/css/articles-list.css">

<div class="articles-page">
  <div class="articles-container">

    <h1 class="articles-title">Tous les articles</h1>

    <!-- FILTRES -->
    <form method="GET" class="articles-filters">

      <input type="text"
             name="search"
             placeholder="Rechercher un article…"
             value="<?= htmlspecialchars($search) ?>">

      <input type="text"
             name="keywords"
             placeholder="Mots-clés (ex : vin chef bio)"
             value="<?= htmlspecialchars($keywords) ?>">

      <select name="them">
        <option value="">Toutes les thématiques</option>
        <?php foreach ($thematiques as $t): ?>
          <option value="<?= (int)$t['numThem'] ?>"
            <?= $them === (int)$t['numThem'] ? 'selected' : '' ?>>
            <?= htmlspecialchars($t['libThem']) ?>
          </option>
        <?php endforeach; ?>
      </select>

      <button type="submit">Filtrer</button>
    </form>

    <!-- LISTE ARTICLES -->
    <?php if ($articles): ?>
      <div class="articles-grid">

        <?php foreach ($articles as $article): ?>
          <?php
            $numArt  = (int)$article['numArt'];
            $numMemb = $_SESSION['user']['id'] ?? null;
            $userLiked = false;

            if ($numMemb) {
                $check = sql_select(
                    "likeart",
                    "*",
                    "numMemb = $numMemb AND numArt = $numArt"
                );
                $userLiked = !empty($check);
            }
          ?>

          <article class="article-card">

            <?php if (!empty($article['urlPhotArt'])): ?>
              <img src="/src/uploads/<?= htmlspecialchars($article['urlPhotArt']) ?>"
                   alt="<?= htmlspecialchars($article['libTitrArt']) ?>"
                   class="article-card-image">
            <?php endif; ?>

            <div class="article-card-body">

              <div class="article-meta">
                <span class="article-date">
                  <?= date('d F Y', strtotime($article['dtCreaArt'])) ?>
                </span>

                <?php if (!empty($article['libThem'])): ?>
                  <span class="article-theme">
                    <?= htmlspecialchars($article['libThem']) ?>
                  </span>
                <?php endif; ?>
              </div>

              <h2 class="article-card-title">
                <?php e($article['libTitrArt']); ?>
              </h2>

              <p class="article-card-excerpt">
                <?php e($article['libChapoArt']); ?>
              </p>

              <div class="article-card-footer">

                <a class="read-link"
                   href="/views/frontend/articles/article1.php?numArt=<?= $numArt ?>">
                  Lire la suite →
                </a>

                <?php if ($numMemb): ?>
                    <?php $likeCount = getLikeCount($numArt); ?>

                    <button
                        type="button"
                        class="like-btn <?= $userLiked ? 'liked' : '' ?>"
                        data-art="<?= $numArt ?>"
                        data-liked="<?= $userLiked ? '1' : '0' ?>"
                        title="J’aime">
                        <span class="heart">♥</span>
                        <span class="like-count"><?= $likeCount ?></span>
                    </button>
                <?php else: ?>
                  <a href="/views/backend/security/login.php"
                     class="like-btn"
                     title="Se connecter">
                    <span class="heart">♡</span>
                  </a>
                <?php endif; ?>

              </div>
            </div>
          </article>

        <?php endforeach; ?>

      </div>
    <?php else: ?>
      <div class="no-articles">
        <p>Aucun article ne correspond à votre recherche.</p>
      </div>
    <?php endif; ?>

  </div>
</div>

<script>
document.querySelectorAll('button.like-btn').forEach(btn => {
  btn.addEventListener('click', function (e) {
    e.preventDefault();

    const numArt = this.dataset.art;
    const liked  = this.dataset.liked === '1';

    fetch('/api/likes/create.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
      body: new URLSearchParams({
        numArt: numArt,
        frontend: 'true'
      })
    }).then(() => {
        this.classList.toggle('liked');

        const countSpan = this.querySelector('.like-count');
        let count = parseInt(countSpan.textContent, 10);

        countSpan.textContent = liked ? count - 1 : count + 1;
        this.dataset.liked = liked ? '0' : '1';
    });
  });
});
</script>

<?php require_once '../../footer.php'; ?>
