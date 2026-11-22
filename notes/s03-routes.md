# Session 03 - Routes, contrôleurs et layout

## Défi

URL produite par `route('about')` : http://localhost:8000/a-propos

URL produite par `route('posts.show', 'routes-et-controleurs')` : http://localhost:8000/posts/routes-et-controleurs

URL produite par `route('posts.archive', 2025)` : http://localhost:8000/posts/archive/2025

Pourquoi `/posts/archive/abc` et `/posts/article-inconnu` répondent toutes deux 404, et quelle ligne de code en est responsable dans chaque cas ?

- `/posts/archive/abc` : la contrainte `->whereNumber('year')` dans `routes/web.php` refuse l'URL avant même d'appeler le contrôleur : aucune route ne correspond, Laravel renvoie donc une 404.
- `/posts/article-inconnu` : l'URL respecte la contrainte `->where('slug', '[a-z0-9-]+')` et la route correspond ; c'est alors `abort(404)` dans `PostController::show()` qui renvoie la 404, car le slug n'existe pas dans le tableau des articles.

Que se passe-t-il si une vue appelle `route('posts.show')` sans paramètre ?

Laravel lève une exception `Missing required parameter for [Route: posts.show] [URI: posts/{slug}]` : la génération d'URL ne peut pas remplacer le paramètre `{slug}` absent.
