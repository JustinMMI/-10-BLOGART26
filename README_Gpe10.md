# 🍷 BlogArt26 - Bordeaux à travers sa Gastronomie

**Un blog dédié à la scène gastronomique bordelaise**

---

## 📋 Table des matières

- [À propos](#à-propos)
- [Fonctionnalités](#fonctionnalités)
- [Installation](#installation)
- [Architecture du projet](#architecture-du-projet)
- [Base de données](#base-de-données)
- [Accès et identifiants](#accès-et-identifiants)
- [Thématiques et mots-clés](#thématiques-et-mots-clés)
- [RGPD et Mentions légales](#rgpd-et-mentions-légales)
- [URLs](#urls)
- [État du projet](#état-du-projet)
- [Équipe](#équipe)

---

## 🎯 À propos

**BlogArt26** est un blog collaboratif dédié à la gastronomie bordelaise. Le projet explore les saveurs, les talents et les lieux qui font de Bordeaux une capitale de la gastronomie française. 

Le blog présente :
- Des **articles détaillés** sur les événements culinaires
- Les **acteurs clés** de la scène gastronomique locale
- Les **mouvements émergents** dans le secteur alimentaire
- Les **anecdotes insolites** du monde culinaire bordelais

---

## ✨ Fonctionnalités

### Frontend
- ✅ Page d'accueil avec article à la une (épinglé) et dernier article publié
- ✅ Liste complète des articles avec filtrage par thématique et mots-clés
- ✅ Système de recherche avancée
- ✅ Détail des articles avec commentaires
- ✅ Système de likes sur les articles
- ✅ Profil utilisateur avec articles aimés
- ✅ Système de contact
- ✅ Pages RGPD et CGU
- ✅ Responsive design (mobile, tablette, desktop)

### Backend (Administrateur)
- ✅ Gestion complète des articles (CRUD)
- ✅ Gestion des commentaires
- ✅ Gestion des membres
- ✅ Gestion des thématiques
- ✅ Gestion des mots-clés
- ✅ Gestion des statuts des articles
- ✅ Système d'authentification sécurisé
- ✅ Tableau de bord administrateur
- ✅ Système d'épinglage d'articles

---

## 🔐 Accès et identifiants des comptes de test

| Pseudo |  Password   |      Rôle      |           Email            |
|--------|-------------|----------------|----------------------------|
| Admin01| Admin!12345 | Administrateur | admin@blogart26.com        |
| Modo01 | Modo!12345  | Modérateur     | modo@blogart26.com   |
| User01 | User!12345  | Utilisateur    | user@blogart26.com  |

> ⚠️ **IMPORTANT** : Ces identifiants sont pour les tests uniquement. Les mots de passe en production doivent être forts et uniques.

---

## �️ Architecture du projet

### Arborescence complète

```
BLOGART26/
│
├── 📁 api/                           # API REST - Endpoints pour les opérations CRUD
│   ├── 📁 articles/
│   │   ├── create.php                # Création d'articles
│   │   ├── delete.php                # Suppression d'articles
│   │   ├── pin.php                   # Épinglage/désépinglage d'articles
│   │   └── update.php                # Modification d'articles
│   ├── 📁 comments/
│   │   ├── create.php                # Ajout de commentaires
│   │   ├── delete.php                # Suppression de commentaires
│   │   └── update.php                # Modification de commentaires
│   ├── 📁 keywords/
│   │   ├── create.php                # Création de mots-clés
│   │   ├── delete.php                # Suppression de mots-clés
│   │   └── update.php                # Modification de mots-clés
│   ├── 📁 likes/
│   │   ├── create.php                # Ajout d'un like
│   │   ├── delete.php                # Retrait d'un like
│   │   └── update.php                # MAJ des likes
│   ├── 📁 members/
│   │   ├── create.php                # Création de membres
│   │   ├── delete.php                # Suppression de membres
│   │   └── update.php                # Modification de membres
│   ├── 📁 security/
│   │   ├── disconnect.php            # Déconnexion
│   │   ├── login.php                 # Connexion
│   │   └── signup.php                # Inscription
│   ├── 📁 statuts/
│   │   ├── create.php                # Création de statuts
│   │   ├── delete.php                # Suppression de statuts
│   │   └── update.php                # Modification de statuts
│   └── 📁 thematiques/
│       ├── create.php                # Création de thématiques
│       ├── delete.php                # Suppression de thématiques
│       └── update.php                # Modification de thématiques
│
├── 📁 BDD/                           # Scripts SQL de création
│   ├── CreateDbBlogArt26.sql        # Structure de la BDD
│   └── JeuEssaiBlogArt26_OK.sql     # Jeu de données de test
│
├── 📁 BDD_A_Exporter/                # Export final pour production
│   └── (fichiers .sql exportés)
│
├── 📁 classes/                       # Classes PHP métier (POO)
│   └── (classes réutilisables)
│
├── 📁 config/                        # Configuration de l'application
│   ├── debug.php                     # Paramètres de débogage
│   └── defines.php                   # Constantes globales (chemins, etc.)
│
├── 📁 data/                          # Données temporaires/cache
│
├── 📁 functions/                     # Fonctions réutilisables
│   ├── ctrlSaisies.php              # Validation et contrôle des données
│   ├── dateChangeFormat.php         # Conversion de formats de dates
│   ├── getExistPseudo.php           # Vérification d'unicité des pseudos
│   ├── global.inc.php               # Fonctions globales
│   ├── motsCles.js                  # Gestion JavaScript des mots-clés
│   ├── security.php                 # Gestion de sécurité (sessions, cookies)
│   ├── utilErrOn.php                # Gestion des erreurs
│   ├── various.php                  # Fonctions diverses
│   └── 📁 query/                    # Fonctions d'accès à la BDD
│       ├── connect.php               # Connexion à la base de données
│       ├── delete.php                # Fonction générique DELETE
│       ├── insert.php                # Fonction générique INSERT
│       ├── load.php                  # Chargement de données
│       ├── select.php                # Fonction générique SELECT
│       └── update.php                # Fonction générique UPDATE
│
├── 📁 includes/                      # Fichiers à inclure
│   └── 📁 libs/
│       └── DotEnv.php                # Gestion des variables d'environnement
│
├── 📁 src/                           # Assets et ressources statiques
│   ├── 📁 css/
│   │   ├── 404.css                   # Style page 404
│   │   ├── article1.css              # Style détail article
│   │   ├── articles-list.css         # Style liste articles
│   │   ├── commentaire.css           # Style commentaires
│   │   ├── footer.css                # Style pied de page
│   │   ├── header.css                # Style en-tête
│   │   ├── home.css                  # Style page d'accueil
│   │   └── liked-articles.css        # Style articles likés
│   ├── 📁 fonts/                     # Polices personnalisées
│   ├── 📁 images/                    # Images statiques du site
│   ├── 📁 js/
│   │   └── reveal.js                 # Animations/effets JS
│   └── 📁 uploads/                   # Images téléchargées (articles)
│       └── (photos d'articles)
│
├── 📁 views/                         # Pages et vues
│   ├── 📁 backend/                   # Interface d'administration
│   │   ├── dashboard.php             # Tableau de bord admin
│   │   ├── 📁 articles/
│   │   │   ├── create.php            # Formulaire création article
│   │   │   ├── delete.php            # Suppression article
│   │   │   ├── edit.php              # Formulaire édition article
│   │   │   └── list.php              # Liste des articles
│   │   ├── 📁 comments/
│   │   │   ├── create.php            # Formulaire création commentaire
│   │   │   ├── delete.php            # Suppression commentaire
│   │   │   ├── list.php              # Liste des commentaires
│   │   │   └── update.php            # Modification commentaire
│   │   ├── 📁 keywords/
│   │   │   ├── create.php            # Formulaire création mot-clé
│   │   │   ├── delete.php            # Suppression mot-clé
│   │   │   ├── edit.php              # Formulaire édition mot-clé
│   │   │   └── list.php              # Liste des mots-clés
│   │   ├── 📁 likes/
│   │   │   ├── create.php            # Ajout like
│   │   │   ├── delete.php            # Retrait like
│   │   │   ├── edit.php              # Modification like
│   │   │   └── list.php              # Liste des likes
│   │   ├── 📁 members/
│   │   │   ├── create.php            # Formulaire création membre
│   │   │   ├── delete.php            # Suppression membre
│   │   │   ├── edit.php              # Formulaire édition membre
│   │   │   └── list.php              # Liste des membres
│   │   ├── 📁 security/
│   │   │   ├── login.php             # Page de connexion admin
│   │   │   └── signup.php            # Page d'inscription
│   │   ├── 📁 statuts/
│   │   │   ├── create.php            # Formulaire création statut
│   │   │   ├── delete.php            # Suppression statut
│   │   │   ├── edit.php              # Formulaire édition statut
│   │   │   └── list.php              # Liste des statuts
│   │   └── 📁 thematiques/
│   │       ├── create.php            # Formulaire création thématique
│   │       ├── delete.php            # Suppression thématique
│   │       ├── edit.php              # Formulaire édition thématique
│   │       └── list.php              # Liste des thématiques
│   │
│   └── 📁 frontend/                  # Interface publique
│       ├── articles-list.php         # Page liste des articles
│       ├── contact.php               # Formulaire de contact
│       ├── liked-articles.php        # Articles aimés par l'utilisateur
│       ├── profile.php               # Profil utilisateur
│       ├── search.php                # Recherche avancée
│       ├── 📁 articles/
│       │   └── article1.php          # Détail d'un article
│       ├── 📁 comments/
│       │   └── commentaire.php       # Gestion des commentaires
│       └── 📁 rgpd/
│           ├── cgu.php                # Conditions générales d'utilisation
│           └── rgpd.php               # Politique de confidentialité & mentions légales
│
├── 📄 .env                           # Variables d'environnement (NON versionné)
├── 📄 .env.example                   # Exemple de configuration .env
├── 📄 .gitignore                     # Fichiers à ignorer par Git
├── 📄 404.php                        # Page d'erreur 404
├── 📄 config.php                     # Configuration générale de l'application
├── 📄 footer.php                     # Pied de page réutilisable
├── 📄 header.php                     # En-tête réutilisable
├── 📄 index.php                      # Page d'accueil du site
├── 📄 pinned_article.json            # Article épinglé actuel (NON versionné)
├── 📄 README.md                      # README original du template
└── 📄 README_Gpe10.md                # Documentation du projet (ce fichier)
```

### 📝 Description des composants principaux

#### API (`/api/`)
Contient tous les endpoints REST pour les opérations CRUD. Chaque dossier correspond à une entité de la base de données.

#### BDD (`/BDD/` et `/BDD_A_Exporter/`)
- `BDD/` : Scripts de création et jeux de test
- `BDD_A_Exporter/` : Export final propre pour la production

#### Functions (`/functions/`)
Bibliothèque de fonctions réutilisables :
- **query/** : Abstraction de la couche d'accès aux données (SELECT, INSERT, UPDATE, DELETE)
- **security.php** : Gestion des sessions, cookies, tokens CSRF
- **ctrlSaisies.php** : Validation des entrées utilisateur

#### Views (`/views/`)
- **backend/** : Interface d'administration complète (CRUD sur toutes les entités)
- **frontend/** : Interface publique pour les visiteurs

#### Configuration
- **.env** : Contient les paramètres sensibles (BDD, clés API)
- **config.php** : Charge les variables d'environnement et configure l'application
- **header.php / footer.php** : Composants réutilisables sur toutes les pages

---

## �🏷️ Thématiques et mots-clés

### Thématiques principales

1. **Événements** - Événements culinaires, salons gastronomiques
2. **Acteurs Clés** - Chefs, restaurateurs, producteurs locaux
3. **Mouvements Émergents** - Nouvelles tendances culinaires
4. **Insolite** - Histoires et anecdotes surprenantes

### Mots-clés associés

- Vin
- Gastronomie
- Restaurant
- Chef
- Tradition
- Innovation
- Terroir
- Dégustation
- Producteur Local
- Cuisine Moderne
- Événement
- Festival Culinaire
- Brasserie
- Caviste
- Pâtisserie
- Marché Bio
- Recette
- Vignoble
- Appellation
- Dégustation de vin

---

## 📜 RGPD et Mentions légales

### Pages légales intégrées

- **RGPD** : `/views/frontend/rgpd/rgpd.php`
- **CGU** : `/views/frontend/rgpd/cgu.php`
- **Mentions légales** : Intégrées dans la page RGPD

### Conformité RGPD

✅ Politique de confidentialité accessible
✅ Consentement utilisateur (commentaires, contact)
✅ Droit d'accès aux données
✅ Droit à l'oubli
✅ Formulaire de contact sécurisé
✅ Mentions légales complètes

---

## 🌐 URLs

### Repository GitHub
- **URL Repo** : https://github.com/votre-groupe/blogart26

### Hébergement en ligne (IUT ou autre)
- **URL Online** : http://blogart26.mmibordeaux.com (ou votre adresse IUT)
- **Serveur** : Hébergement Externe
- **Contact Hébergement** : intervenant-hebergement@mmibordeaux.com

---

## 📞 Support et contact

- **Formulaire de contact** : http://localhost/BLOGART26/views/frontend/contact.php
- **Email** : Blogastro@mmibordeaux.com
- **Équipe** : Lisa Bruno, Justin Esquer, Paul Pauly, Théo Messean, Julianne Rogam