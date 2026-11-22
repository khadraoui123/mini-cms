# Session 05 - Défi : articles récents sur l'accueil

latestPosts contient au plus 3 articles : oui

Seuls les articles publiés sont transmis à la vue : oui

home.blade.php utilise x-post-card et @forelse : oui

Le nouveau test passe et php artisan test est vert : oui

Pourquoi get() et pas paginate(3) sur la page d'accueil ?

`get()` exécute immédiatement la requête et retourne une collection d'au plus trois articles. `paginate(3)` ajouterait des numéros de pages inutiles sur la page d'accueil alors qu'on veut seulement un aperçu des derniers articles publiés.
