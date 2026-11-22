# Session 14 - Défi

Connexion enregistre le jeton toute seule : oui

Créer un article répond 201 sans copier le jeton : oui

Le fichier exporté ne contient aucun jeton : oui

Le dépôt est public. Que risquez-vous si le fichier exporté contient un jeton, et comment l'annuler ?

N'importe qui pourrait utiliser ce jeton pour agir à votre place sur l'API : lire `/api/user`, créer, modifier ou supprimer des articles. Les jetons Sanctum n'expirent pas par défaut, le risque dure donc jusqu'à la révocation. Pour annuler, appelez `POST /api/logout` avec ce jeton (le contrôleur supprime le jeton courant) ou supprimez sa ligne dans la table `personal_access_tokens`.

Pourquoi les écritures de l'API passent-elles par les Form Requests et PostPolicy plutôt que par des règles écrites dans `Api\PostController` ?

C'est une seule règle pour deux portes d'entrée : le site et l'API utilisent les mêmes Form Requests et la même `PostPolicy`. Modifier une règle ou la Policy met les deux à jour ensemble, et l'API ne peut pas contourner les droits du site (un auteur ne peut pas modifier l'article d'un autre).
