# Session 10 - Robustesse
TagAdminTest contient 5 tests verts : oui
/posts/categorie/inconnue affiche Catégorie introuvable avec le statut 404 : oui
php artisan test est vert : oui
1. Pourquoi le message de messages() l'emporte-t-il sur celui de lang/fr/validation.php ?
Laravel consulte d'abord les messages personnalisés retournés par `messages()` dans le Form Request ; le fichier de langue sert uniquement de repli pour les règles qui n'ont pas de message explicite. Ici `slug.unique` est donc traduit de façon spécifique aux catégories ou aux tags.
2. Pourquoi phpunit.xml fixe-t-il APP_LOCALE ?
Les valeurs de `phpunit.xml` sont appliquées avant le `.env` et sont identiques sur toutes les machines : les assertions sur les messages français restent donc valables après un clone propre, même si la locale locale du développeur est différente.
3. Pourquoi CategoryController n'a-t-il besoin d'aucun try/catch ?
Chaque situation est déjà gérée par le framework : le Form Request valide les données et renvoie les erreurs, la liaison modèle-route renvoie une 404, le middleware renvoie une 503 et le gestionnaire d'exceptions affiche les pages d'erreur. Un `try/catch` ne ferait que masquer ces réponses.
