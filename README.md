# Mini-CMS

Projet fil rouge de l'Atelier Framework Côté Serveur (Laravel 13, PHP 8.3+), 3e année MDW, ISET Sidi Bouzid.

Auteur : Wajih Khadraoui, groupe MDW32.

Mini-CMS évoluera au fil du semestre vers une petite plateforme de publication : pages publiques, back-office authentifié, API JSON et tests Pest. Chaque session se termine par un tag Git (`lab-01`, `lab-01b`, puis un tag par session).

## État actuel (tag lab-06b)

- Middleware `admin` (`App\Http\Middleware\EnsureUserIsAdmin`) sur tout `/admin` : un auteur reçoit 403 « Réservé aux administrateurs. ».
- Gate `manage-tags`, comme `manage-categories` : contrôleur, Form Requests et menu.
- Brouillons protégés : `PostPolicy::view` et le scope `visibleTo` ; un brouillon n'est visible que par son auteur et les administrateurs.
- Défi : gestion des rôles sous `/admin/utilisateurs` (14 routes admin), `UserPolicy` interdisant à un admin de changer son propre rôle et un `Gate::before` qui laisse passer les administrateurs.
- Tests d'autorisation : `AdminAccessTest` (7 tests), `PostVisibilityTest` (5 tests), `UserRoleTest` (2 tests), en plus des fichiers de la session 11 (81 tests au total).
- Comparaison écrite avec le starter kit Livewire (section ci-dessous).

## Données de démonstration

Après un clone, reconstruire la base avec `php artisan migrate:fresh --seed`. Attention : cette commande vide la base avant de la remplir.

## Routes disponibles

| Méthode | URI | Nom | Action |
|---|---|---|---|
| GET | `/` | `home` | `PageController@home` |
| GET | `/a-propos` | `about` | `PageController@about` |
| GET | `/heure` | `time` | `PageController@time` |
| GET | `/posts` | `posts.index` | `PostController@index` |
| GET | `/posts/archive/{year}` | `posts.archive` | `PostController@archive` |
| GET | `/posts/categorie/{category:slug}` | `posts.category` | `PostController@byCategory` |
| GET | `/posts/tag/{tag:slug}` | `posts.tag` | `PostController@byTag` |
| GET | `/posts/create` | `posts.create` | `PostController@create` |
| POST | `/posts` | `posts.store` | `PostController@store` |
| GET | `/posts/{post}` | `posts.show` | `PostController@show` |
| GET | `/posts/{post}/edit` | `posts.edit` | `PostController@edit` |
| PUT\|PATCH | `/posts/{post}` | `posts.update` | `PostController@update` |
| DELETE | `/posts/{post}` | `posts.destroy` | `PostController@destroy` |
| PATCH | `/posts/{post}/publication` | `posts.publication` | `PostController@togglePublication` |
| GET | `/admin/categories` | `admin.categories.index` | `CategoryController@index` |
| GET | `/admin/categories/create` | `admin.categories.create` | `CategoryController@create` |
| POST | `/admin/categories` | `admin.categories.store` | `CategoryController@store` |
| GET | `/admin/categories/{category}/edit` | `admin.categories.edit` | `CategoryController@edit` |
| PUT\|PATCH | `/admin/categories/{category}` | `admin.categories.update` | `CategoryController@update` |
| DELETE | `/admin/categories/{category}` | `admin.categories.destroy` | `CategoryController@destroy` |
| GET | `/admin/tags` | `admin.tags.index` | `TagController@index` |
| GET | `/admin/tags/create` | `admin.tags.create` | `TagController@create` |
| POST | `/admin/tags` | `admin.tags.store` | `TagController@store` |
| GET | `/admin/tags/{tag}/edit` | `admin.tags.edit` | `TagController@edit` |
| PUT\|PATCH | `/admin/tags/{tag}` | `admin.tags.update` | `TagController@update` |
| DELETE | `/admin/tags/{tag}` | `admin.tags.destroy` | `TagController@destroy` |
| GET | `/admin/utilisateurs` | `admin.users.index` | `UserController@index` |
| PATCH | `/admin/utilisateurs/{user}/role` | `admin.users.role` | `UserController@updateRole` |
| GET | `/inscription` | `register` | `Auth\RegisterController@create` |
| POST | `/inscription` | `register.store` | `Auth\RegisterController@store` |
| GET | `/connexion` | `login` | `Auth\LoginController@create` |
| POST | `/connexion` | `login.store` | `Auth\LoginController@store` |
| POST | `/deconnexion` | `logout` | `Auth\LoginController@destroy` |
| GET | `/mes-articles` | `my-posts` | `PostController@myPosts` |

## Prérequis

