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

|Pseudo |  Password   |      Rôle      |
|-------|-------------|----------------|
| Admin | Admin!12345 | Administrateur |
| Modo  | Modo!12345  | Modérateur     |
| User  | User!12345  | Utilisateur    |

> ⚠️ **IMPORTANT** : Ces identifiants sont pour les tests uniquement. Les mots de passe en production doivent être forts et uniques.

---

## 🏷️ Thématiques et mots-clés

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
- **Serveur** : Hébergement IUT Bordeaux Montaigne
- **Contact Hébergement** : intervenant-hebergement@mmibordeaux.com

### URLs locales
- **Frontend** : http://localhost/BLOGART26/
- **Backend** : http://localhost/BLOGART26/views/backend/dashboard.php
- **API** : http://localhost/BLOGART26/api/

---

## 📊 État du projet

### ✅ Fonctionnalités complétées

**Frontend**
- [x] Page d'accueil responsive
- [x] Listing des articles
- [x] Détail des articles
- [x] Système de commentaires
- [x] Système de likes
- [x] Recherche et filtrage avancés
- [x] Profil utilisateur
- [x] Page de contact
- [x] RGPD et CGU
- [x] Design responsive (mobile, tablette, desktop)
- [x] Bouton "Voir tous les articles" responsive

**Backend**
- [x] Dashboard administrateur
- [x] CRUD Articles
- [x] CRUD Commentaires
- [x] CRUD Membres
- [x] CRUD Mots-clés
- [x] CRUD Thématiques
- [x] CRUD Statuts
- [x] Système d'authentification
- [x] Épinglage d'articles

**Base de données**
- [x] Schéma complet
- [x] Relations intégrées
- [x] Données de test nettoyées
- [x] Exportée en .sql

**Sécurité**
- [x] Hashage des mots de passe (password_hash)
- [x] Protection CSRF
- [x] Contrôle des saisies
- [x] Sessions sécurisées
- [x] Validation des données

### 📝 Contenu exemple

**Articles disponibles**
- Événements gastronimques bordelais
- Portraits de chefs locaux
- Tendances culinaires 2026
- Anecdotes insolites

**Nombre d'articles** : 6+ articles de qualité

---

## 🛠️ Configuration technique

### Variables d'environnement (.env)

```env
DB_HOST=localhost
DB_USER=root
DB_PASS=
DB_NAME=blogart26
DB_PORT=3306

APP_ENV=development
APP_DEBUG=true
APP_URL=http://localhost/BLOGART26/
```

### Modules PHP requis

- MySQLi ou PDO
- Sessions
- Filter
- Hash

### Configurations Apache

```apache
<Directory /wamp64/www/BLOGART26>
    AllowOverride All
    Require all granted
</Directory>
```

---

## 📦 Fichiers importants

| Fichier | Description |
|---------|-------------|
| `index.php` | Page d'accueil |
| `config.php` | Configuration générale |
| `header.php` | En-tête réutilisable |
| `footer.php` | Pied de page réutilisable |
| `.env` | Variables d'environnement |
| `BDD_A_Exporter/BlogArt26_Final.sql` | Export BDD final |

---

## 🚢 Déploiement

### Avant la mise en production

- [x] Tous les scripts sont à jour sur GitHub
- [x] La BDD a été exportée et sauvegardée
- [x] Les identifiants de test ont été fournis
- [x] Le code a été testé localement
- [x] Les pages RGPD/CGU sont visibles
- [x] Le responsive design a été validé

### Procédure de déploiement

1. Push final sur GitHub (vendredi 6, 23h59)
2. Confirmation via classroom
3. Upload sur serveur hébergement
4. Import de la BDD sur serveur
5. Tests en production
6. Validation finale

---

## 📞 Support et contact

- **Formulaire de contact** : http://localhost/BLOGART26/views/frontend/contact.php
- **Email** : Blogastro@mmibordeaux.com
- **Équipe** : Lisa Bruno, Justin Esquer, Paul Pauly, Théo Messean, Julianne Rogam

---

## 📄 Licence

Projet académique - IUT Bordeaux Montaigne

---

## 📝 Historique des versions

| Version | Date | Modifications |
|---------|------|---------------|
| 1.0 | 04/02/2026 | Version initiale |
| 1.1 | 04/02/2026 | Ajout bouton responsive |
| 1.2 | 04/02/2026 | Lien contact dans footer |

---

**Dernier commit** : 04 février 2026
**Statut** : ✅ Prêt pour validation