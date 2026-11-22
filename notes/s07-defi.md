# Session 07 - Défi : articles de la même catégorie

La section « Dans la même catégorie » apparaît sous un article publié qui a une catégorie : oui

L'article affiché n'apparaît pas dans sa propre section : oui

Un brouillon de la même catégorie n'apparaît pas : oui

La page s'ouvre sans LazyLoadingViolationException : oui

Le nouveau test passe et php artisan test est vert : oui

Combien de requêtes SQL charge la section, et pourquoi pas une par carte ?

Quatre requêtes : une pour les articles de la catégorie (avec `where('id', '!=', $post->id)` et `published()`), puis trois requêtes pour charger en une seule fois les auteurs, catégories et tags de tous ces articles grâce à `with('user', 'category', 'tags')`. Le nombre ne dépend donc pas du nombre de cartes : sans `with()`, trois cartes ajouteraient neuf requêtes et la page lèverait une `LazyLoadingViolationException`, car les relations seraient chargées paresseusement sur chaque modèle de la collection.