- PHP 8.3 ou plus (https://www.php.net/downloads) avec les extensions curl, fileinfo, mbstring, openssl, pdo_sqlite, sqlite3 et zip activées dans php.ini.
- Composer (https://getcomposer.org).
- Node.js LTS et npm.
- Git.

## Installation

### Bash (Git Bash, macOS, Linux)

```bash
git clone https://github.com/khadraoui123/mini-cms.git
cd mini-cms
composer install
npm install
cp .env.example .env
php artisan key:generate
touch database/database.sqlite
php artisan migrate
composer run dev
```

### PowerShell (Windows)

```powershell
git clone https://github.com/khadraoui123/mini-cms.git
cd mini-cms
composer install
npm install
copy .env.example .env
php artisan key:generate
New-Item database\database.sqlite -ItemType File
php artisan migrate
composer run dev
```

Ouvrir ensuite http://localhost:8000 (adresse de l'application, différente de l'adresse de Vite sur le port 5173).

## Captures d'écran

### Page d'accueil

![Page d'accueil de Mini-CMS](screenshots/s01-accueil.png)

### Liste des routes

![Sortie de php artisan route:list](screenshots/s01-route-list.png)

### Page À propos

![Page A propos](screenshots/s02-a-propos.png)

### Accueil avec le layout

![Page d'accueil avec le layout](screenshots/s03-accueil.png)

### Liste des articles

![Liste des articles](screenshots/s03-articles.png)

### Détail d'un article

![Détail d'un article](screenshots/s03-article.png)

### Session 04

![Liste des articles](screenshots/s04-articles.png)

### Session 05

![Liste paginée des articles](screenshots/s05-articles.png)
![Formulaire avec erreurs de validation](screenshots/s05-formulaire.png)
![Suite de tests Pest](screenshots/s05-tests.png)

### Session 06

![Formulaire de modification](screenshots/s06-modification.png)
![Confirmation de suppression](screenshots/s06-suppression.png)
![Suite de tests Pest](screenshots/s06-tests.png)

### Session 07

![Liste des articles avec leur catégorie, leur auteur et leurs tags](screenshots/s07-liste-relations.png)
![Page d'un article avec ses tags et les articles de la même catégorie](screenshots/s07-detail-tags.png)
![Suite de tests Pest](screenshots/s07-tests.png)

### Session 08

![Formulaire avec catégorie et tags](screenshots/s08-formulaire-relations.png)
![Page d'une catégorie](screenshots/s08-page-categorie.png)
![Page d'un tag](screenshots/s08-page-tag.png)
![Suite de tests Pest](screenshots/s08-tests.png)

### Session 09

![Page d'un article avec le message flash « Article créé. »](screenshots/s09-message-flash.png)
![Page Article introuvable pour un identifiant inexistant](screenshots/s09-article-introuvable.png)

### Session 10

Back-office des catégories et des tags, messages de validation en français, pages 404 et 503 dans le layout du site.

![Formulaire de catégorie envoyé vide, avec les messages de validation en français](screenshots/s10-validation.png)
![Page 404 du site pour une adresse inconnue](screenshots/s10-404.png)
![Back-office des catégories](screenshots/s10-admin.png)
![Suite de tests Pest](screenshots/s10-tests.png)

### Session 11

Connexion, rôles et autorisations : navigation d'un utilisateur connecté et page 403 pour un auteur.

![Barre de navigation d'un utilisateur connecté, avec le message « Vous êtes connecté. »](screenshots/s11-connexion.png)
![Page 403 quand un auteur ouvre la modification de l'article d'un autre auteur](screenshots/s11-interdit.png)

### Session 12

Zone `/admin` protégée par le middleware `admin` et menu réduit pour un auteur.

![Page 403 « Réservé aux administrateurs. » pour un auteur ouvrant /admin/tags](screenshots/s12-admin-interdit.png)
![Navigation d'un auteur : ni Catégories, ni Tags, ni Utilisateurs](screenshots/s12-menu-auteur.png)

## Comparaison avec le starter kit Livewire

| Critère | Mini-CMS (authentification manuelle) | Starter kit Livewire |
|---|---|---|
| Routes d'authentification | Écrites à la main dans `routes/web.php` (groupes `guest` et `auth`) | Enregistrées par le paquet Fortify, absentes de `routes/web.php` |
| Inscription | `Auth\RegisterController` + `RegisterRequest` | `app/Actions/Fortify/CreateNewUser.php` + `resources/views/pages/auth/register.blade.php` |
| Connexion | `Auth\LoginController::store` + `LoginRequest` | Contrôleur Fortify + `resources/views/pages/auth/login.blade.php` |
| Déconnexion | `Auth\LoginController::destroy` | Route Fortify + `app/Livewire/Actions/Logout.php` |
| Limitation des tentatives | Aucune | 5 tentatives/minute/e-mail + IP (`app/Providers/FortifyServiceProvider.php`) |
| Mot de passe oublié | Absent | `Features::resetPasswords()` |
| Vérification de l'e-mail | Absente | `Features::emailVerification()` + `MustVerifyEmail` + middleware `verified` |
| Double authentification | Absente | `Features::twoFactorAuthentication()` et `Features::passkeys()` |
| Rôles et autorisations | Colonne `role` + Gates + `PostPolicy` + middleware `admin` | Absents du kit |
| Tests | `AuthTest` / `AuthorizationTest` / `AdminAccessTest` / `PostVisibilityTest` | 10 fichiers de tests dans `tests/Feature` (Auth, Settings, Dashboard) |

Ce que je garderais du kit dans un vrai projet : la limitation des tentatives et la réinitialisation du mot de passe, qui sont sensibles et fastidieuses à réimplémenter correctement à la main. Je garderais aussi la vérification d'e-mail et la double authentification, tout en conservant mes Gates et ma `PostPolicy` qui portent les règles métier de Mini-CMS.
