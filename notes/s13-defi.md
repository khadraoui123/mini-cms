# Session 13 - Défi
/api/posts/9 affiche tags avec des noms : oui
/api/posts ne contient aucun body, /api/posts/9 en contient un : oui
Aucune LazyLoadingViolationException : oui
Pourquoi ne pas envoyer body dans la liste, et qui en profite ?
La liste ne transporte que les champs nécessaires à un aperçu : moins d'octets, moins de temps de chargement et une consommation réduite sur les téléphones et les connexions lentes. Le client ne télécharge le contenu complet que lorsqu'il ouvre un article ; le serveur, lui, évite de sérialiser de longs textes pour chaque ligne de la pagination. Ce sont les visiteurs sur mobile et les applications qui consomment l'API qui profitent de cette économie.
Un brouillon renvoie 403. Quel avantage aurait un 404 pour un brouillon ?
Un 404 ne révélerait pas qu'un article existe avec cet identifiant : le client ne peut pas deviner l'existence d'un brouillon. Un 403 confirme au contraire que la ressource existe mais n'est pas accessible. Le site fait le même choix puisque GET /api/posts/{post} réutilise PostPolicy::view : la cohérence entre le site et l'API est conservée.
