# Cycle de vie d'une requête vers /heure

1. Le navigateur envoie une requête `GET /heure`.
2. `public/index.php` est le seul point d'entrée : il charge l'autoloader Composer
   (`vendor/autoload.php`) puis `bootstrap/app.php`, qui crée l'application et
   déclare les fichiers de routes (dont `routes/web.php`).
3. Le routeur cherche dans `routes/web.php` la route correspondant à `GET /heure`
   et exécute sa closure.
4. La closure prépare les données (`now()->format('H:i')` et `d/m/Y`) et renvoie
   la vue `resources/views/heure.blade.php`.
5. Blade compile la vue en HTML (versions compilées dans `storage/framework/views`).
6. Laravel renvoie la réponse HTTP au navigateur, qui affiche la page.

Fichiers traversés, dans l'ordre :

`public/index.php` → `vendor/autoload.php` → `bootstrap/app.php` →
`routes/web.php` → `resources/views/heure.blade.php` → réponse HTTP.

Comparaison avec le corrigé : le chemin décrit correspond au corrigé du codelab
(le fuseau horaire est défini dans `config/app.php` avec `'timezone' => 'Africa/Tunis'`).
