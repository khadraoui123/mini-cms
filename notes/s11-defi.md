# Session 11 - Défi
/mes-articles ne montre que mes articles, brouillons compris : oui
Un visiteur qui ouvre /mes-articles arrive sur /connexion : oui
Le cookie remember_web_ apparaît quand la case est cochée : oui
Les deux nouveaux tests passent et php artisan test est vert : oui
Pourquoi partir de $request->user()->posts() plutôt que de Post::where('user_id', $request->user()->id) ?
La relation porte déjà la condition sur l'auteur connecté et ne peut pas être détournée par un champ de formulaire ou un paramètre d'URL : on part de la session, pas d'une valeur fournie par le visiteur.
Pourquoi la case remember ne doit-elle pas être dans le tableau passé à Auth::attempt() ?
attempt() traite chaque clé autre que password comme une colonne à comparer : une clé remember provoquerait une erreur « no such column: remember ». La case doit donc être transmise comme deuxième argument, séparément des identifiants.
