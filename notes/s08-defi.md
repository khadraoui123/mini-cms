# Session 08 - Défi

La route posts.tag utilise {tag:slug} : oui

La page d'un tag n'affiche ni brouillon ni article d'un autre tag : oui

Les tags des cartes sont des liens : oui

L'accueil n'affiche que les tags qui ont au moins un article publié : oui

Les trois nouveaux tests passent et php artisan test est vert : oui

Pourquoi filtrer les tags vides après get() plutôt que d'afficher (0) ?

Un tag sans article publié mènerait à une page vide : on le masque donc. Le filtrage après `get()` travaille sur la collection déjà chargée et évite d'ajouter une condition SQL supplémentaire à la requête `withCount`.

Combien de requêtes ajoute la liste des tags populaires, et pourquoi pas une par tag ?

Une seule requête. `withCount(['posts' => fn (Builder $query) => $query->published()])` ajoute une sous-requête calculée pour tous les tags dans la même instruction SQL ; le nombre de requêtes ne dépend donc pas du nombre de tags affichés.
