# 🍷 BlogArt26 - Bordeaux à travers sa Gastronomie

**Un blog dédié à la scène gastronomique bordelaise**

---

## 📋 Table des matières

- [À propos](#à-propos)
- [Fonctionnalités](#fonctionnalités)
- [Architecture du projet](#architecture-du-projet)
- [Accès et identifiants des comptes de test](#accès-et-identifiants-des-comptes-de-test)
- [Thématiques et mots-clés](#thématiques-et-mots-clés)
- [RGPD et Mentions légales](#rgpd-et-mentions-légales)
- [URLs](#urls)
- [Support et contact](#support-et-contact)

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
- ✅⚠️ Responsive design (mobile, tablette, desktop)

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

### Avenants au Cahier des charges (étudié et validé avec les clients )

À l’issue de l’analyse UI et des réunions tenues avec les clients, des avenants au cahier des charges ont été validés.

1/Dashboard administrateur principal: 

Le panneau d’administration général a subi des modifications dans son organisation visuelle. Afin de clarifier les actions possibles et d’éviter la redondance ainsi que la surcharge visuelle, les boutons d’action ont été fusionnés avec le libellé du paramètre qu’ils impactent. Une section de description de l’action a été ajoutée ; elle détaille l’action déclenchée par l’interaction de l’utilisateur avec les boutons et liste les résultats obtenus lors du clic.

2/Panneaux de contrôle des commentaires : 

Le panneau de contrôle des commentaires a fait l’objet de modifications concernant son organisation visuelle et sa nomenclature. La section « Suppression logique » a été renommée « Corbeille » et comprend désormais un bouton « Supprimer de la corbeille » pour chaque itération, afin d’améliorer la clarté des actions possibles et de réduire la surcharge visuelle. Par ailleurs, un bouton « Placer dans la corbeille » a été ajouté à chaque itération de la section « Commentaires contrôlés », Afin de permettre la suppression de commentaires déjà validés en cas d’erreur.

### Ajouts fonctionnels

Gestion des articles
    Article épinglé
    Dernier article en page d’accueil
    Encart des articles cliquables, triés par thème sur la page d’accueil

Lors de la suppression d’un article :
    Notification si suppression impossible à cause de commentaires existants.
    Bouton pour supprimer tous les commentaires (n’apparaît que si des commentaires existent).
    Bouton pour supprimer tous les likes (n’apparaît que si des likes existent).
    Bouton pour voir la liste des likes associés.

Gestion des thèmes et mots-clés
    Suppression de thématique :
    Notification si des articles sont liés.
    Bouton pour supprimer les articles liés.

Mots-clés :
    Notification si des mots-clés sont liés à des articles.
    Bouton pour délier les mots-clés des articles.

Gestion des membres
    Menu déroulant dans le menu (navigation)
    Suppression d’un membre :
        Message clair expliquant pourquoi la suppression est impossible (ex. likes ou commentaires).
        2 boutons intégrés dans la page :
        Supprimer les likes (n’apparaît que si le membre a des likes)
        Supprimer les commentaires (n’apparaît que si le membre a des commentaires)
    Modification du profil membre (front) :
        Changement du mot de passe, nom, email, etc.

Gestion des statuts

    Lors de la suppression d’un statut :
        Notification : nombre de membres utilisant ce statut.
        Champ pour réattribuer un autre statut aux membres concernés.
        Si aucun membre utilise ce statut, pas de notification.

Pages supplémentaires
    Page “Mes coups de cœur” :
        Affiche tous les articles likés par le membre.
        Bouton pour supprimer le like depuis cette page (n’apparaît que si le like existe).
        Bouton lien vers l’article complet depuis cette page (présent pour chaque article).

Autres fonctionnalités
    Encart Google Maps
    Placeholder d’image lors de la création d’un article si aucune image n’est uploadée par l’admin.
    Compteur de likes en temps réel

Bonus réalisé / évoqué dans les consignes :
    Réseaux sociaux (RS)
    Formulaire de contact


---

## 🔐 Accès et identifiants des comptes de test

| Pseudo |  Password   |      Rôle      |        Email        |
|--------|-------------|----------------|---------------------|
| Admin01| Admin!12345 | Administrateur | admin@blogart26.com |
| Modo01 | Modo!12345  | Modérateur     | modo@blogart26.co   |
| User01 | User!12345  | Utilisateur    | user@blogart26.com  |

> ⚠️ **IMPORTANT** : Ces identifiants sont pour les tests uniquement. Les mots de passe en production doivent être forts et uniques.

---

## 🗜️ Architecture du projet

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
│   ├── CreateDbBlogArt26.sql         # Structure de la BDD
│   └── JeuEssaiBlogArt26_OK.sql      # Jeu de données de test
│
├── 📁 BDD_A_Exporter/                # Export final pour production
│   ├── Blogart 26 Groupe 10.sql      # BDD finale du projet
│   └── htdocs.zip                    # Zip code modifié hebergement externe (inutil en local)
│
├── 📁 classes/                       # Classes PHP métier (POO)
├── 📁 config/                        # Configuration de l'application
│   ├── debug.php                     # Paramètres de débogage
│   └── defines.php                   # Constantes globales (chemins, etc.)
│
├── 📁 data/                          # Données temporaires/cache
│
├── 📁 functions/                     # Fonctions réutilisables
│   ├── admin_guard.php               # Protection qui empêche un accés illégal aux API
│   ├── ctrlSaisies.php               # Validation et contrôle des données
│   ├── dateChangeFormat.php          # Conversion de formats de dates
│   ├── getExistPseudo.php            # Vérification d'unicité des pseudos
│   ├── global.inc.php                # Fonctions globales
│   ├── motsCles.js                   # Gestion JavaScript des mots-clés
│   ├── pinned_article.json           # Article épinglé actuel
│   ├── security.php                  # Gestion de sécurité (sessions, cookies)
│   ├── utilErrOn.php                 # Gestion des erreurs
│   ├── various.php                   # Fonctions diverses
│   └── 📁 query/                     # Fonctions d'accès à la BDD
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
│   │   ├── article.png
│   │   ├── logoBlogArt.png
│   │   ├── mmi-bordeaux_Blanc.png
│   │   ├── mmi-bordeaux_Noir.png
│   │   └── search.png
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
│           ├── cgu.php               # Conditions générales d'utilisation
│           └── rgpd.php              # Politique de confidentialité & mentions légales
│
├── 📁 .git/                          # Métadonnées Git
├── 📁 .venv/                         # Environnement Python local
├── 📄 .env                           # Variables d'environnement (NON versionné)
├── 📄 .gitattributes                 # Attributs Git
├── 📄 .gitignore                     # Fichiers à ignorer par Git
├── 📄 .htaccess                      # Configuration Apache
├── 📄 404.php                        # Page d'erreur 404
├── 📄 Bugs a corriger.txt            # Liste de bugs à corriger
├── 📄 config.php                     # Configuration générale de l'application
├── 📄 footer.php                     # Pied de page réutilisable
├── 📄 header.php                     # En-tête réutilisable
├── 📄 index.php                      # Page d'accueil du site
├── 📄 pinned_article.json            # Article épinglé actuel (NON versionné)
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

## 🏷️ Thématiques et mots-clés

### Thématiques principales

1. **Événements** - Événements culinaires, salons gastronomiques
2. **Acteurs Clés** - Chefs, restaurateurs, producteurs locaux
3. **Mouvements Émergents** - Nouvelles tendances culinaires
4. **Insolite** - Histoires et anecdotes surprenantes

[liste non exhaustive pouvant être allongée]

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

[liste non exhaustive pouvant être allongée]

---

## 📜 RGPD et Mentions légales

### Pages légales intégrées

- **RGPD** : `/views/frontend/rgpd/rgpd.php`
- **CGU** : `/views/frontend/rgpd/cgu.php`
- **Mentions légales** : Intégrées dans la page RGPD

---

## 🌐 URLs

### Repository GitHub
- **URL Repo** : https://github.com/votre-groupe/blogart26

### Hébergement en ligne (IUT ou autre)
- **URL Online** : https://blogart26-groupe10.great-site.net
- **Serveur** : Hébergement Externe chez Infinity Free

---

## 📞 Support et contact

- **Formulaire de contact** : http://localhost/BLOGART26/views/frontend/contact.php
- **Email** : sagastronomie@mmibordeaux.com (mail factice)
- **Équipe** : Lisa Bruno, Justin Esquer, Paul Pauly, Théo Messean, Julianne Rogam, Eliott Beauchamps